<footer class="footer-section">
    <div class="container relative">

        <div class="sofa-img">
            <img src="{{ asset('frontend/images/sofa.png') }}" alt="Image" class="img-fluid">
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="subscription-form">
                    <h3 class="d-flex align-items-center">
                        <span class="me-1">
                            <img src="{{ asset('frontend/images/envelope-outline.svg') }}" alt="Image" class="img-fluid">
                        </span>
                        <span>Subscribe to Newsletter</span>
                    </h3>

                    <form action="#" class="row g-3">
                        <div class="col-auto">
                            <input type="text" class="form-control" placeholder="Enter your name">
                        </div>
                        <div class="col-auto">
                            <input type="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">
                                <span class="fa fa-paper-plane"></span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="row g-5 mb-5">
            <div class="col-lg-4">
                <div class="mb-4 footer-logo-wrap">
                    <a wire:navigate href="{{ route('home') }}" class="footer-logo">Furni<span>.</span></a>
                </div>
                <p class="mb-4">
                    Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada.
                    Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant
                </p>

                <ul class="list-unstyled custom-social">
                    <li><a wire:navigate href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                    <li><a wire:navigate href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                    <li><a wire:navigate href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                    <li><a wire:navigate href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                </ul>
            </div>

            <div class="col-lg-8">
                <div class="row links-wrap">
                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a wire:navigate href="{{ route('about') }}">About us</a></li>
                            <li><a wire:navigate href="{{ route('services') }}">Services</a></li>
                            <li><a wire:navigate href="{{ route('blog') }}">Blog</a></li>
                            <li><a wire:navigate href="{{ route('contact') }}">Contact us</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a wire:navigate href="{{ route('support') }}">Support</a></li>
                            <li><a wire:navigate href="{{ route('knowledge') }}">Knowledge base</a></li>
                            <li><a wire:navigate href="{{ route('livechat') }}">Live chat</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a wire:navigate href="{{ route('jobs') }}">Jobs</a></li>
                            <li><a wire:navigate href="{{ route('team') }}">Our team</a></li>
                            <li><a wire:navigate href="{{ route('leadership') }}">Leadership</a></li>
                            <li><a wire:navigate href="{{ route('privacy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a wire:navigate href="#">Nordic Chair</a></li>
                            <li><a wire:navigate href="#">Kruzo Aero</a></li>
                            <li><a wire:navigate href="#">Ergonomic Chair</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="border-top copyright">
            <div class="row pt-4">
                <div class="col-lg-6">
                    <p class="mb-2 text-center text-lg-start">
                        Copyright
                        &copy;2025. All Rights Reserved.
                        &mdash; Designed with love by <a href="https://untree.co" target="_blank">Untree.co</a>
                    </p>
                </div>

                <div class="col-lg-6 text-center text-lg-end">
                    <ul class="list-unstyled d-inline-flex ms-auto">
                        <li class="me-4"><a wire:navigate href="#">Terms &amp; Conditions</a></li>
                        <li><a wire:navigate href="{{ route('privacy') }}">Privacy Policy</a></li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</footer>
<!-- End Footer Section -->	

<!-- Scripts -->
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/tiny-slider.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
