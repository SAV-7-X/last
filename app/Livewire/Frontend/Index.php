<?php

namespace App\Livewire\Frontend;

use DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout('components.layouts.frontend')]

    public function render()
    {
        $products = DB::table('products')->select('*')->get();
        return view('livewire.frontend.index',[
            'products'=>$products
        ]);
    }
}
