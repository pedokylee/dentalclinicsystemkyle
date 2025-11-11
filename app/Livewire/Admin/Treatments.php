<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Treatments extends Component
{
    public function render()
    {
        return view('livewire.admin.treatments')->layout('layouts.admin');
    }
}
