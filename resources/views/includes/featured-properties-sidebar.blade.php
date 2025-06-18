<div class="col-12 col-lg-4">
    <div class="section-heading text-left wow fadeInUp" data-wow-delay="250ms">
        <h2>Featured Properties</h2>
        <p>Discover our premium property listings</p>
    </div>

    @if($featuredProperties && $featuredProperties->count() > 0)
        <div class="featured-properties-slides owl-carousel wow fadeInUp" data-wow-delay="350ms">
            @foreach($featuredProperties as $property)
                <div class="single-featured-property">
                    <!-- Property Thumbnail -->
                    <div class="property-thumb">
                        <img src="{{ $property->featured_image ?? 'img/bg-img/default-property.png' }}" alt="{{ $property->title }}">

                        <div class="tag">
                            <span>{{ ucfirst($property->type) }}</span>
                        </div>
                        <div class="list-price">
                            <p>${{ number_format($property->price) }}</p>
                        </div>
                    </div>

                    <!-- Property Content -->
                    <div class="property-content">
                        <h5>{{ $property->title }}</h5>
                        <p class="location">
                            <img src="img/icons/location.png" alt="Location">
                            {{ $property->address }}
                        </p>
                        <p>{{ Str::limit($property->description, 80) }}</p>

                        <div class="property-meta-data d-flex align-items-end justify-content-between">
                            @if($property->is_new)
                                <div class="new-tag">
                                    <img src="img/icons/new.png" alt="New">
                                </div>
                            @endif

                            @if($property->bathrooms)
                                <div class="bathroom">
                                    <img src="img/icons/bathtub.png" alt="Bathrooms">
                                    <span>{{ $property->bathrooms }}</span>
                                </div>
                            @endif

                            @if($property->garage)
                                <div class="garage">
                                    <img src="img/icons/garage.png" alt="Garage">
                                    <span>{{ $property->garage }}</span>
                                </div>
                            @endif

                            @if($property->square_feet)
                                <div class="space">
                                    <img src="img/icons/space.png" alt="Space">
                                    <span>{{ number_format($property->square_feet) }} sq ft</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="no-properties-message">
            <p>No featured properties available at the moment.</p>
        </div>
    @endif
</div>
