<?php

namespace App\Livewire\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Component;

class About extends Component
{
    
    protected $listeners = ['navigationCompleted'];

    // Method to handle the event when it is emitted
    public function navigationCompleted($message)
    {
        // Handle the event and use the message passed from the JavaScript
        session()->flash('navigation_message', $message);

        // You can perform any other actions here, like updating a property
    }


    #[Layout('components.layouts.frontend')]

    public function render()
    {
        return view('livewire.frontend.about');
    }
}
