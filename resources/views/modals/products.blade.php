<!-- Product Modal -->
@if($showModal)
<div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-3 border-0 shadow">
            <div class="modal-header border-0 bg-primary bg-opacity-10">
                <h5 class="modal-title d-flex align-items-center">
                    <i class="fas fa-box me-2 text-primary"></i>
                    {{ $modalTitle }}
                </h5>
                <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="saveProduct">
                    <div class="row g-3">
                        <!-- Basic Information -->
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Product Name -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-tag text-primary"></i>
                                            </span>
                                            <input type="text" wire:model="name" id="name" class="form-control" placeholder="Enter product name">
                                        </div>
                                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Product Slug -->
                                    <div class="mb-3">
                                        <label for="slug" class="form-label fw-semibold">Slug <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-link text-primary"></i>
                                            </span>
                                            <input type="text" wire:model="slug" id="slug" class="form-control" placeholder="product-slug">
                                        </div>
                                        @error('slug') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- SKU -->
                                    <div class="mb-3">
                                        <label for="sku" class="form-label fw-semibold">SKU <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-barcode text-primary"></i>
                                            </span>
                                            <input type="text" wire:model="sku" id="sku" class="form-control" placeholder="Enter SKU">
                                        </div>
                                        @error('sku') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Category -->
                                    <div class="mb-0">
                                        <label for="category" class="form-label fw-semibold">Category</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-folder text-primary"></i>
                                            </span>
                                            <select wire:model="category" id="category" class="form-control">
                                                <option value="">-- Select Category --</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                        @error('category') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pricing & Inventory -->
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-dollar-sign me-2"></i>Pricing & Inventory</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Price -->
                                    <div class="mb-3">
                                        <label for="price" class="form-label fw-semibold">Price <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-dollar-sign text-primary"></i>
                                            </span>
                                            <input type="number" wire:model="price" id="price" class="form-control" placeholder="0.00" step="0.01" min="0">
                                        </div>
                                        @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Discount Price -->
                                    <div class="mb-3">
                                        <label for="discount_price" class="form-label fw-semibold">Discount Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-tag text-primary"></i>
                                            </span>
                                            <input type="number" wire:model="discount_price" id="discount_price" class="form-control" placeholder="0.00" step="0.01" min="0">
                                        </div>
                                        @error('discount_price') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Stock -->
                                    <div class="mb-3">
                                        <label for="stock" class="form-label fw-semibold">Stock <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-cubes text-primary"></i>
                                            </span>
                                            <input type="number" wire:model="stock" id="stock" class="form-control" placeholder="0" min="0">
                                        </div>
                                        @error('stock') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Status Toggles -->
                                    <div class="mb-0 d-flex justify-content-between">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" wire:model="is_active" id="is_active">
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" wire:model="is_featured" id="is_featured">
                                            <label class="form-check-label" for="is_featured">Featured</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Product Image -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-image me-2"></i>Product Image</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-0">
                                        <div class="mb-3">
                                            <label for="image" class="form-label fw-semibold">Product Image</label>
                                            <input type="file" wire:model="tempImage" id="image" class="form-control">
                                            @error('tempImage') <span class="text-danger small">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <div class="d-flex justify-content-center">
                                            @if($tempImage)
                                                <div class="text-center">
                                                    <img src="{{ $tempImage->temporaryUrl() }}" class="img-fluid rounded shadow-sm" 
                                                        style="max-height: 150px; object-fit: contain;">
                                                    <p class="small text-muted mt-2">New image preview</p>
                                                </div>
                                            @elseif($image)
                                                <div class="text-center">
                                                    <img src="{{ Storage::url($image) }}" class="img-fluid rounded shadow-sm" 
                                                        style="max-height: 150px; object-fit: contain;">
                                                    <p class="small text-muted mt-2">Current image</p>
                                                </div>
                                            @else
                                                <div class="text-center border rounded py-5 px-4 bg-light">
                                                    <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                                    <p class="small text-muted">No image selected</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tags -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-tags me-2"></i>Tags</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-0">
                                        <label for="tags" class="form-label fw-semibold">Product Tags</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-hashtag text-primary"></i>
                                            </span>
                                            <input type="text" wire:model="tags" id="tags" class="form-control" 
                                                placeholder="Enter tags separated by commas">
                                        </div>
                                        <small class="text-muted">Separate tags with commas (e.g. electronics, gadgets, sale)</small>
                                        @error('tags') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="col-md-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-align-left me-2"></i>Product Description</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-0">
                                        <textarea wire:model="description" id="description" rows="5" class="form-control" 
                                            placeholder="Enter product description"></textarea>
                                        @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="mt-4 d-flex justify-content-end">
                        <button type="button" class="btn btn-light rounded-pill me-2" wire:click="$set('showModal', false)">
                            <i class="fas fa-times me-2"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-save me-2"></i> {{ $productId ? 'Update' : 'Save' }} Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif