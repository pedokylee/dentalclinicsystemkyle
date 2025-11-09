<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Patients extends Component
{
    // Reactive properties
    public $searchQuery = '';
    public $isAddModalOpen = false;
    public $selectedPatient = null;

    public $name;
    public $gender;
    public $phone;
    public $email;
    public $address;

    public $patients = []; // Patient list
    public $filteredPatients = []; // Filtered list

    public function mount()
    {
        $this->patients = []; 
        $this->filteredPatients = $this->patients;
    }

    // Search functionality
    public function updatedSearchQuery()
    {
        $query = strtolower($this->searchQuery);
        $this->filteredPatients = array_filter($this->patients, function ($patient) use ($query) {
            return str_contains(strtolower($patient['name']), $query) ||
                   str_contains(strtolower($patient['email']), $query) ||
                   str_contains($patient['phone'], $query);
        });
    }

    // Open Add Patient form
    public function showAddForm()
    {
        $this->resetForm();
        $this->isAddModalOpen = true;
    }

    // Close Add Patient form
    public function closeAddForm()
    {
        $this->isAddModalOpen = false;
    }

    // Reset form fields
    public function resetForm()
    {
        $this->name = '';
        $this->gender = '';
        $this->phone = '';
        $this->email = '';
        $this->address = '';
    }

    // Add patient (example logic, you can replace with DB insert)
    public function addPatient()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $newPatient = [
            'name' => $this->name,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ];

        $this->patients[] = $newPatient;
        $this->filteredPatients = $this->patients;

        $this->closeAddForm();
    }

    public function render()
    {
        return view('livewire.admin.patients')
            ->layout('layouts.admin');
    }
}
