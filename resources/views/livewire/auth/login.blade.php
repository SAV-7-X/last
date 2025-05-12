<div class="container" style="overflow: hidden; height: 100vh;">
    <div class="row g-0 login-container">
        <!-- Image Side -->
        <div class="col-lg-6 login-img-container d-none d-lg-block" style="overflow:hidden; height: 100vh; ">
            <img src="{{asset('images/login.jpg')}}" alt="Luxury Furniture"  class="login-img">
            <div class="image-overlay"></div>
            <div class="img-text-overlay">
                <span class="badge-premium">PREMIUM</span>
                <span class="badge-premium" style="background-color: var(--secondary);">COLLECTION</span>
                <h3>Elegant Living Spaces</h3>
                <p class="mb-0 text-white opacity-75">Discover timeless designs with modern comfort</p>
            </div>
        </div>
        
        <!-- Login Form Side -->
        <div class="col-lg-6 login-form-container">
            <!-- Pattern overlay -->
            <div class="pattern-overlay"></div>
            
            <div class="px-md-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="me-3">
                        <i class="fas fa-couch" style="font-size: 2rem; color: var(--primary);"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 accent-text" style="font-family: 'Playfair Display', serif;">Luxury Furniture</h5>
                        <small class="text-muted">Premium Quality Since 1995</small>
                    </div>
                </div>
                
                <h2 class="form-title login-animation">Welcome <span class="accent-text">Back</span></h2>
                <p class="text-muted mb-4 form-subtitle login-animation">Sign in to continue your luxury furniture journey</p>
                
                <!-- Login Form -->
                <form wire:submit.prevent="login">
                    <div class="form-floating login-animation">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" wire:model.lazy="email">
                        <label for="email"><i class="far fa-envelope me-2 text-muted"></i>Email address</label>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="form-floating password-wrapper login-animation">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" wire:model.lazy="password">
                        <label for="password"><i class="fas fa-lock me-2 text-muted"></i>Password</label>
                        <span class="password-toggle" id="passwordToggle">
                            <i class="fa-regular fa-eye"></i>
                        </span>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check login-animation">
                            <input class="form-check-input" type="checkbox" id="rememberMe" wire:model="remember">
                            <label class="form-check-label text-muted" for="rememberMe">
                                Remember me
                            </label>
                        </div>
                        <a href="" class="accent-text login-animation forgot-password">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 login-animation" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="login" class="me-2">SIGN IN</span>
                        <i wire:loading.remove wire:target="login" class="fas fa-arrow-right"></i>
                        <span wire:loading wire:target="login" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        <span wire:loading wire:target="login">Signing in...</span>
                    </button>
                </form>
                
                <div class="text-center divider login-animation">
                    <span class="divider-text">OR CONTINUE WITH</span>
                </div>
                
                <!-- Social Login Options -->
                <div class="social-login d-flex justify-content-center login-animation">
                    <a href="#" wire:click.prevent="loginWithGoogle" class="social-btn">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" wire:click.prevent="loginWithFacebook" class="social-btn">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" wire:click.prevent="loginWithApple" class="social-btn">
                        <i class="fab fa-apple"></i>
                    </a>
                </div>
                
                <div class="form-footer login-animation">
                    <p class="text-muted">
                        Don't have an account? <a href="{{route('register')}}" wire:navigate>Create Account</a>
                    </p>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
