<?php

namespace App\Livewire\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Hero extends Component
{
    public $typedStrings = [
        'Luxury Furniture',
        'Timeless Elegance',
        'Modern Designs',
        'Premium Quality',
        'Exquisite Craftsmanship'
    ];

    #[Layout('components.layouts.frontend')]
    public function render()
    {
        return view('livewire.frontend.hero');
    }
}
