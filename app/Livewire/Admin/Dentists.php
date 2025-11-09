<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Dentists extends Component
{
    public function render()
    {
        return view('livewire.admin.dentists')->layout('layouts.admin');
    }
}
