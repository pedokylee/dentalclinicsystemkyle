<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\Auth\Login;
use App\Livewire\Admin\Dashboard;
use App\Http\Middleware\AdminMiddleware;

//normal routes for non admin users 
Route::get('/', HomePage::class);

//admin routes
Route::get('/login', Login::class)->name('login');
Route::get('/admin/dashboard', Dashboard::class)
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');



