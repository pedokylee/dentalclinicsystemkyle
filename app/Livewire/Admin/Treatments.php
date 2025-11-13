<?php

namespace App\Livewire\Admin;

use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Treatment;
use Livewire\Component;

class Treatments extends Component
{
    public $searchQuery = '';
    public $filterDate = '';    // Date filter
    public $filterStatus = '';  // Status filter

    public $selectedTreatment = null;
    public $patients = [];
    public $dentists = [];

    // For instant updates
    protected $updatesQueryString = ['searchQuery', 'filterDate', 'filterStatus'];

    public function mount()
    {
        $this->patients = Patient::with('user')
            ->get()
            ->sortBy(fn($p) => $p->user->name ?? '');
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
            $treatment->cost = $treatment->appointment->services->sum('price');
        }

        $treatment->save();
    }

    public function clearFilters()
    {
        $this->reset(['searchQuery', 'filterDate', 'filterStatus']);
    }

    public function render()
    {
        $treatments = Treatment::with(['patient.user', 'dentist', 'appointment.services'])
            ->when($this->searchQuery, function($query) {
                $query->where(function($q) {
                    $q->whereHas('patient.user', function($q2) {
                        $q2->where('name', 'like', "%{$this->searchQuery}%");
                    })
                    ->orWhere('procedure', 'like', "%{$this->searchQuery}%");
                });
            })
            ->when($this->filterDate, fn($q) => $q->whereDate('date', $this->filterDate))
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
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
