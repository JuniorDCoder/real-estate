<section class="about-content-wrapper section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="section-heading text-left wow fadeInUp" data-wow-delay="250ms">
                    <h2>We Help You Find Your Perfect Home</h2>
                    <p>Your trusted partner in real estate</p>
                </div>
                <div class="about-content">
                    <img class="wow fadeInUp" data-wow-delay="350ms" src="img/bg-img/about.jpg" alt="About Us">
                    <p class="wow fadeInUp" data-wow-delay="450ms">
                        With years of experience in the real estate industry, we are committed to helping you find the perfect property that meets your needs and budget. Our team of professional agents provides personalized service, market expertise, and comprehensive support throughout your property journey. Whether you're buying, selling, or renting, we ensure a smooth and successful experience with complete transparency and integrity.
                    </p>
                </div>
            </div>

            @include('includes.featured-properties-sidebar', [
                'featuredProperties' => $featuredProperties ?? collect()
            ])
        </div>
    </div>
</section>
