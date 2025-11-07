<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class Navbar extends Component
{
    public $mobileMenuOpen = false;

    public function toggleMobileMenu()
    {
        $this->mobileMenuOpen = !$this->mobileMenuOpen;
    }
    
    public function render()
    {
        return view('livewire.partials.navbar')->layout('layouts.app');
    }
}
