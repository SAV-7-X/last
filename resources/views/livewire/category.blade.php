
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12" data-aos="fade-up" data-aos-duration="800">
            <div class="card border-0 rounded-1 mb-4 overflow-hidden" style="box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.347);">
                <!-- Card Header with Elegant Styling -->
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="mb-0 d-flex align-items-center">
                        <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="fas fa-folder text-light"></i>
                        </span>
                        <span class="fw-bold">Categories Management</span>
                    </h5>
                    <button wire:click="createCategory" class="btn btn-primary btn-sm d-flex align-items-center rounded-pill px-3 py-2">
                        <i class="fas fa-plus me-2"></i> Add New Category
                    </button>
                </div>
                
                <div class="card-body">
                    <!-- Search Filters with Enhanced UI -->
                    <div class="bg-light p-4 mb-4 rounded-3 border-start border-primary border-4 shadow-sm" data-aos="fade-right" data-aos-duration="600">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-tag text-primary opacity-50"></i>
                                    </span>
                                    <input wire:model.live="searchName" type="text" 
                                        class="form-control border-0" placeholder="Search by name...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-link text-primary opacity-50"></i>
                                    </span>
                                    <input wire:model.live="searchSlug" type="text" 
                                        class="form-control border-0" placeholder="Search by slug...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-sitemap text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.live="searchType" class="form-select border-0">
                                        <option value="">All Types</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-eye text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.live="searchVisibility" class="form-select border-0">
                                        <option value="">All Visibility</option>
                                        <option value="visible">Visible</option>
                                        <option value="hidden">Hidden</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-folder-tree text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.live="searchParentId" class="form-select border-0">
                                        <option value="">All Categories</option>
                                        @foreach($parentCategories as $parentCategory)
                                            <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-list-ol text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.live="perPage" class="form-select border-0">
                                        <option value="10">10 per page</option>
                                        <option value="25">25 per page</option>
                                        <option value="50">50 per page</option>
                                        <option value="100">100 per page</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-3">
                            <button wire:click="resetFilters" class="btn btn-light me-2 rounded-pill px-3 shadow-sm">
                                <i class="fas fa-redo me-2"></i> Reset Filters
                            </button>
                            <button wire:click="deleteSelected" class="btn btn-danger rounded-pill px-3 shadow-sm" 
                                @if(empty($selectedRows)) disabled @endif>
                                <i class="fas fa-trash me-2"></i> Delete Selected
                                @if(!empty($selectedRows))
                                    <span class="badge bg-white text-danger ms-1">{{ count($selectedRows) }}</span>
                                @endif
                            </button>
                        </div>
                    </div>
                    
                    <!-- Categories Table with Enhanced Styling -->
                    <div class="table-responsive shadow-sm rounded-3 border" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th width="40" class="ps-3">
                                        <div class="form-check d-flex justify-content-center">
                                            <input wire:model.live="selectAll" class="form-check-input" 
                                                type="checkbox" id="selectAll">
                                        </div>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold">
                                        <a href="#" wire:click.prevent="sortBy('name')" 
                                            class="d-flex align-items-center text-dark text-decoration-none">
                                            Category 
                                            @if($sortField === 'name')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold">
                                        <a href="#" wire:click.prevent="sortBy('slug')" 
                                            class="d-flex align-items-center text-dark text-decoration-none">
                                            Slug 
                                            @if($sortField === 'slug')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold">
                                        <a href="#" wire:click.prevent="sortBy('type')" 
                                            class="d-flex align-items-center text-dark text-decoration-none">
                                            Type 
                                            @if($sortField === 'type')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold text-center">
                                        <a href="#" wire:click.prevent="sortBy('visibility')" 
                                            class="d-flex align-items-center justify-content-center text-dark text-decoration-none">
                                            Visibility 
                                            @if($sortField === 'visibility')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold text-center">
                                        <a href="#" wire:click.prevent="sortBy('display_order')" 
                                            class="d-flex align-items-center justify-content-center text-dark text-decoration-none">
                                            Order
                                            @if($sortField === 'display_order')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr class="align-middle">
                                        <td class="ps-3">
                                            <div class="form-check d-flex justify-content-center">
                                                <input wire:model.live="selectedRows" value="{{ $category->id }}" 
                                                    class="form-check-input" type="checkbox">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-2">
                                                @if($category->image)
                                                    <div class="avatar-wrapper rounded-3 overflow-hidden me-3 shadow-sm border border-2 border-white" style="width: 40px; height: 40px;">
                                                        <img src="{{ Storage::url($category->image) }}" 
                                                            class="w-100 h-100 object-fit-cover" alt="{{ $category->name }}">
                                                    </div>
                                                @else
                                                    <div class="avatar-wrapper rounded-3 me-3 shadow-sm 
                                                        bg-primary bg-opacity-10 text-light 
                                                        d-flex align-items-center justify-content-center border border-2 border-white"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="fas fa-folder-open"></i>
                                                    </div>
                                                @endif
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm fw-semibold">{{ $category->name }}</h6>
                                                    @if($category->parent_id)
                                                        <p class="text-muted small mb-0">
                                                            <i class="fas fa-folder-tree me-1"></i>
                                                            {{ $parentCategories->where('id', $category->parent_id)->first()->name ?? 'Parent' }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                {{ $category->slug }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                {{ ucfirst($category->type) }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($category->visibility === 'visible')
                                                <span class="badge bg-success bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                    <i class="fas fa-eye me-1" style="font-size: 10px;"></i>
                                                    Visible
                                                </span>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                    <i class="fas fa-eye-slash me-1" style="font-size: 10px;"></i>
                                                    Hidden
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="badge bg-info bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                {{ $category->display_order }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="btn-group" role="group">
                                                <button wire:click="editCategory({{ $category->id }})" 
                                                    class="btn btn-sm btn-light text-primary rounded-pill me-1" title="Edit">
                                                    <i class="fas fa-edit fs-6"></i>
                                                </button>
                                                <button wire:click="confirmCategoryDeletion({{ $category->id }})" 
                                                    class="btn btn-sm btn-danger rounded-pill" title="Delete">
                                                    <i class="fas fa-trash fs-6"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="empty-state-icon bg-light p-4 rounded-circle mb-3 shadow-sm">
                                                    <i class="fas fa-folder-open fa-3x text-primary opacity-50"></i>
                                                </div>
                                                <h5 class="text-dark">No categories found</h5>
                                                <p class="text-muted mb-3">Try adjusting your search filters</p>
                                                <button wire:click="resetFilters" class="btn btn-primary rounded-pill px-4">
                                                    <i class="fas fa-redo me-2"></i> Reset Filters
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination with Enhanced Styling -->
                    <div class="d-flex justify-content-center justify-content-md-between align-items-center py-3 mt-3" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
                        <div class="d-none d-md-block text-muted">
                            Showing <span class="fw-semibold">{{ $categories->firstItem() ?: 0 }}</span> to 
                            <span class="fw-semibold">{{ $categories->lastItem() ?: 0 }}</span> of 
                            <span class="fw-semibold">{{ $categories->total() }}</span> categories
                        </div>
                        
                        <div>
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    @include('modals.category')
    @include('scripts.category')
    @include('styles.users')
 
    <!-- Toast Container with Enhanced UI -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="toastContainer" class="toast-container"></div>
    </div>
    
    <!-- JavaScript for handling modals and notifications -->
    
</div>

