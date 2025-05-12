<div x-data="{ sidebarOpen: false, userLoggedIn: false }" class="relative z-20">
    <!-- Header Navigation -->
    <header class="bg-white shadow-md fixed w-full top-0 z-30 md:px-24 px-8">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Left Side - Hamburger Menu -->
            <button @click="sidebarOpen = true" class="text-navy hover:text-light-navy focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            
            <!-- Center - Logo -->
            <a href="/" class="font-heading font-bold text-2xl text-navy">
                Luxury Furniture
            </a>
            
            <!-- Right Side - User Actions -->
            <div class="flex items-center space-x-8">
                <!-- Cart Button -->
                <a href="/cart" class="text-navy hover:text-light-navy relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="absolute -top-1 -right-1 bg-wood text-white rounded-full w-4 h-4 flex items-center justify-center text-xs" id="cartNum">{{$productCount}}</span>
                </a>
                
                <!-- Conditional Login/Profile Button -->
                {{-- <template x-if="!userLoggedIn">
                   
                </template> --}}
                @if ($isLoggedIn)
                <div class="relative inline-block text-left">
                    <a href="#" onclick="toggleDropdown(event)" class="flex items-center space-x-2 px-4 py-2 text-navy hover:text-light-navy font-medium transition-colors duration-200">
                        <span>{{ $user_name }}</span>
                        <i id="arrow-icon" class="fas fa-chevron-down transition-transform duration-200"></i>
                    </a>
                
                    <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-sm shadow-md z-50">
                        <a href="/profile" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
                            <i class="fas fa-user mr-3 text-navy"></i> Profile
                        </a>
                        <a href="/settings" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition">
                            <i class="fas fa-cog mr-3 text-navy"></i> Settings
                        </a>
                        <form method="POST" wire:submit.prevent='logout'>
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-red-100 hover:text-red-600 transition">
                                <i class="fas fa-sign-out-alt mr-3 text-red-500"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
                
           
                
                @else
                <a href="/login" class="bg-wood hover:bg-light-wood text-white px-4 py-2 rounded-md transition duration-300">
                    Login
                </a>
                @endif
                {{-- <template x-if="userLoggedIn">
                    <a href="/profile" class="text-navy hover:text-light-navy">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </a>
                </template> --}}
            </div>
        </div>
    </header>

    <!-- Sidebar Navigation -->
    <div 
        x-show="sidebarOpen" 
        @click.away="sidebarOpen = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0 h-full w-64 bg-navy text-white z-40 transform"
    >
        <div class="p-6">
            <!-- Close Button -->
            <div class="flex justify-end">
                <button @click="sidebarOpen = false" class="text-white hover:text-gray-300 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Logo -->
            <div class="mt-4 mb-8">
                <span class="font-heading font-bold text-xl">Luxury Furniture</span>
            </div>
            
            <!-- Navigation Links -->
            <nav class="space-y-4">
                <a href="/" class="block py-2 px-4 hover:bg-light-navy rounded transition duration-200">Home</a>
                <a href="/products" class="block py-2 px-4 hover:bg-light-navy rounded transition duration-200">Products</a>
                <a href="/about" class="block py-2 px-4 hover:bg-light-navy rounded transition duration-200">About Us</a>
                <a href="/terms" class="block py-2 px-4 hover:bg-light-navy rounded transition duration-200">Terms & Conditions</a>
                <a href="/privacy" class="block py-2 px-4 hover:bg-light-navy rounded transition duration-200">Privacy Policy</a>
                <a href="/contact" class="block py-2 px-4 hover:bg-light-navy rounded transition duration-200">Contact</a>
            </nav>
        </div>
    </div>
    
    <!-- Overlay when sidebar is open -->
    <div 
        x-show="sidebarOpen" 
        class="fixed inset-0 bg-black bg-opacity-50 z-30"
        @click="sidebarOpen = false"
    ></div>
    
    <!-- Spacer for fixed header -->
    <div class="h-16"></div>
</div>

<script>
    // This would typically be in your Livewire component class
    // For demo purposes, we're using Alpine.js directly
    document.addEventListener('DOMContentLoaded', function() {
        // Check if user is logged in
        // This would be replaced with your actual authentication check
        const userLoggedIn = localStorage.getItem('userLoggedIn') === 'true';
        
        // Set the userLoggedIn value for Alpine.js
        if (window.Alpine) {
            window.Alpine.store('auth', {
                userLoggedIn: userLoggedIn
            });
        }
    });
</script>
<script>
    function toggleDropdown(event) {
        event.preventDefault();
        const dropdown = document.getElementById('user-dropdown');
        dropdown.classList.toggle('hidden');
        
        // Optional: rotate arrow icon
        const icon = document.getElementById('arrow-icon');
        icon.classList.toggle('rotate-180');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('user-dropdown');
        const trigger = event.target.closest('a');
        if (!dropdown.contains(event.target) && !trigger) {
            dropdown.classList.add('hidden');
            document.getElementById('arrow-icon').classList.remove('rotate-180');
        }
    });
</script>