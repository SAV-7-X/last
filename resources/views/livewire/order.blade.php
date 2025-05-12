<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12" data-aos="fade-up" data-aos-duration="800">
            <div class="card border-0 rounded-1 mb-4 overflow-hidden" style="box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.347);">
                <!-- Card Header with Elegant Styling -->
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="mb-0 d-flex align-items-center">
                        <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="fas fa-shopping-cart text-light"></i>
                        </span>
                        <span class="fw-bold">Orders Management</span>
                    </h5>
                    <button wire:click="createOrder" class="btn btn-primary btn-sm d-flex align-items-center rounded-pill px-3 py-2">
                        <i class="fas fa-plus me-2"></i> Create New Order
                    </button>
                </div>
                
                <div class="card-body">
                    <!-- Search Filters with Enhanced UI -->
                    <div class="bg-light p-4 mb-4 rounded-3 border-start border-primary border-4 shadow-sm" data-aos="fade-right" data-aos-duration="600">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-hashtag text-primary opacity-50"></i>
                                    </span>
                                    <input wire:model.live="searchReference" type="text" 
                                        class="form-control border-0" placeholder="Order Reference...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-user text-primary opacity-50"></i>
                                    </span>
                                    <input wire:model.live="searchCustomer" type="text" 
                                        class="form-control border-0" placeholder="Customer...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-box text-primary opacity-50"></i>
                                    </span>
                                    <input wire:model.live="searchProduct" type="text" 
                                        class="form-control border-0" placeholder="Product...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-credit-card text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.live="searchPaymentStatus" class="form-select border-0">
                                        <option value="">All Payment Status</option>
                                        @foreach($paymentStatusOptions as $status)
                                            <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-merge shadow-sm rounded-pill overflow-hidden">
                                    <span class="input-group-text bg-white border-0">
                                        <i class="fas fa-truck text-primary opacity-50"></i>
                                    </span>
                                    <select wire:model.live="searchOrderStatus" class="form-select border-0">
                                        <option value="">All Order Status</option>
                                        @foreach($orderStatusOptions as $status)
                                            <option value="{{ $status }}">{{ ucfirst($status) }}</option>
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
                    
                    <!-- Orders Table with Enhanced Styling -->
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
                                        <a href="#" wire:click.prevent="sortBy('order_ref_id')" 
                                            class="d-flex align-items-center text-dark text-decoration-none">
                                            Order Reference 
                                            @if($sortField === 'order_ref_id')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold">
                                        <a href="#" wire:click.prevent="sortBy('user_id')" 
                                            class="d-flex align-items-center text-dark text-decoration-none">
                                            Customer 
                                            @if($sortField === 'user_id')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold">
                                        <a href="#" wire:click.prevent="sortBy('product_id')" 
                                            class="d-flex align-items-center text-dark text-decoration-none">
                                            Product 
                                            @if($sortField === 'product_id')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold">
                                        <a href="#" wire:click.prevent="sortBy('quantity')" 
                                            class="d-flex align-items-center text-dark text-decoration-none">
                                            Quantity 
                                            @if($sortField === 'quantity')
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
                                    <th class="text-uppercase text-xs fw-bold text-center">
                                        <a href="#" wire:click.prevent="sortBy('payment_status')" 
                                            class="d-flex align-items-center justify-content-center text-dark text-decoration-none">
                                            Payment 
                                            @if($sortField === 'payment_status')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold text-center">
                                        <a href="#" wire:click.prevent="sortBy('order_status')" 
                                            class="d-flex align-items-center justify-content-center text-dark text-decoration-none">
                                            Status
                                            @if($sortField === 'order_status')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-2 text-primary"></i>
                                            @else
                                                <i class="fas fa-sort ms-2 text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="text-uppercase text-xs fw-bold text-center">
                                        <a href="#" wire:click.prevent="sortBy('created_at')" 
                                            class="d-flex align-items-center justify-content-center text-dark text-decoration-none">
                                            Date
                                            @if($sortField === 'created_at')
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
                                @forelse($orders as $order)
                                    <tr class="align-middle">
                                        <td class="ps-3">
                                            <div class="form-check d-flex justify-content-center">
                                                <input wire:model.live="selectedRows" value="{{ $order->id }}" 
                                                    class="form-check-input" type="checkbox">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm fw-semibold">#{{ $order->order_ref_id ?? 'ORD-' . $order->id }}</h6>
                                                    <p class="text-muted small mb-0">
                                                        <i class="far fa-calendar-alt me-1"></i>
                                                        {{ $order->created_at->format('M d, Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="avatar-wrapper rounded-circle me-3 shadow-sm 
                                                    bg-primary bg-opacity-10 text-light 
                                                    d-flex align-items-center justify-content-center border border-2 border-white"
                                                    style="width: 36px; height: 36px;">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm fw-semibold">{{ $order->user->name ?? 'Unknown' }}</h6>
                                                    <p class="text-muted small mb-0">
                                                        <i class="fas fa-envelope me-1"></i>
                                                        {{ $order->user->email ?? 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                @if($order->product && $order->product->image)
                                                    <div class="avatar-wrapper rounded-3 overflow-hidden me-3 shadow-sm border border-2 border-white" style="width: 36px; height: 36px;">
                                                        <img src="{{ Storage::url($order->product->image) }}" 
                                                            class="w-100 h-100 object-fit-cover" alt="{{ $order->product->name }}">
                                                    </div>
                                                @else
                                                    <div class="avatar-wrapper rounded-3 me-3 shadow-sm 
                                                        bg-primary bg-opacity-10 text-light 
                                                        d-flex align-items-center justify-content-center border border-2 border-white"
                                                        style="width: 36px; height: 36px;">
                                                        <i class="fas fa-box"></i>
                                                    </div>
                                                @endif
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm fw-semibold">{{ $order->product->name ?? 'Product Unavailable' }}</h6>
                                                    <p class="text-muted small mb-0">
                                                        <i class="fas fa-barcode me-1"></i>
                                                        {{ $order->product->sku ?? 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                {{ $order->quantity }} @if($order->quantity == 1) unit @else units @endif
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="badge bg-success bg-opacity-10 text-light py-2 px-3 rounded-pill mb-1">
                                                    {{ number_format($order->price, 2) }} / Unit
                                                </span>
                                                <span class="badge bg-primary bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                    Total: {{ number_format($order->price * $order->quantity, 2) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm dropdown-toggle rounded-pill py-2 px-3
                                                    @if($order->payment_status === 'paid')
                                                        bg-success bg-opacity-10 text-light
                                                    @elseif($order->payment_status === 'pending')
                                                        bg-warning bg-opacity-10 text-light
                                                    @else
                                                        bg-danger bg-opacity-10 text-light
                                                    @endif"
                                                    type="button" id="paymentStatus{{ $order->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    @if($order->payment_status === 'paid')
                                                        <i class="fas fa-check-circle me-1" style="font-size: 10px;"></i>
                                                    @elseif($order->payment_status === 'pending')
                                                        <i class="fas fa-clock me-1" style="font-size: 10px;"></i>
                                                    @else
                                                        <i class="fas fa-times-circle me-1" style="font-size: 10px;"></i>
                                                    @endif
                                                    {{ ucfirst($order->payment_status) }}
                                                </button>
                                                <ul class="dropdown-menu shadow-sm" aria-labelledby="paymentStatus{{ $order->id }}">
                                                    @foreach($paymentStatusOptions as $status)
                                                        <li><a class="dropdown-item @if($order->payment_status === $status) active @endif" 
                                                            href="#" wire:click.prevent="updatePaymentStatus({{ $order->id }}, '{{ $status }}')">
                                                            {{ ucfirst($status) }}
                                                        </a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm dropdown-toggle rounded-pill py-2 px-3
                                                    @if($order->order_status === 'delivered')
                                                        bg-success bg-opacity-10 text-light
                                                    @elseif($order->order_status === 'processing' || $order->order_status === 'shipped')
                                                        bg-primary bg-opacity-10 text-light
                                                    @elseif($order->order_status === 'pending')
                                                        bg-warning bg-opacity-10 text-light
                                                    @else
                                                        bg-danger bg-opacity-10 text-light
                                                    @endif"
                                                    type="button" id="orderStatus{{ $order->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    @if($order->order_status === 'delivered')
                                                        <i class="fas fa-check-circle me-1" style="font-size: 10px;"></i>
                                                    @elseif($order->order_status === 'processing')
                                                        <i class="fas fa-cog me-1" style="font-size: 10px;"></i>
                                                    @elseif($order->order_status === 'shipped')
                                                        <i class="fas fa-shipping-fast me-1" style="font-size: 10px;"></i>
                                                    @elseif($order->order_status === 'pending')
                                                        <i class="fas fa-clock me-1" style="font-size: 10px;"></i>
                                                    @else
                                                        <i class="fas fa-times-circle me-1" style="font-size: 10px;"></i>
                                                    @endif
                                                    {{ ucfirst($order->order_status) }}
                                                </button>
                                                <ul class="dropdown-menu shadow-sm" aria-labelledby="orderStatus{{ $order->id }}">
                                                    @foreach($orderStatusOptions as $status)
                                                        <li><a class="dropdown-item @if($order->order_status === $status) active @endif" 
                                                            href="#" wire:click.prevent="updateOrderStatus({{ $order->id }}, '{{ $status }}')">
                                                            {{ ucfirst($status) }}
                                                        </a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="badge bg-secondary bg-opacity-10 text-light py-2 px-3 rounded-pill">
                                                {{ $order->created_at->format('d M, Y') }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="btn-group" role="group">
                                                <button wire:click="editOrder({{ $order->id }})" 
                                                    class="btn btn-sm btn-light text-primary rounded-pill me-1" title="Edit">
                                                    <i class="fas fa-edit fs-6"></i>
                                                </button>
                                                <button wire:click="confirmOrderDeletion({{ $order->id }})" 
                                                    class="btn btn-sm btn-danger rounded-pill" title="Delete">
                                                    <i class="fas fa-trash fs-6"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="empty-state-icon bg-light p-4 rounded-circle mb-3 shadow-sm">
                                                    <i class="fas fa-shopping-cart fa-3x text-primary opacity-50"></i>
                                                </div>
                                                <h5 class="text-dark">No orders found</h5>
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
                    <!-- Pagination with Enhanced Styling -->
                    <div class="d-flex justify-content-center justify-content-md-between align-items-center py-3 mt-3" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
                        <div class="d-none d-md-block text-muted">
                            Showing <span class="fw-semibold">{{ $orders->firstItem() ?: 0 }}</span> to 
                            <span class="fw-semibold">{{ $orders->lastItem() ?: 0 }}</span> of 
                            <span class="fw-semibold">{{ $orders->total() }}</span> orders
                        </div>
                        
                        <div>
                            {{ $orders->links() }}
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
                        <p class="mb-0 text-center">Are you sure you want to delete this order? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill" wire:click="$set('confirmingDeletion', false)">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-danger rounded-pill" wire:click="deleteOrder">
                            <i class="fas fa-trash me-2"></i> Delete Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    

    @include('modals.order')
    @include('scripts.order')
    @include('styles.users')
    <!-- Toast Container with Enhanced UI -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="toastContainer" class="toast-container"></div>
    </div>
</div>