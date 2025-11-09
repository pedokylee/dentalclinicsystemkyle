<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Settings extends Component
{
    public $name;
    public $email;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Profile updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.settings')->layout('layouts.admin');
    }
}
