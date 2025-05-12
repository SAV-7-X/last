<?php

namespace App\Livewire;

// use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Category extends Component
{
    use WithPagination, WithFileUploads;

    // Search and filtering variables
    public $searchName = '';
    public $searchSlug = '';
    public $searchType = '';
    public $searchVisibility = '';
    public $searchParentId = '';
    public $sortField = 'display_order';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $selectedRows = [];
    public $selectAll = false;

    // For category editing/creation
    public $categoryId = null;
    public $name = '';
    public $slug = '';
    public $description = '';
    public $parent_id = null;
    public $image = null;
    public $existingImage = null; 
    public $display_order = 0;
    public $type = 'regular';
    public $visibility = 'visible';
    public $filters = [];
    public $featured_products = [];
    public $isEditMode = false;

    // Query string parameters for persistent filtering
    protected $queryString = [
        'searchName' => ['except' => ''],
        'searchSlug' => ['except' => ''],
        'searchType' => ['except' => ''],
        'searchVisibility' => ['except' => ''],
        'searchParentId' => ['except' => ''],
        'sortField' => ['except' => 'display_order'],
        'sortDirection' => ['except' => 'asc'],
        'perPage' => ['except' => 10],
    ];

    // Listeners
    protected $listeners = ['deleteConfirmed' => 'deleteCategory'];

    // Validation rules
    protected $rules = [
        'name' => 'required|min:2',
        'slug' => 'required|unique:categories,slug',
        'description' => 'nullable',
        'parent_id' => 'nullable|exists:categories,id',
        'image' => 'nullable|image|max:1024',
        'display_order' => 'required|integer|min:0',
        'type' => 'required|in:regular,featured,promotional,seasonal,special',
        'visibility' => 'required|in:visible,hidden',
        'filters' => 'nullable|array',
        'featured_products' => 'nullable|array',
    ];

    // Reset page for each filter update
    public function updatingSearchName() { $this->resetPage(); }
    public function updatingSearchSlug() { $this->resetPage(); }
    public function updatingSearchType() { $this->resetPage(); }
    public function updatingSearchVisibility() { $this->resetPage(); }
    public function updatingSearchParentId() { $this->resetPage(); }
    public function updatingPerPage() { $this->resetPage(); }

    // Generate slug from name
    public function updatedName($value)
    {
        if (!$this->isEditMode || empty($this->slug)) {
            $this->slug = Str::slug($value);
        }
    }

    // Sort functionality
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    // Main render method
    public function render()
    {
        $query = DB::table('categories')
            ->when($this->searchName, function ($query) {
                return $query->where('name', 'like', '%' . $this->searchName . '%');
            })
            ->when($this->searchSlug, function ($query) {
                return $query->where('slug', 'like', '%' . $this->searchSlug . '%');
            })
            ->when($this->searchType, function ($query) {
                return $query->where('type', $this->searchType);
            })
            ->when($this->searchVisibility, function ($query) {
                return $query->where('visibility', $this->searchVisibility);
            })
            ->when($this->searchParentId, function ($query) {
                return $query->where('parent_id', $this->searchParentId);
            })
            ->orderBy($this->sortField, $this->sortDirection);
            
        $categories = $query->paginate($this->perPage);

        // Get distinct types and parent categories for filters
        $types = DB::table('categories')->distinct()->pluck('type')->filter();
        $parentCategories = DB::table('categories')->whereNull('parent_id')->get();
        
        return view('livewire.category', [
            'categories' => $categories,
            'types' => $types,
            'parentCategories' => $parentCategories,
        ]);
    }

    // Reset all filters
    public function resetFilters()
    {
        $this->reset(['searchName', 'searchSlug', 'searchType', 'searchVisibility', 'searchParentId']);
        $this->resetPage();
    }

    // Show delete confirmation
    public function confirmCategoryDeletion($categoryId)
    {
        $this->dispatch('show-delete-confirmation', ['categoryId' => $categoryId]);
    }

    // Delete a single category
    public function deleteCategory($categoryId)
    {
        $category = DB::table('categories')->where('id', $categoryId)->first();
        
        if ($category) {
            // Delete the image file if exists
            if ($category->image) {
                // Assuming image is stored in storage/app/public
                if (file_exists(storage_path('app/public/' . $category->image))) {
                    unlink(storage_path('app/public/' . $category->image));
                }
            }
            
            DB::table('categories')->where('id', $categoryId)->delete();
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Category deleted successfully!'
            ]);
        }
    }

    // Delete multiple selected categories
    public function deleteSelected()
    {
        if (empty($this->selectedRows)) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'No categories selected for deletion!'
            ]);
            return;
        }

        $this->dispatch('show-delete-selected-confirmation');
    }

    // Confirm and process bulk deletion
    public function deleteSelectedConfirmed()
    {
        $categories = DB::table('categories')->whereIn('id', $this->selectedRows)->get();
        
        foreach ($categories as $category) {
            if ($category->image) {
                if (file_exists(storage_path('app/public/' . $category->image))) {
                    unlink(storage_path('app/public/' . $category->image));
                }
            }
        }
        
        DB::table('categories')->whereIn('id', $this->selectedRows)->delete();
        
        $this->selectedRows = [];
        $this->selectAll = false;
        
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Selected categories deleted successfully!'
        ]);
    }

    // Handle select all checkbox
    public function updatedSelectAll($value)
    {
        if ($value) {
            $query = DB::table('categories')
                ->when($this->searchName, function ($query) {
                    return $query->where('name', 'like', '%' . $this->searchName . '%');
                })
                ->when($this->searchSlug, function ($query) {
                    return $query->where('slug', 'like', '%' . $this->searchSlug . '%');
                })
                ->when($this->searchType, function ($query) {
                    return $query->where('type', $this->searchType);
                })
                ->when($this->searchVisibility, function ($query) {
                    return $query->where('visibility', $this->searchVisibility);
                })
                ->when($this->searchParentId, function ($query) {
                    return $query->where('parent_id', $this->searchParentId);
                });
                
            $this->selectedRows = $query->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    // Initialize create category form
    public function createCategory()
    {
        $this->resetValidation();
        $this->resetCategoryForm();
        $this->isEditMode = false;
        
        // Set default values
        $this->display_order = DB::table('categories')->max('display_order') + 1;
        $this->type = 'regular';
        $this->visibility = 'visible';
        
        $this->dispatch('show-form');
    }

    // Initialize edit category form
    public function editCategory($categoryId)
    {
        $this->resetValidation();
        $this->isEditMode = true;
        $this->categoryId = $categoryId;
        
        $category = DB::table('categories')->where('id', $categoryId)->first();
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
        $this->parent_id = $category->parent_id;
        $this->existingImage = $category->image;
        $this->display_order = $category->display_order;
        $this->type = $category->type;
        $this->visibility = $category->visibility;
        $this->filters = json_decode($category->filters, true) ?: [];
        $this->featured_products = json_decode($category->featured_products, true) ?: [];
        
        $this->dispatch('show-form');
    }

    // Save (create or update) category
    public function saveCategory()
    {
        if ($this->isEditMode) {
            $this->validate([
                'name' => 'required|min:2',
                'slug' => 'required|unique:categories,slug,' . $this->categoryId,
                'description' => 'nullable',
                'parent_id' => 'nullable|exists:categories,id',
                'image' => 'nullable|image|max:1024',
                'display_order' => 'required|integer|min:0',
                'type' => 'required|in:regular,featured,promotional,seasonal,special',
                'visibility' => 'required|in:visible,hidden',
            ]);
        } else {
            $this->validate();
        }

        // Prevent a category from being its own parent
        if ($this->isEditMode && $this->categoryId == $this->parent_id) {
            $this->addError('parent_id', 'A category cannot be its own parent');
            return;
        }
        
        // Handle image upload
        $imagePath = $this->existingImage;
        if ($this->image) {
            $imagePath = $this->image->store('categories', 'public');
            
            // Delete old image if updating
            if ($this->isEditMode && $this->existingImage) {
                if (file_exists(storage_path('app/public/' . $this->existingImage))) {
                    unlink(storage_path('app/public/' . $this->existingImage));
                }
            }
        }

        $categoryData = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'parent_id' => $this->parent_id ?: null,
            'display_order' => $this->display_order,
            'type' => $this->type,
            'visibility' => $this->visibility,
            'filters' => json_encode($this->filters),
            'featured_products' => json_encode($this->featured_products),
        ];
        
        if ($imagePath) {
            $categoryData['image'] = $imagePath;
        }

        if ($this->isEditMode) {
            DB::table('categories')->where('id', $this->categoryId)->update($categoryData);
            
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Category updated successfully!'
            ]);
        } else {
            DB::table('categories')->insert($categoryData);
            
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Category created successfully!'
            ]);
        }

        $this->dispatch('hide-form');
        $this->resetCategoryForm();
    }

    // Reset form fields
    public function resetCategoryForm()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->parent_id = null;
        $this->image = null;
        $this->existingImage = null;
        $this->display_order = 0;
        $this->type = 'regular';
        $this->visibility = 'visible';
        $this->filters = [];
        $this->featured_products = [];
    }

    // Cancel form action
    public function cancelForm()
    {
        $this->dispatch('hide-form');
        $this->resetCategoryForm();
    }
}