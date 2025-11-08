<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class Navbar extends Component
{
    // public $mobileMenuOpen = false;

    // public function toggleMobileMenu()
    // {
    //     $this->mobileMenuOpen = !$this->mobileMenuOpen;
    // }

      public function toAbout(){
        return redirect()->to('/about');
    }

      public function toDentist(){
        return redirect()->to('/clients');
    }

      public function toLocations(){
        return redirect()->to('/locations');
    }

      public function toServices(){
        return redirect()->to('/services');
    }

    public function toAppointment(){
        return redirect()->to('/appointment');
    }

  

    
    public function render()
    {
        return view('livewire.partials.navbar')->layout('layouts.app');
    }
}
