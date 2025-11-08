<?php

use Illuminate\Support\Facades\Route;
//admin/auth
use App\Livewire\Auth\Login;
use App\Livewire\Admin\Dashboard;
use App\Http\Middleware\AdminMiddleware;
//normal routes
use App\Livewire\HomePage;
use App\Livewire\Pages\Appointments;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Clients;
use App\Livewire\Pages\Locations;
use App\Livewire\Pages\Services;




//normal routes/public page
//normal routes for the public 
Route::get('/', HomePage::class);
Route::get('/about', About::class);
Route::get('/clients', Clients::class);
Route::get('/locations', Locations::class);
Route::get('/services', Services::class);
Route::get('/appointment', Appointments::class);

//admin middleware
Route::get('/login', Login::class);
Route::get('/admin/dashboard', Dashboard::class)
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');



