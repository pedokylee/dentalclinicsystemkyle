<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    public $showForm = false;

    protected $listeners = ['closeDropdown' => 'closeForm'];

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.admin.header')->layout('layouts.admin');
    }
}
