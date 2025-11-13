<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class Navbar extends Component
{
    public $mobileMenuOpen = false;

    public function toAbout()
    {
        $this->mobileMenuOpen = false;
        return redirect()->to('/about');
    }

    public function toDentist()
    {
        $this->mobileMenuOpen = false;
        return redirect()->to('/clients');
    }

    public function toLocations()
    {
        $this->mobileMenuOpen = false;
        return redirect()->to('/locations');
    }

    public function toServices()
    {
        $this->mobileMenuOpen = false;
        return redirect()->to('/services');
    }

    public function toAppointment()
    {
        $this->mobileMenuOpen = false;
        return redirect()->to('/appointment');
    }

    public function render()
    {
        return view('livewire.partials.navbar')->layout('layouts.app');
    }
}