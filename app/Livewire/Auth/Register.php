<?php

namespace App\Livewire\Auth;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Livewire\Component;
use Laravel\Socialite\Facades\Socialite;
class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $terms = false;
    public $remember = false;

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'terms' => 'required|accepted',
    ];

    protected $messages = [
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered.',
        'name.required' => 'Please enter your full name.',
        'password.required' => 'Please enter a password.',
        'password.min' => 'Your password must be at least 8 characters.',
        'password.confirmed' => 'Your password confirmation does not match.',
        'terms.required' => 'You must agree to our Terms of Service and Privacy Policy.',
        'terms.accepted' => 'You must agree to our Terms of Service and Privacy Policy.',
    ];

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user, $this->remember);

        return redirect()->intended(route('login'));
    }

    public function registerWithGoogle()
    {
        return $this->socialRegister('google');
    }

    public function registerWithFacebook()
    {
        return $this->socialRegister('facebook');
    }

    public function registerWithApple()
    {
        return $this->socialRegister('apple');
    }

    protected function socialRegister($provider)
    {
        session()->put('auth.register', true);
        return redirect()->route('socialite.redirect', ['provider' => $provider]);
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('components.layouts.auth');
    }
}
