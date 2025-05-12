<div class="relative">
    <!-- Hero Section with Clip Path -->
    <div class="clip-path-hero bg-gray-100 text-gray-800 relative overflow-hidden max-h-screen md:px-24 px-8" style="min-height: 80vh;">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                <pattern id="pattern-circles" x="0" y="0" width="50" height="50" patternUnits="userSpaceOnUse" patternContentUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="2" fill="white"></circle>
                </pattern>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-circles)"></rect>
            </svg>
        </div>

        <div class="container mx-auto px-4  flex flex-col md:flex-row items-center">
            <!-- Left Content - Text -->
            <div class="w-full md:w-1/2 z-10 mb-12 md:mb-0" data-aos="fade-right" data-aos-delay="300">
                <h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                    <span class="block mb-2">Elevate Your Space</span>
                    <span class="text-wood">With <span id="typed-text"></span></span>
                </h1>
                
                <p class="text-lg md:text-xl mb-8 max-w-lg opacity-90">
                    Discover exquisite furniture pieces that blend elegance, comfort, and timeless design for your perfect living space.
                </p>
                
                <div class="flex flex-wrap gap-4">
                    <a href="/products" class="bg-wood hover:bg-light-wood text-white px-6 py-3 rounded-md transition duration-300 font-medium">
                        Browse Collection
                    </a>
                    <a href="/about" class="border bg-navy text-white border-white hover:bg-white hover:text-navy px-6 py-3 rounded-md transition duration-300 font-medium">
                        Our Story
                    </a>
                </div>
            </div>
            
            <!-- Right Content - Image -->
            <div class="w-full md:w-1/2 relative z-10" data-aos="fade-left" data-aos-delay="500">
                <div class="relative">
                    <!-- Main Image with Shadow -->
                    <div class="rounded-lg overflow-hidden  transform hover:scale-105 transition duration-500">
                        <img src="{{asset('frontend/images/couch.png')}}" alt="Luxury Furniture" class="w-full h-auto">
                    </div>
                    
                    <!-- Decorative Element - Top Right -->
                    {{-- <div class="absolute -top-8 -right-8 w-24 h-24 bg-wood rounded-full opacity-80 hidden md:block"></div> --}}
                    
                    <!-- Decorative Element - Bottom Left -->
                    {{-- <div class="absolute -bottom-6 -left-6 w-16 h-16 bg-light-navy rounded-full opacity-60 hidden md:block"></div> --}}
                </div>
            </div>
        </div>
        
        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize TypedJS for dynamic text animation
        if (document.getElementById('typed-text')) {
            new Typed('#typed-text', {
                strings: [
                    'Luxury Furniture',
                    'Timeless Elegance',
                    'Modern Designs',
                    'Premium Quality',
                    'Exquisite Craftsmanship'
                ],
                typeSpeed: 80,
                backSpeed: 50,
                backDelay: 1500,
                startDelay: 500,
                loop: true,
                smartBackspace: true
            });
        }
    });
</script>