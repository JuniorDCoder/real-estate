    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area section-padding-100-0 bg-img gradient-background-overlay" style="background-image: url(img/bg-img/cta.jpg);">
        <!-- Main Footer Area -->
        <div class="main-footer-area">
            <div class="container">
                <div class="row">

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="footer-widget-area mb-100">
                            <!-- Widget Title -->
                            <div class="widget-title">
                                <h6>About Us</h6>
                            </div>

                            <img src="{{ asset('img/bg-img/footer.jpg') }}" alt="">
                            <div class="footer-logo my-4">
                                <img src="{{ asset('img/core-img/logo.png') }}" alt="">
                            </div>
                            <p>
                                {{ config('app.name') }} is your trusted platform for discovering, buying, and selling real estate. We connect buyers, sellers, and agents to make property transactions seamless and secure.
                            </p>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="footer-widget-area mb-100">
                            <!-- Widget Title -->
                            <div class="widget-title">
                                <h6>Hours</h6>
                            </div>
                            <!-- Office Hours -->
                            <div class="weekly-office-hours">
                                <ul>
                                    <li class="d-flex align-items-center justify-content-between"><span>Monday - Friday</span> <span>09 AM - 19 PM</span></li>
                                    <li class="d-flex align-items-center justify-content-between"><span>Saturday</span> <span>09 AM - 14 PM</span></li>
                                    <li class="d-flex align-items-center justify-content-between"><span>Sunday</span> <span>Closed</span></li>
                                </ul>
                            </div>
                            <!-- Address -->
                            <div class="address">
                                <h6><img src="{{ asset('img/icons/phone-call.png') }}" alt=""> {{ env('PHONE_NUMBER') }}</h6>
                                <h6><img src="{{ asset('img/icons/envelope.png') }}" alt="">
                                    {{ env('MAIL_FROM_ADDRESS') }}
                                </h6>
                                <h6><img src="{{ asset('img/icons/location.png') }}" alt=""> {{ env('ADDRESS') }}</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="footer-widget-area mb-100">
                            <!-- Widget Title -->
                            <div class="widget-title">
                                <h6>Useful Links</h6>
                            </div>
                            <!-- Nav -->
                            <ul class="useful-links-nav d-flex align-items-center">
                                   <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('properties.index') }}">Properties</a></li>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="footer-widget-area mb-100">
                            <!-- Widget Title -->
                            <div class="widget-title">
                                <h6>Featured Properties</h6>
                            </div>
                            <!-- Featured Properties Slides -->
                            <div class="featured-properties-slides owl-carousel">
                                <!-- Single Slide -->
                                <div class="single-featured-properties-slide">
                                    <a href="#"><img src="{{ asset('img/bg-img/fea-product.jpg') }}" alt=""></a>
                                </div>
                                <!-- Single Slide -->
                                <div class="single-featured-properties-slide">
                                    <a href="#"><img src="{{ asset('img/bg-img/fea-product.jpg') }}" alt=""></a>
                                </div>
                                <!-- Single Slide -->
                                <div class="single-featured-properties-slide">
                                    <a href="#"><img src="{{ asset('img/bg-img/fea-product.jpg') }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Copywrite Text -->
        <div class="copywrite-text d-flex align-items-center justify-content-center">
            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->
