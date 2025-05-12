    <!-- Category Form Modal -->
    <div class="modal fade" id="categoryFormModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="categoryModalLabel">
                        <i class="fas fa-{{ $isEditMode ? 'edit' : 'plus' }} me-2 text-primary"></i>
                        {{ $isEditMode ? 'Edit Category' : 'Create New Category' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="saveCategory">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                        id="name" wire:model="name" placeholder="Enter category name">
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slug" class="form-label fw-semibold">Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                        id="slug" wire:model="slug" placeholder="Enter category slug">
                                    @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-label fw-semibold">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                        id="description" wire:model="description" rows="3" placeholder="Enter category description"></textarea>
                                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="parent_id" class="form-label fw-semibold">Parent Category</label>
                                    <select class="form-select @error('parent_id') is-invalid @enderror" 
                                        id="parent_id" wire:model="parent_id">
                                        <option value="">No Parent (Top Level)</option>
                                        @foreach($parentCategories as $parentCategory)
                                            @if(!$isEditMode || $parentCategory->id != $categoryId)
                                                <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="display_order" class="form-label fw-semibold">Display Order <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('display_order') is-invalid @enderror" 
                                        id="display_order" wire:model="display_order" min="0">
                                    @error('display_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type" class="form-label fw-semibold">Category Type <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" 
                                        id="type" wire:model="type">
                                        <option value="regular">Regular</option>
                                        <option value="featured">Featured</option>
                                        <option value="promotional">Promotional</option>
                                        <option value="seasonal">Seasonal</option>
                                        <option value="special">Special</option>
                                    </select>
                                    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="visibility" class="form-label fw-semibold">Visibility <span class="text-danger">*</span></label>
                                    <select class="form-select @error('visibility') is-invalid @enderror" 
                                        id="visibility" wire:model="visibility">
                                        <option value="visible">Visible</option>
                                        <option value="hidden">Hidden</option>
                                    </select>
                                    @error('visibility') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image" class="form-label fw-semibold">Category Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                        id="image" wire:model="image" accept="image/*">
                                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    
                                    <div class="mt-2">
                                        @if($image)
                                            <label class="form-label fw-semibold">Preview:</label>
                                            <div class="img-preview border rounded p-2" style="max-width: 200px;">
                                                <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded" alt="Preview">
                                            </div>
                                        @elseif($existingImage)
                                            <label class="form-label fw-semibold">Current Image:</label>
                                            <div class="img-preview border rounded p-2" style="max-width: 200px;">
                                                <img src="{{ Storage::url($existingImage) }}" class="img-fluid rounded" alt="Current Image">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-4">
                            <button type="button" class="btn btn-light me-2 rounded-pill px-4" wire:click="cancelForm">
                                <i class="fas fa-times me-2"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-{{ $isEditMode ? 'save' : 'plus-circle' }} me-2"></i>
                                {{ $isEditMode ? 'Update Category' : 'Create Category' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-body text-center p-4">
                    <div class="mb-4">
                        <i class="fas fa-exclamation-triangle text-warning fa-4x"></i>
                    </div>
                    <h5 class="mb-3">Confirm Deletion</h5>
                    <p class="text-muted">Are you sure you want to delete this category? This action cannot be undone.</p>
                </div>
                <div class="modal-footer bg-light justify-content-center border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i> Cancel
                    </button>
                    <button type="button" class="btn btn-danger rounded-pill px-4" wire:click="deleteCategory($categoryIdBeingDeleted)">
                        <i class="fas fa-trash me-2"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Selected Confirmation Modal -->
    <div class="modal fade" id="deleteSelectedModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-body text-center p-4">
                    <div class="mb-4">
                        <i class="fas fa-exclamation-triangle text-warning fa-4x"></i>
                    </div>
                    <h5 class="mb-3">Confirm Multiple Deletion</h5>
                    <p class="text-muted">Are you sure you want to delete all selected categories? This action cannot be undone.</p>
                </div>
                <div class="modal-footer bg-light justify-content-center border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i> Cancel
                    </button>
                    <button type="button" class="btn btn-danger rounded-pill px-4" wire:click="deleteSelectedConfirmed">
                        <i class="fas fa-trash me-2"></i> Delete All
                    </button>
                </div>
            </div>
        </div>
    </div>