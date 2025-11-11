<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Dentist;

class Dentists extends Component
{
    public $search = '';
    public $isAddModalOpen = false;
    public $isEditModalOpen = false;
    public $isDeleteModalOpen = false;

    public $dentistId = null;
    public $dentistToDelete = null;
    public $user_id = null;
    public $name = '';
    public $specialization = '';
    public $email = '';
    public $phone = '';
    public $license_number = '';
    public $years_of_experience = null;
    public $bio = '';
    public $availability = [];
    public $status = 'active';

    protected $rules = [
        'user_id' => 'nullable|exists:users,id',
        'name' => 'required|string|max:255',
        'specialization' => 'nullable|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:50',
        'license_number' => 'nullable|string|max:50',
        'years_of_experience' => 'nullable|integer|min:0',
        'bio' => 'nullable|string',
        'availability' => 'array',
        'status' => 'in:active,on-leave,inactive',
    ];

    public function openAddModal()
    {
        $this->resetFormFields();
        $this->isAddModalOpen = true;
    }

    public function openEditModal($id)
    {
        $this->resetFormFields();
        
        $dentist = Dentist::findOrFail($id);
        
        $this->dentistId = $dentist->id;
        $this->user_id = $dentist->user_id;
        $this->name = $dentist->name;
        $this->specialization = $dentist->specialization;
        $this->email = $dentist->email;
        $this->phone = $dentist->phone;
        $this->license_number = $dentist->license_number;
        $this->years_of_experience = $dentist->years_of_experience;
        $this->bio = $dentist->bio;
        $this->status = $dentist->status;
        
        // Handle availability - ensure it's always an array
        $this->availability = is_array($dentist->availability) 
            ? $dentist->availability 
            : json_decode($dentist->availability ?? '[]', true);
        
        $this->isEditModalOpen = true;
    }

    public function openDeleteModal($id)
    {
        $this->dentistToDelete = Dentist::findOrFail($id);
        $this->isDeleteModalOpen = true;
    }

    public function deleteDentist()
    {
        if ($this->dentistToDelete) {
            $name = $this->dentistToDelete->name;
            $this->dentistToDelete->delete();
            $this->closeDeleteModal();
            session()->flash('message', "Dentist '{$name}' has been deleted successfully!");
        }
    }

    public function closeModal()
    {
        $this->isAddModalOpen = false;
        $this->isEditModalOpen = false;
        $this->resetFormFields();
    }

    public function closeDeleteModal()
    {
        $this->isDeleteModalOpen = false;
        $this->dentistToDelete = null;
    }

    private function resetFormFields()
    {
        $this->dentistId = null;
        $this->user_id = null;
        $this->name = '';
        $this->specialization = '';
        $this->email = '';
        $this->phone = '';
        $this->license_number = '';
        $this->years_of_experience = null;
        $this->bio = '';
        $this->availability = [];
        $this->status = 'active';
        $this->resetErrorBag();
    }

    public function saveDentist()
    {
        $this->validate();

        Dentist::create([
            'user_id' => $this->user_id,
            'name' => $this->name,
            'specialization' => $this->specialization,
            'email' => $this->email,
            'phone' => $this->phone,
            'license_number' => $this->license_number,
            'years_of_experience' => $this->years_of_experience,
            'bio' => $this->bio,
            'availability' => $this->availability,
            'status' => $this->status,
        ]);

        $this->closeModal();
        session()->flash('message', 'Dentist added successfully!');
    }

    public function updateDentist()
    {
        $this->validate();

        $dentist = Dentist::findOrFail($this->dentistId);

        $dentist->update([
            'user_id' => $this->user_id,
            'name' => $this->name,
            'specialization' => $this->specialization,
            'email' => $this->email,
            'phone' => $this->phone,
            'license_number' => $this->license_number,
            'years_of_experience' => $this->years_of_experience,
            'bio' => $this->bio,
            'availability' => $this->availability,
            'status' => $this->status,
        ]);

        $this->closeModal();
        session()->flash('message', 'Dentist updated successfully!');
    }

    public function render()
    {
        $dentists = Dentist::query()
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('specialization', 'like', "%{$this->search}%")
            )
            ->orderBy('name')
            ->get();

        return view('livewire.admin.dentists', compact('dentists'))
            ->layout('layouts.admin');
    }
}