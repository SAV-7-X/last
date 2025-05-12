<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class Profile extends Component
{
    use WithFileUploads;

    // User profile data
    public $name;
    public $email;
    public $phone;
    public $address;
    public $current_password;
    public $new_password;
    public $confirm_password;
    public $profile_photo;
    public $tempPhoto;
    
    // Order history
    public $orders = [];
    public $currentPage = 1;
    public $perPage = 5;
    
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'nullable|numeric',
        'address' => 'nullable|string',
        'current_password' => 'nullable|required_with:new_password',
        'new_password' => 'nullable|required_with:current_password|min:8|same:confirm_password',
        'confirm_password' => 'nullable|required_with:new_password|min:8',
        'tempPhoto' => 'nullable|image|max:1024',
    ];
    
    public function mount()
    {
        // Get user data using query builder
        $user = DB::table('users')->where('id', Auth::id())->first();
        
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone ?? '';  
            $this->address = $user->address ?? '';
            $this->profile_photo = $user->profile_photo_path;
            
            // Fetch order history
            $this->fetchOrders();
        }
    }
    
    public function fetchOrders()
    {
        $offset = ($this->currentPage - 1) * $this->perPage;
        
        // Get orders with query builder
        $this->orders = DB::table('orders')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->offset($offset)
            ->limit($this->perPage)
            ->get()
            ->toArray();
    }
    
    public function nextPage()
    {
        $totalOrders = DB::table('orders')->where('user_id', Auth::id())->count();
        $totalPages = ceil($totalOrders / $this->perPage);
        
        if ($this->currentPage < $totalPages) {
            $this->currentPage++;
            $this->fetchOrders();
        }
    }
    
    public function prevPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->fetchOrders();
        }
    }
    
    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'nullable|numeric',
            'address' => 'nullable|string',
        ]);
        
        $userData = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'updated_at' => now()
        ];
        
        // Upload profile photo if provided
        if ($this->tempPhoto) {
            $filename = 'profile-' . Auth::id() . '-' . time() . '.' . $this->tempPhoto->extension();
            $path = $this->tempPhoto->storeAs('profile-photos', $filename, 'public');
            $userData['profile_photo_path'] = $path;
            $this->profile_photo = $path;
            $this->tempPhoto = null;
        }
        
        // Update user data with query builder
        DB::table('users')
            ->where('id', Auth::id())
            ->update($userData);
            
        $this->dispatch('notify', [
            
                'type' => 'success',
                'message' => 'Profile updated successfully!'
            
        ]);
    }
    
    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required|min:8',
        ]);
        
        // Get current password from database
        $user = DB::table('users')->where('id', Auth::id())->first();
        
        // Verify current password
        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'The current password is incorrect.');
            return;
        }
        
        // Update password with query builder
        DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'password' => Hash::make($this->new_password),
                'updated_at' => now()
            ]);
            
        // Reset password fields
        $this->current_password = '';
        $this->new_password = '';
        $this->confirm_password = '';
        
        $this->dispatch('notify', [
           
                'type' => 'success',
                'message' => 'Password updated successfully!'
            
        ]);
    }
    
    public function removePhoto()
    {
        // Update user to remove profile photo with query builder
        DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'profile_photo_path' => null,
                'updated_at' => now()
            ]);
            
        $this->profile_photo = null;
        
        $this->dispatch('notify', [
            
                'type' => 'success',
                'message' => 'Profile photo removed!'
            
        ]);
    }
    #[Layout('components.layouts.frontend')]    
    public function render()
    {
        // Get total orders count for pagination
        $totalOrders = DB::table('orders')->where('user_id', Auth::id())->count();
        $totalPages = ceil($totalOrders / $this->perPage);
        
        return view('livewire.profile', [
            'totalPages' => $totalPages
        ]);
    }
    // public function render()
    // {
    //     return view('livewire.profile');
    // }
}
