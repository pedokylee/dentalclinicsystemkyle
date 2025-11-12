<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Treatment; // <-- added
use Carbon\Carbon;
use Livewire\Component;

class Appointments extends Component
{
    public $selectedDate;

    // Modal states
    public $isModalOpen = false;
    public $isEditMode = false;
    public $appointmentId = null;

    // Form fields
    public $patient_id;
    public $dentist_id;
    public $service_ids = [];
    public $date;
    public $time;
    public $status = 'scheduled';
    public $notes;

    // Loaded dropdowns
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
        $this->patients = Patient::with('user')->latest()->get();
        $this->dentists = Dentist::where('status', 'active')->orderBy('name')->get();
        $this->services = Service::where('is_active', true)->orderBy('name')->get();
    }

    /** ------------------------------
     *  CREATE / EDIT MODAL
     * ----------------------------- */
    public function openModal($id = null)
    {
        $this->resetValidation();
        $this->loadDropdownData();
        $this->resetForm();

        if ($id) {
            $this->isEditMode = true;
            $appointment = Appointment::with('services')->findOrFail($id);
            $this->appointmentId = $appointment->id;
            $this->patient_id = $appointment->patient_id;
            $this->dentist_id = $appointment->dentist_id;
            $this->service_ids = $appointment->services->pluck('id')->toArray();
            $this->date = Carbon::parse($appointment->appointment_date)->format('Y-m-d');
            $this->time = Carbon::parse($appointment->appointment_date)->format('H:i');
            $this->status = $appointment->status;
            $this->notes = $appointment->notes;
        } else {
            $this->isEditMode = false;
        }

        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->appointmentId = null;
        $this->reset(['patient_id', 'dentist_id', 'service_ids', 'date', 'time', 'notes', 'status']);
        $this->status = 'scheduled';
    }

    /** ------------------------------
     *  SAVE (Create or Update)
     * ----------------------------- */
    public function save()
    {
        $this->validate();

        $appointmentDate = $this->time
            ? Carbon::parse("{$this->date} {$this->time}")
            : Carbon::parse($this->date);

        if ($this->isEditMode && $this->appointmentId) {
            $appointment = Appointment::findOrFail($this->appointmentId);
            $appointment->update([
                'patient_id' => $this->patient_id,
                'dentist_id' => $this->dentist_id,
                'appointment_date' => $appointmentDate,
                'status' => $this->status,
                'notes' => $this->notes,
            ]);
            $appointment->services()->sync($this->service_ids);
        } else {
            // Create appointment
            $appointment = Appointment::create([
                'patient_id' => $this->patient_id,
                'dentist_id' => $this->dentist_id,
                'appointment_date' => $appointmentDate,
                'status' => $this->status,
                'notes' => $this->notes,
            ]);

            $appointment->services()->attach($this->service_ids);

            // Create corresponding treatment
            $procedureNames = Service::whereIn('id', $this->service_ids)->pluck('name')->join(', ');
            Treatment::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $this->patient_id,
                'dentist_id' => $this->dentist_id,
                'procedure' => $procedureNames,
                'status' => 'scheduled',
                'date' => $appointmentDate,
                'cost' => 0, // will be updated when marked completed
                'notes' => $this->notes,
            ]);
        }

        $this->closeModal();
        $this->dispatch('appointmentUpdated');
    }

    /** ------------------------------
     *  DELETE
     * ----------------------------- */
    public function delete($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->services()->detach();
        $appointment->delete();

        $this->dispatch('appointmentDeleted');
    }

    public function render()
    {
        $appointments = Appointment::with(['patient.user', 'dentist', 'services'])
            ->whereDate('appointment_date', $this->selectedDate)
            ->orderBy('appointment_date')
            ->get();

        return view('livewire.admin.appointments', [
            'appointments' => $appointments,
        ])->layout('layouts.admin');
    }
}
