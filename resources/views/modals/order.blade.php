<!-- Order Modal -->
@if($showOrderModal)
<div class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-3 border-0 shadow">
            <div class="modal-header border-0 bg-primary bg-opacity-10">
                <h5 class="modal-title d-flex align-items-center">
                    <i class="fas fa-shopping-cart me-2 text-primary"></i>
                    {{ $modalTitle }}
                </h5>
                <button type="button" class="btn-close" wire:click="$set('showOrderModal', false)"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="saveOrder">
                    <div class="row g-3">
                        <!-- Order Information -->
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Order Information</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Order Reference -->
                                    <div class="mb-3">
                                        <label for="order_ref_id" class="form-label fw-semibold">Order Reference <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-hashtag text-primary"></i>
                                            </span>
                                            <input type="text" wire:model="order_ref_id" id="order_ref_id" class="form-control" placeholder="ORD-123456">
                                        </div>
                                        @error('order_ref_id') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Customer Selection -->
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label fw-semibold">Customer <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-user text-primary"></i>
                                            </span>
                                            <select wire:model="user_id" id="user_id" class="form-select">
                                                <option value="">Select Customer</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('user_id') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Product Selection -->
                                    <div class="mb-3">
                                        <label for="product_id" class="form-label fw-semibold">Product <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-box text-primary"></i>
                                            </span>
                                            <select wire:model="product_id" id="product_id" class="form-select">
                                                <option value="">Select Product</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('product_id') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Quantity -->
                                    <div class="mb-0">
                                        <label for="quantity" class="form-label fw-semibold">Quantity <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-cubes text-primary"></i>
                                            </span>
                                            <input type="number" wire:model="quantity" id="quantity" class="form-control" min="1" placeholder="1">
                                        </div>
                                        @error('quantity') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Price & Status -->
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-dollar-sign me-2"></i>Price & Status</h6>
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
                                    
                                    <!-- Payment Status -->
                                    <div class="mb-3">
                                        <label for="payment_status" class="form-label fw-semibold">Payment Status <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-credit-card text-primary"></i>
                                            </span>
                                            <select wire:model="payment_status" id="payment_status" class="form-select">
                                                <option value="">Select Payment Status</option>
                                                @foreach($paymentStatusOptions as $status)
                                                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('payment_status') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <!-- Order Status -->
                                    <div class="mb-0">
                                        <label for="order_status" class="form-label fw-semibold">Order Status <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-truck text-primary"></i>
                                            </span>
                                            <select wire:model="order_status" id="order_status" class="form-select">
                                                <option value="">Select Order Status</option>
                                                @foreach($orderStatusOptions as $status)
                                                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('order_status') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Shipping Address -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Shipping Address</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="shipping_address" class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                                        <textarea wire:model="shipping_address" id="shipping_address" rows="3" class="form-control" placeholder="Enter shipping address"></textarea>
                                        @error('shipping_address') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="shipping_city" class="form-label fw-semibold">City <span class="text-danger">*</span></label>
                                                <input type="text" wire:model="shipping_city" id="shipping_city" class="form-control" placeholder="City">
                                                @error('shipping_city') <span class="text-danger small">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-0">
                                                <label for="shipping_zipcode" class="form-label fw-semibold">Zip Code <span class="text-danger">*</span></label>
                                                <input type="text" wire:model="shipping_zipcode" id="shipping_zipcode" class="form-control" placeholder="Zip Code">
                                                @error('shipping_zipcode') <span class="text-danger small">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Information -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-money-bill-wave me-2"></i>Payment Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label fw-semibold">Payment Method <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-wallet text-primary"></i>
                                            </span>
                                            <select wire:model="payment_method" id="payment_method" class="form-select">
                                                <option value="">Select Payment Method</option>
                                                <option value="credit_card">Credit Card</option>
                                                <option value="paypal">PayPal</option>
                                                <option value="bank_transfer">Bank Transfer</option>
                                                <option value="cash_on_delivery">Cash on Delivery</option>
                                            </select>
                                        </div>
                                        @error('payment_method') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="payment_transaction_id" class="form-label fw-semibold">Transaction ID</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-hashtag text-primary"></i>
                                            </span>
                                            <input type="text" wire:model="payment_transaction_id" id="payment_transaction_id" class="form-control" placeholder="Transaction ID (if available)">
                                        </div>
                                        @error('payment_transaction_id') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="mb-0">
                                        <label for="payment_notes" class="form-label fw-semibold">Payment Notes</label>
                                        <textarea wire:model="payment_notes" id="payment_notes" rows="2" class="form-control" placeholder="Any payment related notes"></textarea>
                                        @error('payment_notes') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Notes -->
                        <div class="col-md-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-sticky-note me-2"></i>Order Notes</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-0">
                                        <textarea wire:model="notes" id="notes" rows="3" class="form-control" placeholder="Enter any additional notes for this order"></textarea>
                                        @error('notes') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="mt-4 d-flex justify-content-end">
                        <button type="button" class="btn btn-light rounded-pill me-2" wire:click="$set('showOrderModal', false)">
                            <i class="fas fa-times me-2"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-save me-2"></i> {{ $orderId ? 'Update' : 'Save' }} Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

