<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Models\User;
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    protected $messages = [
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Please enter your password.',
        'password.min' => 'Password must be at least 8 characters.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login()
    {
        $this->validate();

        // Check if the user exists and credentials are correct
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            // Authentication successful
            session()->regenerate();
            
            // Log the successful login
            // activity()
            //     ->causedBy(Auth::user())
            //     ->log('User logged in');

            // Redirect to dashboard or intended page
            $user = User::where('email', $this->email)->first();
            if($user->email == 'aniket_admin@gmail.com' && $user->role == 'admin')
            {
            return redirect()->intended(RouteServiceProvider::HOME);
            }
            else
            {
                // return response()->json(['message'=>'User Logged in']);
                return redirect()->to('/');
            }
        }

        // Authentication failed
        $this->addError('email', 'These credentials do not match our records.');
        
        // Optional: Log failed login attempt
        // activity()
        //     ->withProperties(['email' => $this->email])
        //     ->log('Failed login attempt');

        return null;
    }

    public function loginWithGoogle()
    {
        return redirect()->route('social.login', ['provider' => 'google']);
    }

    public function loginWithFacebook()
    {
        return redirect()->route('social.login', ['provider' => 'facebook']);
    }

    public function loginWithApple()
    {
        return redirect()->route('social.login', ['provider' => 'apple']);
    }
    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.auth');
    }
}
