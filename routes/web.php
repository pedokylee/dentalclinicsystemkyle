<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Livewire Components
use App\Livewire\HomePage;
use App\Livewire\Pages\Appointments as PublicAppointments;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Clients;
use App\Livewire\Pages\Locations;
use App\Livewire\Pages\Services as PublicServices;
use App\Livewire\Auth\Login;

// Admin Livewire Components
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Patients;
use App\Livewire\Admin\Appointments as AdminAppointments;
use App\Livewire\Admin\Treatments;
use App\Livewire\Admin\Services as AdminServices;
use App\Livewire\Admin\Dentists;
use App\Livewire\Admin\Settings;

// Public routes
Route::get('/', HomePage::class);
Route::get('/about', About::class);
Route::get('/clients', Clients::class);
Route::get('/locations', Locations::class);
Route::get('/services', PublicServices::class);
Route::get('/appointment', PublicAppointments::class);
Route::get('/login', Login::class);

// Admin routes (middleware stays the same)
Route::get('/admin/dashboard', Dashboard::class)
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

Route::get('/admin/patients', Patients::class)
    ->middleware(['auth', 'admin'])
    ->name('admin.patients');

Route::get('/admin/appointments', AdminAppointments::class)
    ->middleware(['auth', 'admin'])
    ->name('admin.appointments');

Route::get('/admin/treatments', Treatments::class)
    ->middleware(['auth', 'admin'])
    ->name('admin.treatments');

Route::get('/admin/services', AdminServices::class)
    ->middleware(['auth', 'admin'])
    ->name('admin.services');

Route::get('/admin/dentists', Dentists::class)
    ->middleware(['auth', 'admin'])
    ->name('admin.dentists');

Route::get('/admin/settings', Settings::class)
    ->middleware(['auth', 'admin'])
    ->name('admin.settings');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
