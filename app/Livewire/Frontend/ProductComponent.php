<?php

namespace App\Livewire\Frontend;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductComponent extends Component
{
    public $products = [];
    public $categories = [];
    public $activeCategory = 'all';
    
    protected $listeners = ['refreshProducts' => '$refresh'];
    
    public function mount()
    {
        $this->loadCategories();
        $this->loadProducts();
    }
    
    private function loadCategories()
    {
        // Fetch categories from database
        $this->categories = DB::table('categories')
            ->where('visibility', 'visible')
            ->orderBy('display_order')
            ->get(['id', 'name', 'slug'])
            ->toArray();
    }
    
    private function loadProducts()
    {
        // Query to fetch featured products for homepage
        $query = DB::table('products')
            ->select(
                'products.id', 
                'products.name', 
                'products.slug', 
                'products.price', 
                'products.discount_price', 
                'products.image', 
                'products.category', 
                'products.description', 
                'products.tags', 
                'products.is_featured'
            )
            ->where('products.is_active', 1)
            ->where('products.deleted_at', null)
            ->orderBy('products.is_featured', 'desc')
            ->orderBy('products.created_at', 'desc')
            ->limit(8);
        
        $this->products = $query->get()->toArray();
        
        // Process the products to get additional data
        foreach ($this->products as $key => $product) {
            // Convert string tags to array
            $this->products[$key]->tags_array = !empty($product->tags) ? explode(',', $product->tags) : [];
            
            // Calculate discount percentage if applicable
            if (!empty($product->discount_price) && $product->discount_price > $product->price) {
                $discountAmount = $product->discount_price - $product->price;
                $discountPercentage = round(($discountAmount / $product->discount_price) * 100);
                $this->products[$key]->discount_percentage = $discountPercentage;
            } else {
                $this->products[$key]->discount_percentage = 0;
            }
        }
    }
    
    public function setCategory($category)
    {
        $this->activeCategory = $category;
    }
    
    public function addToCart($productId)
    {
        if (!auth()->check()) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'You must be logged in to add products to cart.'
            ]);
            return redirect()->route('login');
        }
    
        // Fetch product
        $product = DB::table('products')
            ->where('id', $productId)
            ->where('is_active', 1)
            ->first(['id', 'name', 'price', 'image', 'stock' , 'discount_price' ]);
    
        if (!$product) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Product not found or inactive.'
            ]);
            return;
        }
    
        if ($product->stock <= 0) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Product is out of stock!'
            ]);
            return;
        }
    
        // Optional: Check if already in cart
        $existing = DB::table('carts')
            ->where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();
    
        if ($existing) {
            $this->dispatch('notify', [
                'type' => 'info',
                'message' => 'Product already in your cart.',
                
            ]);
            return;
        }
    
        // Add to cart
        DB::table('carts')->insert([
            'user_id'     => auth()->id(),
            'product_id'  => $productId,
            'total_value' => $product->discount_price,
            'discount_value' => $product->discount_price,
            'quantity'=> 1,
            'created_at'  => now(),
            'updated_at'  => now()
        ]);
    
        // Success message
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Product added to cart!',
            'addToCart'=>true
        ]);
        // $this->dispatch('addToCart')->to(Nav::class);
        $this->dispatch('addToCart')->to(\App\Livewire\Frontend\Nav::class);

    }
    

    public function render()
    {
        return view('livewire.frontend.product-component', [
            'products' => $this->products,
            'categories' => $this->categories
        ]);
    }
    // public function render()
    // {
    //     return view('livewire.frontend.product-component');
    // }
}
