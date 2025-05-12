<footer class="bg-navy text-white pt-16 pb-8">
    <!-- VantaJS Background will be applied to this div -->
    {{-- <div id="vanta-background" class="absolute inset-0 " style="z-index: -1" ></div> --}}
    
    <div class="container mx-auto px-4 md:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            <!-- Column 1: About -->
            <div>
                <h3 class="text-xl font-bold mb-6 border-b border-wood pb-2">About Us</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <img src="{{ asset('images/logo-white.png') }}" alt="Luxury Furniture" class="h-8 mr-3">
                        <span class="text-lg font-bold">Luxury Furniture</span>
                    </div>
                    <p class="text-gray-300">
                        Crafting exceptional furniture pieces that transform spaces into sophisticated sanctuaries since 2010.
                    </p>
                    <div class="flex space-x-4 pt-2">
                        <a href="#" class="text-gray-300 hover:text-light-wood transition-colors duration-300">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-light-wood transition-colors duration-300">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-light-wood transition-colors duration-300">
                            <i class="fab fa-pinterest-p text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-light-wood transition-colors duration-300">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Column 2: Quick Links -->
            <div>
                <h3 class="text-xl font-bold mb-6 border-b border-wood pb-2">Quick Links</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-gray-300 hover:text-light-wood flex items-center transition-colors duration-300">
                            <i class="fas fa-chevron-right text-xs mr-2 text-wood"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-light-wood flex items-center transition-colors duration-300">
                            <i class="fas fa-chevron-right text-xs mr-2 text-wood"></i> Shop
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-light-wood flex items-center transition-colors duration-300">
                            <i class="fas fa-chevron-right text-xs mr-2 text-wood"></i> About Us
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-light-wood flex items-center transition-colors duration-300">
                            <i class="fas fa-chevron-right text-xs mr-2 text-wood"></i> Contact
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-light-wood flex items-center transition-colors duration-300">
                            <i class="fas fa-chevron-right text-xs mr-2 text-wood"></i> Blog
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Column 3: Categories -->
            <div>
                <h3 class="text-xl font-bold mb-6 border-b border-wood pb-2">Categories</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-gray-300 hover:text-light-wood flex items-center transition-colors duration-300">
                            <i class="fas fa-chevron-right text-xs mr-2 text-wood"></i> Living Room
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-light-wood flex items-center transition-colors duration-300">
                            <i class="fas fa-chevron-right text-xs mr-2 text-wood"></i> Bedroom
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-light-wood flex items-center transition-colors duration-300">
                            <i class="fas fa-chevron-right text-xs mr-2 text-wood"></i> Dining Room
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-light-wood flex items-center transition-colors duration-300">
                            <i class="fas fa-chevron-right text-xs mr-2 text-wood"></i> Office
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-300 hover:text-light-wood flex items-center transition-colors duration-300">
                            <i class="fas fa-chevron-right text-xs mr-2 text-wood"></i> Outdoor
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Column 4: Contact Info -->
            <div>
                <h3 class="text-xl font-bold mb-6 border-b border-wood pb-2">Contact Us</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt text-wood mt-1 mr-3"></i>
                        <span class="text-gray-300">123 Luxury Lane, Suite 500<br>Beverly Hills, CA 90210</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone-alt text-wood mr-3"></i>
                        <a href="tel:+11234567890" class="text-gray-300 hover:text-light-wood transition-colors duration-300">+1 (123) 456-7890</a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope text-wood mr-3"></i>
                        <a href="mailto:info@luxuryfurniture.com" class="text-gray-300 hover:text-light-wood transition-colors duration-300">info@luxuryfurniture.com</a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-clock text-wood mr-3"></i>
                        <span class="text-gray-300">Mon-Sat: 10am - 7pm</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Bottom Section -->
        <div class="pt-8 border-t border-gray-700">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <!-- Copyright -->
                <div class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Luxury Furniture. All Rights Reserved.
                </div>
                
                <!-- Payment Methods -->
                <div class="flex space-x-4">
                    <i class="fab fa-cc-visa text-2xl text-gray-400"></i>
                    <i class="fab fa-cc-mastercard text-2xl text-gray-400"></i>
                    <i class="fab fa-cc-amex text-2xl text-gray-400"></i>
                    <i class="fab fa-cc-paypal text-2xl text-gray-400"></i>
                    <i class="fab fa-cc-apple-pay text-2xl text-gray-400"></i>
                </div>
                
                <!-- Terms & Policies -->
                <div class="flex space-x-4 text-sm">
                    <a href="#" class="text-gray-400 hover:text-light-wood transition-colors duration-300">Terms</a>
                    <a href="#" class="text-gray-400 hover:text-light-wood transition-colors duration-300">Privacy</a>
                    <a href="#" class="text-gray-400 hover:text-light-wood transition-colors duration-300">FAQ</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- VantaJS Initialization Script -->
    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            VANTA.NET({
                el: "#vanta-background",
                mouseControls: true,
                touchControls: true,
                gyroControls: false,
                minHeight: 200.00,
                minWidth: 200.00,
                scale: 1.00,
                scaleMobile: 1.00,
                color: 0xD4B996,
                backgroundColor: 0x0A192F,
                points: 8.00,
                maxDistance: 20.00,
                spacing: 18.00
            });
        });
    </script> --}}
</footer>
