<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12" data-aos="fade-up" data-aos-duration="800">
            <div class="card border-0 rounded-1 mb-4 overflow-hidden" style="box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.347);">
                <!-- Card Header with Elegant Styling -->
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="mb-0 d-flex align-items-center">
                        <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="fas fa-box text-light"></i>
                        </span>
                        <span class="fw-bold">Products Management</span>
                    </h5>
                    <button wire:click="createProduct" class="btn btn-primary btn-sm d-flex align-items-center rounded-pill px-3 py-2">
                        <i class="fas fa-plus me-2"></i> Add New Product
                    </button>
                </div>
                
                <div class="card-body">
                    <!-- Search Filters with Enhanced UI -->
                    <div class="bg-light p-4 mb-4 rounded-3 border-start border-primary border-4 shadow-sm" data-aos="fade-right" data-aos-duration="600">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-search text-primary opacity-50"></i>
                                    </span>
                                    <input wire:model.live="searchName" type="text" 
                                        class="form-control border-0" placeholder="Search by name...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-barcode text-primary opacity-50"></i>
                                    </span>
                                    <input wire:model.live="searchSku" type="text" 
                                        class="form-control border-0" placeholder="Search by SKU...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-folder text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.live="searchCategory" class="form-select border-0">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-toggle-on text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.live="searchStatus" class="form-select border-0">
                                        <option value="">All Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-star text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.live="searchFeatured" class="form-select border-0">
                                        <option value="">All Products</option>
                                        <option value="featured">Featured</option>
                                        <option value="not_featured">Not Featured</option>
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
                    
                    <!-- Products Table with Enhanced Styling -->
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
                                            Product 
                                            @if($sortField === 'name')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold">
                                        <a href="#" wire:click.prevent="sortBy('price')" 
                                            class="d-flex align-items-center text-dark text-decoration-none">
                                            Price 
                                            @if($sortField === 'price')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold">
                                        <a href="#" wire:click.prevent="sortBy('stock')" 
                                            class="d-flex align-items-center text-dark text-decoration-none">
                                            Stock 
                                            @if($sortField === 'stock')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold">
                                        <a href="#" wire:click.prevent="sortBy('category')" 
                                            class="d-flex align-items-center text-dark text-decoration-none">
                                            Category 
                                            @if($sortField === 'category')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold text-center">
                                        <a href="#" wire:click.prevent="sortBy('is_active')" 
                                            class="d-flex align-items-center justify-content-center text-dark text-decoration-none">
                                            Status 
                                            @if($sortField === 'is_active')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold text-center">
                                        <a href="#" wire:click.prevent="sortBy('is_featured')" 
                                            class="d-flex align-items-center justify-content-center text-dark text-decoration-none">
                                            Featured
                                            @if($sortField === 'is_featured')
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
                                @forelse($products as $product)
                                    <tr class="align-middle">
                                        <td class="ps-3">
                                            <div class="form-check d-flex justify-content-center">
                                                <input wire:model.live="selectedRows" value="{{ $product->id }}" 
                                                    class="form-check-input" type="checkbox">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-2">
                                                @if($product->image)
                                                    <div class="avatar-wrapper rounded-3 overflow-hidden me-3 shadow-sm border border-2 border-white" style="width: 40px; height: 40px;">
                                                        <img src="{{ Storage::url($product->image) }}" 
                                                            class="w-100 h-100 object-fit-cover" alt="{{ $product->name }}">
                                                    </div>
                                                @else
                                                    <div class="avatar-wrapper rounded-3 me-3 shadow-sm 
                                                        bg-primary bg-opacity-10 text-light 
                                                        d-flex align-items-center justify-content-center border border-2 border-white"
                                                        style="width: 40px; height: 40px;">
                                                        <i class="fas fa-box"></i>
                                                    </div>
                                                @endif
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm fw-semibold">{{ $product->name }}</h6>
                                                    <p class="text-muted small mb-0">
                                                        <i class="fas fa-barcode me-1"></i>
                                                        {{ $product->sku }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="badge bg-success bg-opacity-10 text-light py-2 px-3 rounded-pill mb-1">
                                                    {{ number_format($product->price, 2) }}
                                                </span>
                                                @if($product->discount_price)
                                                    <span class="badge bg-danger bg-opacity-10 text-light py-2 px-3 rounded-pill small">
                                                        Discount: {{ number_format($product->discount_price, 2) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $product->stock > 10 ? 'bg-success' : ($product->stock > 0 ? 'bg-warning' : 'bg-danger') }} bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                {{ $product->stock }} units
                                            </span>
                                        </td>
                                        <td>
                                            @if($product->category)
                                                <span class="badge bg-primary bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                    {{ ucfirst($product->category) }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                    Uncategorized
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($product->is_active)
                                                <span class="badge bg-success bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                    <i class="fas fa-check-circle me-1" style="font-size: 10px;"></i>
                                                    Active
                                                </span>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                    <i class="fas fa-times-circle me-1" style="font-size: 10px;"></i>
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($product->is_featured)
                                                <span class="badge bg-warning bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                    <i class="fas fa-star me-1" style="font-size: 10px;"></i>
                                                    Featured
                                                </span>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                    <i class="far fa-star me-1" style="font-size: 10px;"></i>
                                                    Standard
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="btn-group" role="group">
                                                <button wire:click="editProduct({{ $product->id }})" 
                                                    class="btn btn-sm btn-light text-primary rounded-pill me-1" title="Edit">
                                                    <i class="fas fa-edit fs-6"></i>
                                                </button>
                                                <button wire:click="confirmProductDeletion({{ $product->id }})" 
                                                    class="btn btn-sm btn-danger rounded-pill" title="Delete">
                                                    <i class="fas fa-trash fs-6"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="empty-state-icon bg-light p-4 rounded-circle mb-3 shadow-sm">
                                                    <i class="fas fa-box-open fa-3x text-primary opacity-50"></i>
                                                </div>
                                                <h5 class="text-dark">No products found</h5>
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
                            Showing <span class="fw-semibold">{{ $products->firstItem() ?: 0 }}</span> to 
                            <span class="fw-semibold">{{ $products->lastItem() ?: 0 }}</span> of 
                            <span class="fw-semibold">{{ $products->total() }}</span> products
                        </div>
                        
                        <div>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    @if($confirmingDeletion)
        <div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-3 border-0 shadow">
                    <div class="modal-header border-0 bg-danger bg-opacity-10">
                        <h5 class="modal-title text-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Confirm Deletion
                        </h5>
                        <button type="button" class="btn-close" wire:click="$set('confirmingDeletion', false)"></button>
                    </div>
                    <div class="modal-body py-4">
                        <p class="mb-0 text-center">Are you sure you want to delete this product? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill" wire:click="$set('confirmingDeletion', false)">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-danger rounded-pill" wire:click="deleteProduct">
                            <i class="fas fa-trash me-2"></i> Delete Product
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
        
    @include('modals.products')
    @include('scripts.products')
    @include('styles.users')
    <!-- Toast Container with Enhanced UI -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="toastContainer" class="toast-container"></div>
    </div>
    
 
</div>
