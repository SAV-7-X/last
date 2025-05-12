<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Order extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    // Search and filter properties
    public $searchReference = '';
    public $searchCustomer = '';
    public $searchProduct = '';
    public $searchPaymentStatus = '';
    public $searchOrderStatus = '';
    public $perPage = 10;
    
    // Sorting properties
    public $sortField = 'orders.created_at';
    public $sortDirection = 'desc';
    
    // Selection properties
    public $selectedRows = [];
    public $selectAll = false;
    
    // Modal properties
    public $confirmingDeletion = false;
    public $deletingOrderId = null;
    public $showOrderModal = false;
    public $modalTitle = 'Create New Order';
    
    // Order form properties
    public $orderId;
    public $order_ref_id;
    public $user_id;
    public $product_id;
    public $quantity = 1;
    public $price;
    public $payment_status = 'pending';
    public $order_status = 'pending';
    public $shipping_address;
    public $shipping_city;
    public $shipping_zipcode;
    public $payment_method;
    public $payment_transaction_id;
    public $payment_notes;
    public $notes;
    
    // Listeners for events
    protected $listeners = [
        'refreshOrders' => '$refresh',
        'openOrderModal' => 'openOrderModal'
    ];
    
    // Validation rules
    protected function rules()
    {
        return [
            'order_ref_id' => 'required|string|max:50',
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'payment_status' => 'required|in:' . implode(',', $this->paymentStatusOptions),
            'order_status' => 'required|in:' . implode(',', $this->orderStatusOptions),
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_zipcode' => 'required|string',
            'payment_method' => 'required|string',
            'payment_transaction_id' => 'nullable|string',
            'payment_notes' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }
    
    // Reset pagination when filters change
    public function updatingSearchReference() { $this->resetPage(); }
    public function updatingSearchCustomer() { $this->resetPage(); }
    public function updatingSearchProduct() { $this->resetPage(); }
    public function updatingSearchPaymentStatus() { $this->resetPage(); }
    public function updatingSearchOrderStatus() { $this->resetPage(); }
    
    // Handle sort
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    
    // Handle select all
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedRows = $this->orders->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedRows = [];
        }
    }
    
    // Reset filters
    public function resetFilters()
    {
        $this->searchReference = '';
        $this->searchCustomer = '';
        $this->searchProduct = '';
        $this->searchPaymentStatus = '';
        $this->searchOrderStatus = '';
        $this->resetPage();
    }
    
    // Confirm order deletion
    public function confirmOrderDeletion($orderId)
    {
        $this->confirmingDeletion = true;
        $this->deletingOrderId = $orderId;
    }
    
    // Delete order
    public function deleteOrder()
    {
        if ($this->deletingOrderId) {
            DB::table('orders')->where('id', $this->deletingOrderId)->delete();
            
            $this->confirmingDeletion = false;
            $this->deletingOrderId = null;
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Order deleted successfully!'
            ]);
        }
    }
    
    // Delete selected orders
    public function deleteSelected()
    {
        if (!empty($this->selectedRows)) {
            DB::table('orders')->whereIn('id', $this->selectedRows)->delete();
            $this->selectedRows = [];
            $this->selectAll = false;
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Selected orders deleted successfully!'
            ]);
        }
    }
    
    // Open order modal for create/edit
    public function openOrderModal($orderId = null)
    {
        $this->resetValidation();
        $this->resetOrderForm();
        
        if ($orderId) {
            $this->orderId = $orderId;
            $this->modalTitle = 'Edit Order';
            
            $order = DB::table('orders')->where('id', $orderId)->first();
            
            if ($order) {
                $this->order_ref_id = $order->order_ref_id;
                $this->user_id = $order->user_id;
                $this->product_id = $order->product_id;
                $this->quantity = $order->quantity;
                $this->price = $order->price;
                $this->payment_status = $order->payment_status;
                $this->order_status = $order->order_status;
                $this->shipping_address = $order->shipping_address ?? '';
                $this->shipping_city = $order->shipping_city ?? '';
                $this->shipping_zipcode = $order->shipping_zipcode ?? '';
                $this->payment_method = $order->payment_method ?? '';
                $this->payment_transaction_id = $order->payment_transaction_id ?? '';
                $this->payment_notes = $order->payment_notes ?? '';
                $this->notes = $order->notes ?? '';
            }
        } else {
            $this->modalTitle = 'Create New Order';
            // Generate a unique order reference ID
            $this->order_ref_id = 'ORD-' . strtoupper(uniqid());
        }
        
        $this->showOrderModal = true;
    }
    
    // Reset order form
    public function resetOrderForm()
    {
        $this->orderId = null;
        $this->order_ref_id = '';
        $this->user_id = '';
        $this->product_id = '';
        $this->quantity = 1;
        $this->price = '';
        $this->payment_status = 'pending';
        $this->order_status = 'pending';
        $this->shipping_address = '';
        $this->shipping_city = '';
        $this->shipping_zipcode = '';
        $this->payment_method = '';
        $this->payment_transaction_id = '';
        $this->payment_notes = '';
        $this->notes = '';
    }
    
    // Create order
    public function createOrder()
    {
        $this->openOrderModal();
    }
    
    // Edit order
    public function editOrder($orderId)
    {
        $this->openOrderModal($orderId);
    }
    
    // Save order
    public function saveOrder()
    {
        $validatedData = $this->validate();
        
        // If product_id is set, fetch the product price
        if ($this->product_id && !$this->price) {
            $product = DB::table('products')->where('id', $this->product_id)->first();
            if ($product) {
                $this->price = $product->price;
            }
        }
        
        $orderData = [
            'order_ref_id' => $validatedData['order_ref_id'],
            'user_id' => $validatedData['user_id'],
            'product_id' => $validatedData['product_id'],
            'quantity' => $validatedData['quantity'],
            'price' => $validatedData['price'],
            'payment_status' => $validatedData['payment_status'],
            'order_status' => $validatedData['order_status'],
            'shipping_address' => $validatedData['shipping_address'],
            'shipping_city' => $validatedData['shipping_city'],
            'shipping_zipcode' => $validatedData['shipping_zipcode'],
            'payment_method' => $validatedData['payment_method'],
            'payment_transaction_id' => $validatedData['payment_transaction_id'],
            'payment_notes' => $validatedData['payment_notes'],
            'notes' => $validatedData['notes'],
        ];
        
        if ($this->orderId) {
            // Update existing order
            DB::table('orders')
                ->where('id', $this->orderId)
                ->update($orderData);
            
            $message = 'Order updated successfully!';
        } else {
            // Create new order
            $orderData['created_at'] = now();
            $orderData['updated_at'] = now();
            
            DB::table('orders')->insert($orderData);
            
            $message = 'Order created successfully!';
        }
        
        $this->showOrderModal = false;
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => $message
        ]);
    }
    
    // Change order status
    public function updateOrderStatus($orderId, $status)
    {
        DB::table('orders')
            ->where('id', $orderId)
            ->update(['order_status' => $status]);
        
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Order status updated successfully!'
        ]);
    }
    
    // Change payment status
    public function updatePaymentStatus($orderId, $status)
    {
        DB::table('orders')
            ->where('id', $orderId)
            ->update(['payment_status' => $status]);
        
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Payment status updated successfully!'
        ]);
    }
    
    // Get orders with filtering and sorting
    public function getOrdersProperty()
    {
        $query = DB::table('orders')
            ->select([
                'orders.*',
                'users.name as user_name',
                'users.email as user_email',
                'products.name as product_name',
                'products.sku as product_sku',
                'products.image as product_image'
            ])
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('products', 'orders.product_id', '=', 'products.id');
        
        // Apply filters
        if ($this->searchReference) {
            $query->where('orders.order_ref_id', 'like', '%' . $this->searchReference . '%');
        }
        
        if ($this->searchCustomer) {
            $query->where(function($q) {
                $q->where('users.name', 'like', '%' . $this->searchCustomer . '%')
                  ->orWhere('users.email', 'like', '%' . $this->searchCustomer . '%');
            });
        }
        
        if ($this->searchProduct) {
            $query->where(function($q) {
                $q->where('products.name', 'like', '%' . $this->searchProduct . '%')
                  ->orWhere('products.sku', 'like', '%' . $this->searchProduct . '%');
            });
        }
        
        if ($this->searchPaymentStatus) {
            $query->where('orders.payment_status', $this->searchPaymentStatus);
        }
        
        if ($this->searchOrderStatus) {
            $query->where('orders.order_status', $this->searchOrderStatus);
        }
        
        // Apply sorting
        $query->orderBy($this->sortField, $this->sortDirection);
        
        // Convert to paginated collection
        $orders = $query->paginate($this->perPage);
        
        // Transform data for compatibility with original code
        $orders->getCollection()->transform(function($order) {
            // Convert to object that has user and product as nested objects
            // This maintains compatibility with the original template
            $order->user = (object)[
                'id' => $order->user_id,
                'name' => $order->user_name,
                'email' => $order->user_email
            ];
            
            $order->product = (object)[
                'id' => $order->product_id,
                'name' => $order->product_name,
                'sku' => $order->product_sku,
                'image' => $order->product_image
            ];
            
            // Handle date conversion for created_at
            if (is_string($order->created_at)) {
                $order->created_at = \Carbon\Carbon::parse($order->created_at);
            }
            
            // Remove redundant fields
            unset($order->user_name, $order->user_email, $order->product_name, $order->product_sku, $order->product_image);
            
            return $order;
        });
        
        return $orders;
    }
    
    // Get payment status options
    public function getPaymentStatusOptionsProperty()
    {
        return ['pending', 'paid', 'failed'];
    }
    
    // Get order status options
    public function getOrderStatusOptionsProperty()
    {
        return ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
    }
    
    // Get customers for dropdown
    public function getCustomersProperty()
    {
        return DB::table('users')->select('id', 'name', 'email')->get();
    }
    
    // Get products for dropdown
    public function getProductsProperty()
    {
        return DB::table('products')->select('id', 'name', 'sku', 'price')->where('is_active', true)->get();
    }
    
    public function render()
    {
        return view('livewire.order', [
            'orders' => $this->orders,
            'paymentStatusOptions' => $this->paymentStatusOptions,
            'orderStatusOptions' => $this->orderStatusOptions,
            'customers' => $this->customers,
            'products' => $this->products,
        ]);
    }
}