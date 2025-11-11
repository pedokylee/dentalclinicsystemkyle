<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;

class Appointments extends Component
{
    public $selectedDate;
    public $isModalOpen = false;

    // Form fields
    public $patient_id;
    public $date;
    public $time;
    public $type;
    public $doctor_id;
    public $status = 'scheduled';

    protected $rules = [
        'patient_id' => 'required|exists:patients,id',
        'date' => 'required|date',
        'time' => 'required',
        'type' => 'required|string|max:255',
        'doctor_id' => 'required|exists:users,id',
    ];

    public function mount()
    {
        $this->selectedDate = Carbon::now()->format('Y-m-d');
    }

    public function openModal()
    {
        $this->reset(['patient_id', 'date', 'time', 'type', 'doctor_id']);
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function save()
    {
        $this->validate();

        Appointment::create([
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'date' => $this->date,
            'time' => $this->time,
            'type' => $this->type,
            'status' => $this->status,
        ]);

        $this->isModalOpen = false;
        $this->dispatch('appointmentAdded');
    }

    public function render()
    {
        $appointments = Appointment::with(['patient.user', 'doctor'])
            ->whereDate('date', $this->selectedDate)
            ->orderBy('time', 'asc')
            ->get();

        $patients = Patient::with('user')->get();
        $doctors = User::where('role', 'doctor')->get();

        return view('livewire.admin.appointments', [
            'appointments' => $appointments,
            'patients' => $patients,
            'doctors' => $doctors,
        ])->layout('layouts.admin');
    }
}
