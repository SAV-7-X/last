<?php

namespace App\Livewire\Frontend;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Cart extends Component
{
    public $carts = [];
    public $subtotal = 0;
    public $total = 0;
    public $couponCode = '';
    public $discount = 0;
    public $couponApplied = false;
    public $couponMessage = '';

    protected $listeners = ['cartUpdated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->carts = DB::table('carts')
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->where('carts.user_id', auth()->id())
        ->select(
            'carts.id as cart_id',
            'carts.user_id',
            'carts.product_id',
            'carts.quantity', // if you track quantity in cart
            'carts.total_value',
            'carts.created_at as cart_created_at',
            'carts.updated_at as cart_updated_at',
    
            'products.id as product_id',
            'products.name as product_name',
            'products.price',
            'products.discount_price',
            'products.stock',
            'products.description',
            'products.image',
            'products.created_at as product_created_at',
            'products.updated_at as product_updated_at'
        )
        ->get();
    
    // dd($this->carts);
    

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = 0;
        foreach ($this->carts as $cart) {
        // dd($cart->discount_price);

            $price = $cart->discount_price ;
            $this->subtotal += $price * $cart->quantity;
        }

        $this->total = $this->subtotal - $this->discount;
    }

    public function increaseQuantity($cartId)
    {
        // dd($cartId);
        $cart = DB::table('carts')->where('id', $cartId)->first();
        // dd($cart);
        if (!$cart) return;

        $product = DB::table('products')->where('id', $cart->product_id)->first();

        if ($cart->quantity < $product->stock) {
            DB::table('carts')
                ->where('id', $cartId)
                ->increment('quantity');

            $this->loadCart();
            // dd('done');
            $this->dispatch('notify', ['message' => 'Cart updated successfully!']);
        } else {
            $this->dispatch('notify', ['message' => 'Maximum available quantity reached!', 'type' => 'error']);
        }
    }

    public function decreaseQuantity($cartId)
    {
        $cart = DB::table('carts')->where('id', $cartId)->first();

        if ($cart && $cart->quantity > 1) {
            DB::table('carts')
                ->where('id', $cartId)
                ->decrement('quantity');
        }

        $this->loadCart();
        $this->dispatch('notify', ['message' => 'Cart updated successfully!']);
    }

    public function removeItem($cartId)
    {
        DB::table('carts')->where('id', $cartId)->delete();

        $this->loadCart();
        $this->dispatch('notify', ['message' => 'Item removed from cart!']);
    }

    public function updateCart()
    {
        $this->loadCart();
        $this->dispatch('notify', ['message' => 'Cart updated successfully!']);
    }

    public function applyCoupon()
    {
        if (empty($this->couponCode)) {
            $this->couponMessage = 'Please enter a coupon code';
            return;
        }

        $coupon = DB::table('coupons')
            ->where('code', $this->couponCode)
            ->where('is_active', 1)
            ->where('expires_at', '>', now())
            ->first();

        if (!$coupon) {
            $this->couponApplied = false;
            $this->discount = 0;
            $this->couponMessage = 'Invalid or expired coupon code';
            $this->dispatch('notify', ['type'=>'error','message' => $this->couponMessage]);
        } else {
            $this->couponApplied = true;

            if ($coupon->type === 'fixed') {
                $this->discount = $coupon->value;
            } else {
                $this->discount = ($this->subtotal * $coupon->value) / 100;
            }

            $this->couponMessage = 'Coupon applied successfully!';
            $this->dispatch('notify', ['message' => $this->couponMessage]);
        }

        $this->calculateTotals();
    }

    public function continueShopping()
    {
        return redirect()->route('shop');
    }

    public function checkout()
    {
        if ($this->carts->isEmpty()) {
            $this->dispatch('notify', [
                'message' => 'Your cart is empty!',
                'type' => 'error'
            ]);
            return;
        }
        $this->dispatch('notify', [
            'message' => 'Sorry the checkout service is not currently available',
            'type' => 'error'
        ]);

        // return redirect()->route('checkout');
    }

    #[Layout('components.layouts.frontend')]
    public function render()
    {
        return view('livewire.frontend.cart');
    }
}
