<div>
  <div class="container mx-auto px-24 py-8">
      <div class="flex flex-col lg:flex-row gap-8">
          <!-- Cart Items Section -->
          <div class="w-full lg:w-2/3"  data-aos-delay="100">
              <h2 class="text-2xl font-bold mb-6 text-gray-800">Your Shopping Cart</h2>
              
              @if($carts->isEmpty())
                  <div class="bg-white rounded-lg shadow-md p-8 text-center" >
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                      <p class="text-gray-600 mb-4">Your shopping cart is empty</p>
                      <button wire:click="continueShopping" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                          Continue Shopping
                      </button>
                  </div>
              @else
                  <div class="bg-white rounded-lg shadow-md overflow-hidden" >
                      <div class="overflow-x-auto">
                          <table class="w-full">
                              <thead class="bg-gray-100">
                                  <tr>
                                      <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Product</th>
                                      <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Price</th>
                                      <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Quantity</th>
                                      <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Total</th>
                                      <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Action</th>
                                  </tr>
                              </thead>
                              <tbody class="divide-y divide-gray-200">
                                  @foreach($carts as $cart)
                                  {{-- @dd($cart) --}}
                                      <tr wire:key="cart-{{ $cart->cart_id }}">
                                          <td class="px-4 py-4">
                                              <div class="flex items-center">
                                                  <img src="{{ asset('storage/' . $cart->image) }}" alt="{{ $cart->product_name }}" class="w-16 h-16 object-cover rounded mr-4">
                                                  <div>
                                                      <h3 class="text-sm font-medium text-gray-800">{{ $cart->product_name }}</h3>
                                                      <p class="text-xs text-gray-500">SKU: {{ $cart->stock }}</p>
                                                  </div>
                                              </div>
                                          </td>
                                          <td class="px-4 py-4 text-sm text-gray-600">
                                              @if($cart->discount_price)
                                                  <span class="line-through text-gray-400">${{ number_format($cart->price, 2) }}</span>
                                                  <span class="text-green-600">${{ number_format($cart->discount_price, 2) }}</span>
                                              @else
                                                  <span>${{ number_format($cart->price, 2) }}</span>
                                              @endif
                                          </td>
                                          <td class="px-4 py-4">
                                              <div class="flex items-center border border-gray-200 rounded">
                                                  <button 
                                                      wire:click="decreaseQuantity({{ $cart->cart_id }})" 
                                                      class="px-3 py-1 text-gray-600 hover:bg-gray-100 focus:outline-none"
                                                  >
                                                      -
                                                  </button>
                                                  <span class="px-3 py-1 text-gray-600">{{ $cart->quantity }}</span>
                                                  <button 
                                                      wire:click="increaseQuantity({{ $cart->cart_id }})" 
                                                      class="px-3 py-1 text-gray-600 hover:bg-gray-100 focus:outline-none"
                                                  >
                                                      +
                                                  </button>
                                              </div>
                                          </td>
                                          <td class="px-4 py-4 text-sm font-medium text-gray-800">
                                              ${{ number_format(($cart->discount_price ?? $cart->price) * $cart->quantity, 2) }}
                                          </td>
                                          <td class="px-4 py-4">
                                              <button 
                                                  wire:click="removeItem({{ $cart->cart_id }})" 
                                                  class="text-red-500 hover:text-red-700 focus:outline-none"
                                                  title="Remove item"
                                              >
                                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                  </svg>
                                              </button>
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>

                  <div class="flex items-center justify-between mt-6"  data-aos-delay="150">
                      <button 
                          wire:click="updateCart" 
                          class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition-colors"
                      >
                          Update Cart
                      </button>
                      <button 
                          wire:click="continueShopping" 
                          class="border border-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-50 transition-colors"
                      >
                          Continue Shopping
                      </button>
                  </div>
              @endif
          </div>

          <!-- Order Summary Section -->
          <div class="w-full lg:w-1/3"  data-aos-delay="200">
              <div class="bg-white rounded-lg shadow-md p-6">
                  <h2 class="text-lg font-bold mb-4 pb-4 border-b border-gray-200">Order Summary</h2>
                  
                  <!-- Coupon Code -->
                  <div class="mb-6">
                      <label for="coupon" class="block text-sm font-medium text-gray-700 mb-1">Apply Coupon</label>
                      <div class="flex">
                          <input 
                              type="text" 
                              id="coupon" 
                              wire:model.defer="couponCode" 
                              class="flex-1 border-gray-300 rounded-l-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Enter coupon code"
                          style="outline: none;">
                          <button 
                              wire:click="applyCoupon" 
                              class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700 transition-colors"
                          >
                              Apply
                          </button>
                      </div>
                      @if($couponMessage)
                          <p class="{{ $couponApplied ? 'text-green-500' : 'text-red-500' }} text-xs mt-1">
                              {{ $couponMessage }}
                          </p>
                      @endif
                  </div>
                  
                  <!-- Order Details -->
                  <div class="space-y-3">
                      <div class="flex justify-between">
                          <span class="text-gray-600">Subtotal</span>
                          <span class="text-gray-800 font-medium">${{ number_format($subtotal, 2) }}</span>
                      </div>
                      
                      @if($discount > 0)
                      <div class="flex justify-between">
                          <span class="text-gray-600">Discount</span>
                          <span class="text-green-600 font-medium">-${{ number_format($discount, 2) }}</span>
                      </div>
                      @endif
                      
                      <div class="flex justify-between pt-3 border-t border-gray-200">
                          <span class="text-gray-800 font-bold">Total</span>
                          <span class="text-blue-600 font-bold">${{ number_format($total, 2) }}</span>
                      </div>
                  </div>
                  
                  <!-- Checkout Button -->
                  <button 
                      wire:click="checkout"
                      class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 transition-colors mt-6 font-medium"
                      {{ $carts->isEmpty() ? 'disabled' : '' }}
                  >
                      Proceed to Checkout
                  </button>
              </div>

              <!-- Secure Payment Info -->
              <div class="mt-6 bg-white rounded-lg shadow-md p-6"  data-aos-delay="250">
                  <h3 class="text-sm font-medium mb-3 text-gray-700">Secure Checkout</h3>
                  <div class="flex items-center space-x-4">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                      </svg>
                      <span class="text-xs text-gray-500">Your payment information is secure</span>
                  </div>
                  <div class="flex items-center mt-3">
                      <div class="flex space-x-2">
                          <div class="w-8 h-5 bg-gray-100 rounded"></div>
                          <div class="w-8 h-5 bg-gray-100 rounded"></div>
                          <div class="w-8 h-5 bg-gray-100 rounded"></div>
                          <div class="w-8 h-5 bg-gray-100 rounded"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Notification Component (Vanilla JS replacement for Alpine) -->
  <div 
      id="notification-component"
      class="fixed bottom-4 right-4 px-4 py-2 rounded-md text-white hidden"
      style="z-index: 50; transition: opacity 300ms ease-in-out, transform 300ms ease-in-out;"
  >
      <div class="flex items-center">
          <svg id="success-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          <svg id="error-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 hidden" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
          </svg>
          <span id="notification-message"></span>
      </div>
  </div>

  <script>
    // Initialize AOS animations
    document.addEventListener('DOMContentLoaded', function() {
        
        
        // Setup notification system (replacing Alpine.js)
        const notificationComponent = document.getElementById('notification-component');
        const notificationMessage = document.getElementById('notification-message');
        const successIcon = document.getElementById('success-icon');
        const errorIcon = document.getElementById('error-icon');
        
        // Listen for the notify event from Livewire
        window.addEventListener('notify', function(event) {
            // Set message
            notificationMessage.textContent = event.detail.message;
            
            // Set notification type (success or error)
            const type = event.detail.type || 'success';
            
            if (type === 'success') {
                notificationComponent.classList.add('bg-green-500');
                notificationComponent.classList.remove('bg-red-500');
                successIcon.classList.remove('hidden');
                errorIcon.classList.add('hidden');
            } else {
                notificationComponent.classList.add('bg-red-500');
                notificationComponent.classList.remove('bg-green-500');
                successIcon.classList.add('hidden');
                errorIcon.classList.remove('hidden');
            }
            
            // Show notification with animation
            notificationComponent.classList.remove('hidden');
            notificationComponent.style.opacity = '0';
            notificationComponent.style.transform = 'scale(0.9)';
            
            // Trigger reflow for animation to work
            void notificationComponent.offsetWidth;
            
            notificationComponent.style.opacity = '1';
            notificationComponent.style.transform = 'scale(1)';
            
            // Hide after 3 seconds
            setTimeout(function() {
                notificationComponent.style.opacity = '0';
                notificationComponent.style.transform = 'scale(0.9)';
                
                // After transition is complete, hide element
                setTimeout(function() {
                    notificationComponent.classList.add('hidden');
                }, 300);
            }, 3000);
        });
    });
    
    // Reinitialize AOS animations on Livewire updates
    document.addEventListener('livewire:load', function() {
        Livewire.hook('message.processed', () => {
            AOS.refresh();
        });
    });
  </script>
</div>