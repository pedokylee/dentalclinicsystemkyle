<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Patient;
use App\Models\User;

class Patients extends Component
{
    public $searchQuery = '';
    public $isAddModalOpen = false;
    public $isViewModalOpen = false; // for viewing details
    public $isEditMode = false; // toggle for edit mode

    public $selectedPatient;

    public $name;
    public $gender;
    public $phone;
    public $email;
    public $address;

    public $patients;

    public function mount()
    {
        $this->patients = Patient::with('user')->latest()->get();
    }

    public function updatedSearchQuery()
    {
        $query = '%' . $this->searchQuery . '%';
        $this->patients = Patient::with('user')
            ->whereHas('user', fn($q) => $q->where('name', 'like', $query)->orWhere('email', 'like', $query))
            ->orWhere('contact_number', 'like', $query)
            ->latest()
            ->get();
    }

    // ---------- ADD PATIENT ----------
    public function showAddForm()
    {
        $this->resetForm();
        $this->isAddModalOpen = true;
    }

    public function closeAddForm()
    {
        $this->isAddModalOpen = false;
    }

    public function resetForm()
    {
        $this->name = '';
        $this->gender = '';
        $this->phone = '';
        $this->email = '';
        $this->address = '';
        $this->isEditMode = false;
        $this->selectedPatient = null;
    }

    public function addPatient()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'gender' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt('password'),
        ]);

        Patient::create([
            'user_id' => $user->id,
            'contact_number' => $this->phone,
            'address' => $this->address,
        ]);

        $this->patients = Patient::with('user')->latest()->get();
        $this->closeAddForm();
        $this->resetForm();

        session()->flash('message', 'New patient added successfully!');
    }

    // ---------- VIEW PATIENT ----------
    public function viewPatient($id)
    {
        $this->selectedPatient = Patient::with('user')->findOrFail($id);
        $this->name = $this->selectedPatient->user->name;
        $this->email = $this->selectedPatient->user->email;
        $this->gender = $this->selectedPatient->gender;
        $this->phone = $this->selectedPatient->contact_number;
        $this->address = $this->selectedPatient->address;

        $this->isViewModalOpen = true;
    }

    public function closeModal()
    {
        $this->isViewModalOpen = false;
        $this->resetForm();
    }

    // ---------- EDIT PATIENT ----------
    public function enableEdit()
    {
        $this->isEditMode = true;
    }

    public function updatePatient()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->selectedPatient->user_id,
            'phone' => 'required|string|max:20',
            'gender' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // Update User
        $this->selectedPatient->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Update Patient
        $this->selectedPatient->update([
            'contact_number' => $this->phone,
            'gender' => $this->gender,
            'address' => $this->address,
        ]);

        $this->patients = Patient::with('user')->latest()->get();
        $this->isEditMode = false;
        session()->flash('message', 'Patient updated successfully!');
    }

    // ---------- DELETE PATIENT ----------
    public function deletePatient($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        $this->patients = Patient::with('user')->latest()->get();
        $this->closeModal();
        session()->flash('message', 'Patient deleted successfully!');
    }

    public function render()
    {
        return view('livewire.admin.patients', [
            'patients' => $this->patients,
        ])->layout('layouts.admin');
    }
}
