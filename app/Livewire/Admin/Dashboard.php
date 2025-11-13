<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Service;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $patients = 0;
    public $patientsChange = 0;
    public $dentists = 0;
    public $activeToday = 0;
    public $appointments = 0;
    public $revenue = 0;
    public $services = 0;
    public $activeServices = 0;

    public $todayAppointments = [];
    public $upcomingAppointments = [];
    public $recentActivity = [];

    public function mount()
    {
        // 🧮 Stats
        $this->patients = Patient::count();
        $yesterdayCount = Patient::whereDate('created_at', Carbon::yesterday())->count();
        $this->patientsChange = $this->patients - $yesterdayCount;

        $this->services = Service::count();
        $this->activeServices = Service::where('is_active', true)->count();
        $this->dentists = Dentist::count();

        $today = Carbon::now()->format('l');
        $this->activeToday = Dentist::where('status', 'active')
            ->whereJsonContains('availability', [$today])
            ->count();

        // 🗓️ Appointments
        $this->todayAppointments = Appointment::whereDate('appointment_date', Carbon::today())
            ->with(['patient.user'])
            ->get()
            ->map(function ($appointment) {
                return [
                    'time' => Carbon::parse($appointment->appointment_date)->format('h:i A'),
                    'patient' => $appointment->patient->user->name ?? 'Unknown',
                    'type' => optional($appointment->service)->name ?? 'General Consultation',
                    'status' => $appointment->status,
                ];
            })->toArray();

        $this->upcomingAppointments = Appointment::whereDate('appointment_date', '>', Carbon::today())
            ->orderBy('appointment_date')
            ->take(5)
            ->with(['patient.user'])
            ->get()
            ->map(function ($appointment) {
                return [
                    'date' => Carbon::parse($appointment->appointment_date)->format('M d, Y'),
                    'time' => Carbon::parse($appointment->appointment_date)->format('h:i A'),
                    'patient' => $appointment->patient->user->name ?? 'Unknown',
                    'type' => optional($appointment->service)->name ?? 'General Consultation',
                    'status' => $appointment->status,
                ];
            })->toArray();

        // 🧾 Activity Log
        $this->recentActivity = ActivityLog::latest()
            ->take(5)
            ->get(['action', 'user', 'details', 'created_at'])
            ->map(function ($log) {
                return [
                    'action' => $log->action,
                    'patient' => $log->details ?? '',
                    'time' => $log->created_at->diffForHumans(),
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
                'value' => count($this->todayAppointments),
                'change' => '+0%',
                'color' => 'text-green-600',
                'bgColor' => 'bg-green-50',
                'icon' => 'calendar',
            ],
            [
                'title' => 'Monthly Revenue',
                'value' => '$' . $this->revenue,
                'change' => '+0%',
                'color' => 'text-purple-600',
                'bgColor' => 'bg-purple-50',
                'icon' => 'dollar-sign',
            ],
            [
                'title' => 'Total Services',
                'value' => $this->services,
                'change' => "+{$this->activeServices} active",
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
