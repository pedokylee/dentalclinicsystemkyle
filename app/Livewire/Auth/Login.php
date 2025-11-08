<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';

    public $password = '';

    public $errorMessage = '';

    public $successMessage = '';

    // real time validation applied hehe
    protected function rules()
    {
        return [
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@(gmail|yahoo|clinic)\.com$/'],
            'password' => 'required|min:3',
        ];
    }

    protected function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.regex' => 'Only Gmail or Yahoo or clinic for testing emails are allowed.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // login
    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }
        } else {
            $this->errorMessage = 'Invalid email or password.';
            session()->flash('error', $this->errorMessage);
        }
    }

    public function toPublicPage(){
        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.admin');
    }
}
