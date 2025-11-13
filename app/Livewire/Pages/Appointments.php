<?php

namespace App\Livewire\Pages;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class Appointments extends Component
{
    public $name, $email, $phone, $date, $concerns;

    public function submitAppointment()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'concerns' => 'nullable|string|max:1000',
        ]);

        //Find or create the user
        $user = User::firstOrCreate(
            ['email' => $this->email],
            [
                'name' => $this->name,
                'password' => Hash::make('password'), // default password
            ]
        );

        // Find or create the patient linked to that user
        $patient = Patient::firstOrCreate(
            ['user_id' => $user->id],
            [
                'contact_number' => $this->phone,
                'address' => null,
            ]
        );

        //Create the appointment
        Appointment::create([
            'patient_id' => $patient->id,
            'dentist_id' => null, // assigned later by admin
            'service_id' => null, // assigned later by admin
            'facility_id' => null,
            'appointment_date' => Carbon::parse($this->date),
            'notes' => $this->concerns,
            'status' => 'scheduled',
        ]);

        // Clear the form and show a success message
        $this->reset();
        session()->flash('message', 'Your appointment request has been submitted successfully!');
    }

    public function render()
    {
        return view('livewire.pages.appointments')->layout('layouts.app');
    }
}
