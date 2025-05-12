<?php

namespace App\Livewire\Frontend;

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Nav extends Component
{
     // Listens for the 'navigationCompleted' event
     public $cartCount = 0;
     public $isLoggedIn = false;
     public $user_name;
     public $productCount = 0;
 
     public function mount()
     {
         // Check if user is logged in
         $this->isLoggedIn = auth()->check();
         if ($this->isLoggedIn) {
            $this->user_name = auth()->user()->name;
         }
         $this->getProductsCount();
         
         // Get cart count from session or database
         // This is just a placeholder - implement according to your cart system
         if (session()->has('cart')) {
             $this->cartCount = count(session('cart'));
         }
     }
     public function logout()
     {
        $this->isLoggedIn = false;
        Auth::logout();
        session()->flush();
        return redirect('/');
     }
     public function refreshComponent()
     {
         // This will trigger a re-render of the component
         $this->render();
     }

     #[Layout('components.layouts.frontend')]
     public function render()
    {
        return view('livewire.frontend.nav');
    }

    
    #[On('addToCart')]
    public function getProductsCount()
    {
        if (auth()->check()) {
            $this->productCount = DB::table('carts')
                ->where('user_id', auth()->id())
                ->count();
        } else {
            $this->productCount = 0;
        }
    }
    
}
