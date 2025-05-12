<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Product extends Component
{
    use WithPagination, WithFileUploads;

    // Form properties
    public $productId;
    public $name;
    public $slug;
    public $price;
    public $discount_price;
    public $stock;
    public $image;
    public $tempImage;
    public $category;
    public $description;
    public $sku;
    public $tags;
    public $is_featured = 0;
    public $is_active = 1;

    // Search filters
    public $searchName = '';
    public $searchSku = '';
    public $searchCategory = '';
    public $searchStatus = '';
    public $searchFeatured = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Selection
    public $selectAll = false;
    public $selectedRows = [];

    // Modal state
    public $showModal = false;
    public $modalTitle = 'Add New Product';
    public $confirmingDeletion = false;

    // Categories for dropdown
    public $categories = [];

    protected $listeners = ['refreshProducts' => '$refresh'];

    protected $queryString = [
        'searchName' => ['except' => ''],
        'searchSku' => ['except' => ''],
        'searchCategory' => ['except' => ''],
        'searchStatus' => ['except' => ''],
        'searchFeatured' => ['except' => ''],
        'perPage' => ['except' => 10],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'slug' => 'required|max:255',
        'price' => 'required|numeric|min:0',
        'discount_price' => 'nullable|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'tempImage' => 'nullable|image|max:1024',
        'category' => 'nullable|string|max:100',
        'description' => 'nullable|string',
        'sku' => 'required|string|max:100',
        'tags' => 'nullable|string',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function mount()
    {
        $this->categories = $this->getUniqueCategories();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $products = $this->getProducts();
            $this->selectedRows = collect($products->items())->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function getProductsProperty()
    {
        return $this->getProducts();
    }

    public function getProducts()
    {
        $query = DB::table('products')
            ->when($this->searchName, fn($q) => $q->where('name', 'like', "%{$this->searchName}%"))
            ->when($this->searchSku, fn($q) => $q->where('sku', 'like', "%{$this->searchSku}%"))
            ->when($this->searchCategory, fn($q) => $q->where('category', $this->searchCategory))
            ->when($this->searchStatus !== '', function($q) {
                return $q->where('is_active', $this->searchStatus === 'active' ? 1 : 0);
            })
            ->when($this->searchFeatured !== '', function($q) {
                return $q->where('is_featured', $this->searchFeatured === 'featured' ? 1 : 0);
            })
            ->orderBy($this->sortField, $this->sortDirection);
            
        return $query->paginate($this->perPage);
    }

    public function getUniqueCategories()
    {
        return DB::table('categories')
    ->select('name')
    ->distinct()
    ->pluck('name')
    ->toArray();

    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function resetFilters()
    {
        $this->searchName = '';
        $this->searchSku = '';
        $this->searchCategory = '';
        $this->searchStatus = '';
        $this->searchFeatured = '';
    }

    public function createProduct()
    {
        $this->resetForm();
        $this->modalTitle = 'Add New Product';
        $this->showModal = true;
    }

    public function editProduct($id)
    {
        $this->resetForm();
        $this->productId = $id;
        $this->modalTitle = 'Edit Product';
        
        $product = DB::table('products')->where('id', $id)->first();
        
        if (!$product) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Product not found!'
            ]);
            return;
        }
        
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->price = $product->price;
        $this->discount_price = $product->discount_price;
        $this->stock = $product->stock;
        $this->image = $product->image;
        $this->category = $product->category;
        $this->description = $product->description;
        $this->sku = $product->sku;
        $this->tags = $product->tags;
        $this->is_featured = $product->is_featured;
        $this->is_active = $product->is_active;
        
        $this->showModal = true;
    }

    public function saveProduct()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'stock' => $this->stock,
            'category' => $this->category,
            'description' => $this->description,
            'sku' => $this->sku,
            'tags' => $this->tags,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
        ];

        // Handle image upload
        if ($this->tempImage) {
            if ($this->productId) {
                $product = DB::table('products')->where('id', $this->productId)->first();
                if ($product && $product->image) {
                    Storage::delete($product->image);
                }
            }
            $data['image'] = $this->tempImage->store('products', 'public');
        }

        if ($this->productId) {
            // Update existing product
            DB::table('products')->where('id', $this->productId)->update($data);
            $message = 'Product updated successfully!';
        } else {
            // Create new product
            $data['created_at'] = now();
            $data['updated_at'] = now();
            DB::table('products')->insert($data);
            $message = 'Product created successfully!';
        }

        $this->showModal = false;
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => $message
        ]);
        
        // Refresh categories list
        $this->categories = $this->getUniqueCategories();
    }

    public function confirmProductDeletion($id)
    {
        $this->confirmingDeletion = $id;
    }

    public function deleteProduct()
    {
        $product = DB::table('products')->where('id', $this->confirmingDeletion)->first();
        
        if ($product && $product->image) {
            Storage::delete($product->image);
        }
        
        DB::table('products')->where('id', $this->confirmingDeletion)->delete();
        
        $this->confirmingDeletion = false;
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Product deleted successfully!'
        ]);
    }

    public function deleteSelected()
    {
        $products = DB::table('products')->whereIn('id', $this->selectedRows)->get();
        
        foreach ($products as $product) {
            if ($product->image) {
                Storage::delete($product->image);
            }
        }
        
        DB::table('products')->whereIn('id', $this->selectedRows)->delete();
        
        $this->selectedRows = [];
        $this->selectAll = false;
        
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => count($products) . ' products deleted successfully!'
        ]);
    }

    public function resetForm()
    {
        $this->productId = null;
        $this->name = '';
        $this->slug = '';
        $this->price = '';
        $this->discount_price = null;
        $this->stock = 0;
        $this->tempImage = null;
        $this->image = null;
        $this->category = '';
        $this->description = '';
        $this->sku = '';
        $this->tags = '';
        $this->is_featured = 0;
        $this->is_active = 1;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.product', [
            'products' => $this->getProducts(),
        ]);
    }
}