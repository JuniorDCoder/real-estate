<!-- ##### Featured Properties Area Start ##### -->
<section class="featured-properties-area section-padding-100-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading wow fadeInUp">
                    <h2>Featured Properties</h2>
                    <p>Discover our handpicked selection of premium properties in prime locations.</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($properties as $index => $property)
                <!-- Single Featured Property -->
                <a href="{{ route('property.show', ['property' => $property]) }}" class="col-12 col-md-6 col-xl-4">
                    <div class="single-featured-property mb-50 wow fadeInUp" data-wow-delay="{{ ($index + 1) * 100 }}ms">
                        <!-- Property Thumbnail -->
                        <div class="property-thumb">
                            <img src="img/bg-img/{{ $property->image }}" alt="{{ $property->title }}">

                            <div class="tag">
                                <span>For Sale</span>
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
                                @if($property->created_at >= now()->subDays(30))
                                    <div class="new-tag">
                                        <img src="img/icons/new.png" alt="New">
                                    </div>
                                @endif
                                <div class="bedrooms">
                                    <img src="img/icons/garage.png" alt="Bedrooms">
                                    <span>{{ $property->bedrooms }}</span>
                                </div>
                                <div class="bathroom">
                                    <img src="img/icons/bathtub.png" alt="Bathrooms">
                                    <span>{{ $property->bathrooms }}</span>
                                </div>
                                <div class="space">
                                    <img src="img/icons/space.png" alt="Area">
                                    <span>{{ number_format($property->area) }} sq ft</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- View All Properties Button -->
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg mt-4">
                    View All Properties
                </a>
            </div>
        </div>
    </div>
</section>
<!-- ##### Featured Properties Area End ##### -->
