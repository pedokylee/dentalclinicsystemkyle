<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    //patient components
    public $patients = 0;
    public $patientsChange = 0;

    //dentist components
    public $dentists = 0;
    public $activeToday = 0;
    public $appointments = 0;

    public $revenue = 0;

    public $services = 0;
    
    

    public $upcomingAppointments = [];

    public $recentActivity = [];


   


    public function mount()
    {
        // Count total patients
        $this->patients = Patient::count();

        // Count patients added yesterday
        $yesterdayCount = Patient::whereDate('created_at', Carbon::yesterday())->count();

        // Change compared to yesterday
        $this->patientsChange = $this->patients - $yesterdayCount;

        // // Count today's appointments (optional: filter by date)
        // $this->appointments = Appointment::whereDate('date', now())->count();

        // // Example: total revenue (sum of invoice amounts)
        // $this->revenue = \App\Models\Invoice::sum('amount');

        // // Example: total services
        // $this->services = \App\Models\Service::count();

        // Example: total active dentists
        // Count total active dentists
        $this->dentists = Dentist::count();

        // Count active dentists today
        $today = Carbon::now()->format('l'); // "Monday"

        $this->activeToday = Dentist::where('status', 'active')
            ->whereJsonContains('availability', [$today]) // wrap in array
            ->count();

        // Initialize upcoming appointments (optional real query)
        // $this->upcomingAppointments = Appointment::with('patient')
        //     ->whereDate('date', now())
        //     ->orderBy('time')
        //     ->take(5)
        //     ->get()
        //     ->map(function ($appt) {
        //         return [
        //             'time' => $appt->time,
        //             'patient' => $appt->patient->user->name ?? '-',
        //             'type' => $appt->type ?? '-',
        //             'status' => $appt->status ?? 'pending',
        //         ];
        //     })->toArray();

        // Initialize recent activity (optional real query)
        $this->recentActivity = Patient::latest()
            ->take(5)
            ->get()
            ->map(function ($patient) {
                return [
                    'action' => 'Patient added',
                    'patient' => $patient->user->name,
                    'time' => $patient->created_at->diffForHumans(),
                ];
            })->toArray();
    }

    public function render()
    {

        $stats = [
            [
                'title' => 'Total Patients',
                'value' => $this->patients,
                'change' => $this->patientsChange > 0 
                    ? "+{$this->patientsChange}%" 
                    : ($this->patientsChange < 0 ? "{$this->patientsChange}%" : "+0%"),
                'color' => 'text-blue-600',
                'bgColor' => 'bg-blue-50',
                'icon' => 'users',
            ],
            [
                'title' => "Today's Appointments",
                'value' => $this->appointments,
                'change' => '+0%',
                'color' => 'text-green-600',
                'bgColor' => 'bg-green-50',
                'icon' => 'calendar',
            ],
            [
                'title' => 'Monthly Revenue',
                'value' => '$'.$this->revenue,
                'change' => '+0%',
                'color' => 'text-purple-600',
                'bgColor' => 'bg-purple-50',
                'icon' => 'dollar-sign',
            ],
            [
                'title' => 'Total Services',
                'value' => $this->services,
                'change' => '+0 active',
                'color' => 'text-teal-600',
                'bgColor' => 'bg-teal-50',
                'icon' => 'briefcase',
            ],
            [
                'title' => 'Active Dentists',
                'value' => $this->dentists,
                'change' => "+{$this->activeToday} available today",
                'color' => 'text-indigo-600',
                'bgColor' => 'bg-indigo-50',
                'icon' => 'user-cog',
            ],
        ];

        return view('livewire.admin.dashboard', compact('stats'))
            ->layout('layouts.admin');
    }
}
