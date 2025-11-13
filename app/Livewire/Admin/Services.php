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

        if (!$this->selectedService) return;

        $this->name = $this->selectedService->name;
        $this->description = $this->selectedService->description;
        $this->price = $this->selectedService->price;
        $this->category = $this->selectedService->category;
        $this->isActive = (bool) $this->selectedService->is_active;

        $this->isAddModalOpen = true;
    }

    public function saveService()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'category' => $this->category,
            'is_active' => (bool) $this->isActive,
        ];

        if ($this->selectedService) {
            $this->selectedService->update($data);
            $this->selectedService = null;
        } else {
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
        $this->price = '';
        $this->category = '';
        $this->isActive = true;
    }

    public function render()
    {
        $filteredServices = collect($this->services)->filter(function ($service) {
            $search = strtolower($this->searchQuery);
            return str_contains(strtolower($service['name']), $search)
                || str_contains(strtolower($service['category']), $search);
        });

        return view('livewire.admin.services', [
            'services' => $filteredServices
        ])->layout('layouts.admin');
    }
}
