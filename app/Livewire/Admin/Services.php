<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    public $services = [];
    public $searchQuery = '';
    public $isAddModalOpen = false;
    public $selectedService = null;

    // Form fields
    public $name;
    public $description;
    public $duration;
    public $price;
    public $category;
    public $isActive = true;

    public function mount()
    {
        $this->loadServices();
    }

    public function loadServices()
    {
        $this->services = Service::orderBy('name')->get()->toArray();
    }

    public function openAddModal()
    {
        $this->resetForm();
        $this->isAddModalOpen = true;
    }

    public function cancelEdit()
    {
        $this->isAddModalOpen = false;
        $this->selectedService = null;
        $this->resetForm();
    }

    public function openEditModal($serviceId)
    {
        $this->selectedService = Service::find($serviceId);
        $this->name = $this->selectedService->name;
        $this->description = $this->selectedService->description;
        $this->duration = $this->selectedService->duration;
        $this->price = $this->selectedService->price;
        $this->category = $this->selectedService->category;

        // Ensure boolean for the checkbox
        $this->isActive = (bool) $this->selectedService->is_active;

        // Open modal
        $this->isAddModalOpen = true;
    }

    public function saveService()
    {
        $this->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'duration' => $this->duration,
            'price' => $this->price,
            'category' => $this->category,
            'is_active' => (bool) $this->isActive, // ensure boolean
        ];

        if ($this->selectedService) {
            // Update existing
            $this->selectedService->update($data);
            $this->selectedService = null;
        } else {
            // Create new
            Service::create($data);
        }

        $this->loadServices();
        $this->isAddModalOpen = false;
        $this->resetForm();
    }

    public function deleteService($serviceId)
    {
        Service::find($serviceId)?->delete();
        $this->loadServices();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->duration = '';
        $this->price = '';
        $this->category = '';
        $this->isActive = true;
    }

    public function render()
    {
        $filteredServices = collect($this->services)->filter(function ($service) {
            return str_contains(strtolower($service['name']), strtolower($this->searchQuery))
                || str_contains(strtolower($service['category']), strtolower($this->searchQuery));
        });

        return view('livewire.admin.services', [
            'services' => $filteredServices
        ])->layout('layouts.admin');
    }
}
