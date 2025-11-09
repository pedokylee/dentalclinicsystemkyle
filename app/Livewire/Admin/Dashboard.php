<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public $patients = 0;
    public $appointments = 0;
    public $revenue = 0;
    public $services = 0;
    public $dentists = 0;

    public $upcomingAppointments = [];
    public $recentActivity = [];

    public function mount()
    {
        // Initialize with empty arrays / zeros for now
        $this->upcomingAppointments = [
            ['time' => '--', 'patient' => '-', 'type' => '-', 'status' => 'pending'],
            ['time' => '--', 'patient' => '-', 'type' => '-', 'status' => 'pending'],
            ['time' => '--', 'patient' => '-', 'type' => '-', 'status' => 'pending'],
            ['time' => '--', 'patient' => '-', 'type' => '-', 'status' => 'pending'],
            ['time' => '--', 'patient' => '-', 'type' => '-', 'status' => 'pending'],
        ];

        $this->recentActivity = [
            ['action' => '-', 'patient' => '-', 'time' => '--'],
            ['action' => '-', 'patient' => '-', 'time' => '--'],
            ['action' => '-', 'patient' => '-', 'time' => '--'],
            ['action' => '-', 'patient' => '-', 'time' => '--'],
            ['action' => '-', 'patient' => '-', 'time' => '--'],
        ];
    }

    public function render()
    {
        // Prepare stats array for Blade
        $stats = [
            ['title' => 'Total Patients', 'value' => $this->patients, 'change' => '+0%', 'color' => 'text-blue-600', 'bgColor' => 'bg-blue-50', 'icon' => 'users'],
            ["title" => "Today's Appointments", 'value' => $this->appointments, 'change' => '+0%', 'color' => 'text-green-600', 'bgColor' => 'bg-green-50', 'icon' => 'calendar'],
            ['title' => 'Monthly Revenue', 'value' => '$'.$this->revenue, 'change' => '+0%', 'color' => 'text-purple-600', 'bgColor' => 'bg-purple-50', 'icon' => 'dollar-sign'],
            ['title' => 'Total Services', 'value' => $this->services, 'change' => '+0 active', 'color' => 'text-teal-600', 'bgColor' => 'bg-teal-50', 'icon' => 'briefcase'],
            ['title' => 'Active Dentists', 'value' => $this->dentists, 'change' => '+0 available today', 'color' => 'text-indigo-600', 'bgColor' => 'bg-indigo-50', 'icon' => 'user-cog'],
        ];

        return view('livewire.admin.dashboard', compact('stats'))
            ->layout('layouts.admin');
    }
}
