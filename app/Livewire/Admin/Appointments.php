<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Service;
use Carbon\Carbon;
use Livewire\Component;

class Appointments extends Component
{
    public $selectedDate;
    public $isModalOpen = false;

    // Form fields
    public $patient_id;
    public $dentist_id;
    public $service_ids = []; // now multiple
    public $date;
    public $time;
    public $status = 'scheduled';
    public $notes;

    // Loaded data
    public $patients = [];
    public $dentists = [];
    public $services = [];

    protected $rules = [
        'patient_id' => 'required|exists:patients,id',
        'dentist_id' => 'required|exists:dentists,id',
        'service_ids' => 'required|array|min:1',
        'service_ids.*' => 'exists:services,id',
        'date' => 'required|date',
        'time' => 'nullable',
        'status' => 'nullable|string',
        'notes' => 'nullable|string',
    ];

    public function mount()
    {
        $this->selectedDate = Carbon::now()->format('Y-m-d');
        $this->loadDropdownData();
    }

    private function loadDropdownData()
    {
        $this->patients = Patient::with('user')
            ->orderByDesc('created_at')
            ->get();

        $this->dentists = Dentist::where('status', 'active')
            ->orderBy('name')
            ->get();

        $this->services = Service::where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function openModal()
    {
        $this->reset(['patient_id', 'dentist_id', 'service_ids', 'date', 'time', 'notes']);
        $this->loadDropdownData();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function save()
    {
        $this->validate();

        $appointmentDate = $this->time
            ? Carbon::parse("{$this->date} {$this->time}")
            : Carbon::parse($this->date);

        // Create the appointment
        $appointment = Appointment::create([
            'patient_id' => $this->patient_id,
            'dentist_id' => $this->dentist_id,
            'appointment_date' => $appointmentDate,
            'status' => $this->status,
            'notes' => $this->notes,
        ]);

        // Attach multiple services
        $appointment->services()->attach($this->service_ids);

        $this->isModalOpen = false;
        $this->dispatch('appointmentAdded');
    }

    public function render()
    {
        $appointments = Appointment::with(['patient.user', 'dentist', 'services'])
            ->whereDate('appointment_date', $this->selectedDate)
            ->orderBy('appointment_date', 'asc')
            ->get();

        return view('livewire.admin.appointments', [
            'appointments' => $appointments,
            'patients' => $this->patients,
            'dentists' => $this->dentists,
            'services' => $this->services,
        ])->layout('layouts.admin');
    }
}
