<div class="bg-white py-20">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="font-heading text-3xl md:text-4xl font-bold text-navy mb-4">Discover Our Collection</h2>
            <div class="w-24 h-1 bg-wood mx-auto mb-6"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Each piece is meticulously crafted with premium materials, combining modern design with timeless elegance.
            </p>
        </div>
        
        <!-- Category Filters -->
        <div class="flex flex-wrap justify-center gap-3 mb-12" data-aos="fade-up" data-aos-delay="200">
            <button 
                wire:click="setCategory('all')" 
                class="px-6 py-2 rounded-full font-medium transition duration-300 {{ $activeCategory === 'all' ? 'bg-wood text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                All
            </button>

            @foreach($categories as $category)
                <button 
                    wire:click="setCategory('{{ $category->slug }}')" 
                    class="px-6 py-2 rounded-full font-medium transition duration-300 {{ $activeCategory === $category->slug ? 'bg-wood text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
        
        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($products as $product)
                @if($activeCategory === 'all' || $activeCategory === strtolower(str_replace(' ', '-', $product->category)))
                <div 
                    class="group relative bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="{{ 300 + (100 * $loop->index) }}"
                >
                    <!-- Discount or Featured Label -->
                    @if($product->discount_percentage > 0)
                        <div class="absolute top-4 left-4 bg-wood text-white text-sm px-3 py-1 rounded-full z-10">
                            -{{ $product->discount_percentage }}%
                        </div>
                    @elseif($product->is_featured)
                        <div class="absolute top-4 left-4 bg-navy text-white text-sm px-3 py-1 rounded-full z-10">
                            Featured
                        </div>
                    @endif
                    
                    <!-- Product Image -->
                    <div class="relative overflow-hidden h-64">
                        <img 
                            src="{{ $product->image ? asset('storage/' . $product->image) : '/api/placeholder/400/300' }}" 
                            alt="{{ $product->name }}" 
                            class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110"
                        >
                        <!-- Quick Add Button -->
                        <div class="absolute bottom-4 right-4">
                            <button 
                                class="bg-navy hover:bg-light-navy text-white p-2 rounded-full shadow-md transition duration-300 transform translate-y-12 opacity-0 group-hover:translate-y-0 group-hover:opacity-100"
                                wire:click="addToCart({{ $product->id }})"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-heading text-lg font-semibold text-navy">{{ $product->name }}</h3>
                            <div class="flex items-center">
                                <span class="text-wood font-bold">₹{{ number_format($product->price, 0) }}</span>
                                @if($product->discount_price && $product->discount_price > $product->price)
                                    <span class="text-gray-400 line-through ml-2 text-sm">₹{{ number_format($product->discount_price, 0) }}</span>
                                @endif
                            </div>
                        </div>
                        <p class="text-gray-500 text-sm mb-4">{{ Str::limit($product->description, 60) }}</p>
                        
                        <!-- Features/Tags -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach(array_slice($product->tags_array, 0, 2) as $tag)
                                <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">{{ $tag }}</span>
                            @endforeach
                        </div>
                        
                        <!-- View Product Button -->
                        <a href="/product/{{ $product->slug }}" class="block text-center bg-white border border-navy text-navy hover:bg-navy hover:text-white py-2 rounded transition duration-300">
                            View Details
                        </a>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        
        <!-- View More Button -->
        <div class="text-center mt-16" data-aos="fade-up" data-aos-delay="300">
            <a href="/products" class="inline-block bg-wood hover:bg-light-wood text-white px-8 py-3 rounded-md transition duration-300 font-medium">
                View All Products
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Notification System (using Livewire browser events instead of Alpine) -->
    <div class="fixed top-20 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm notification-container hidden">
        <div class="flex items-center">
            <div class="ml-3">
                <p class="text-sm font-medium notification-message"></p>
            </div>
        </div>
    </div>

 
</div>