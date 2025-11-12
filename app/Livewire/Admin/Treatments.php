<?php

namespace App\Livewire\Admin;

use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Treatment;
use Livewire\Component;

class Treatments extends Component
{
    public $searchQuery = '';

    public $selectedTreatment = null;

    public $patients = [];

    public $dentists = [];

    public function mount()
    {
        $this->patients = Patient::with('user')
            ->get()
            ->sortBy(fn ($p) => $p->user->name ?? '');
        $this->dentists = Dentist::where('status', 'active')->orderBy('name')->get();
    }

    public function viewTreatment($id)
    {
        $this->selectedTreatment = Treatment::with(['patient.user', 'dentist'])->findOrFail($id);
    }

    public function closeModal()
    {
        $this->selectedTreatment = null;
    }

    /** Update treatment status */
    public function updateStatus($treatmentId, $newStatus)
    {
        $treatment = Treatment::with('appointment.services')->findOrFail($treatmentId);

        $treatment->status = $newStatus;

        if ($newStatus === 'completed' && $treatment->appointment) {
            // Calculate cost based on appointment services
            $treatment->cost = $treatment->appointment->services->sum('price');
        }

        $treatment->save();
    }

    public function render()
    {
        $treatments = Treatment::with(['patient.user', 'dentist'])
            ->whereHas('patient.user', function ($query) {
                $query->where('name', 'like', "%{$this->searchQuery}%");
            })
            ->orWhere('procedure', 'like', "%{$this->searchQuery}%")
            ->orderByDesc('date')
            ->get();

        $totalRevenue = $treatments->where('status', 'completed')->sum('cost');
        $completedCount = $treatments->where('status', 'completed')->count();
        $inProgressCount = $treatments->where('status', 'in-progress')->count();

        return view('livewire.admin.treatments', [
            'treatments' => $treatments,
            'totalRevenue' => $totalRevenue,
            'completedCount' => $completedCount,
            'inProgressCount' => $inProgressCount,
        ])->layout('layouts.admin');
    }
}
