<?php

namespace App\Livewire;

use Livewire\Component;

class HomePage extends Component
{
    // public $mobileMenuOpen = false;

    // public function toggleMobileMenu()
    // {
    //     $this->mobileMenuOpen = !$this->mobileMenuOpen;
    // }

    public function toAppointment(){
        return redirect()->to('/appointment');
    }

    public function render()
    {
        return view('livewire.home-page')->layout('layouts.app');
    }
}
