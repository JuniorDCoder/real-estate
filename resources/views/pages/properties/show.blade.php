@extends('layouts.default')

@section('title', $property->title . ' - ' . config('app.name'))

@section('content')
    @include('includes.breadcrumb', [
        'title' => 'Property Details',
        'backgroundImage' => asset('img/bg-img/hero1.jpg')
    ])

    @include('includes.property-search')

    <!-- ##### Listings Content Area Start ##### -->
    <section class="listings-content-wrapper section-padding-100">
        <div class="container">
            {{-- Success/Error Messages --}}
            @if(session('success'))
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <!-- Single Listings Slides -->
                    <div class="single-listings-sliders owl-carousel">
                        @if($property->images && $property->images->count())
                            @foreach($property->images as $img)
                                @if($img->image && file_exists(public_path('img/properties/' . $img->image)))
                                    <img src="{{ asset('img/properties/' . $img->image) }}" alt="{{ $property->title }}">
                                @endif
                            @endforeach
                        @elseif($property->image && file_exists(public_path('img/properties/' . $property->image)))
                            <img src="{{ asset('img/properties/' . $property->image) }}" alt="{{ $property->title }}">
                        @else
                            <img src="{{ asset('img/bg-img/no-image.png') }}" alt="No image available">
                        @endif
                    </div>
                    @if($property->images && $property->images->count() > 1)
                        <div class="property-thumbnails d-flex mt-2">
                            @foreach($property->images as $img)
                                @if($img->image && file_exists(public_path('img/properties/' . $img->image)))
                                    <img src="{{ asset('img/properties/' . $img->image) }}" alt="Thumbnail"
                                        style="width:60px;height:60px;object-fit:cover;margin-right:8px;cursor:pointer;"
                                        onclick="$('.single-listings-sliders').trigger('to.owl.carousel', [{{ $loop->index }}, 300]);">
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <!-- Property Details -->
                    <div class="listings-details">
                        <h2>{{ $property->title }}</h2>
                        <p class="location">
                            <img src="{{ asset('img/icons/location.png') }}" alt="Location">
                            {{ $property->address }}{{ $property->city ? ', ' . $property->city : '' }}
                        </p>
                        <p class="description">{{ $property->description }}</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="listings-content">
                        <!-- Price -->
                        <div class="list-price">
                            <p>{{ $property->formatted_price }}</p>
                        </div>

                        <h5>{{ $property->title }}</h5>
                        <p class="location">
                            <img src="{{ asset('img/icons/location.png') }}" alt="Location">
                            {{ $property->address }}{{ $property->city ? ', ' . $property->city : '' }}
                        </p>

                        <p>{{ $property->description }}</p>

                        <!-- Property Meta Data -->
                        <div class="property-meta-data d-flex align-items-end">
                            @if($property->is_new)
                                <div class="new-tag">
                                    <img src="{{ asset('img/icons/new.png') }}" alt="New">
                                </div>
                            @endif

                            <div class="bathroom">
                                <img src="{{ asset('img/icons/bathtub.png') }}" alt="Bathrooms">
                                <span>{{ $property->bathrooms }}</span>
                            </div>

                            <div class="garage">
                                <img src="{{ asset('img/icons/garage.png') }}" alt="Bedrooms">
                                <span>{{ $property->bedrooms }}</span>
                            </div>

                            <div class="space">
                                <img src="{{ asset('img/icons/space.png') }}" alt="Area">
                                <span>{{ $property->formatted_area }}</span>
                            </div>
                        </div>

                        <!-- Core Features -->
                        <ul class="listings-core-features d-flex align-items-center">
                            @foreach($property->getCoreFeatures() as $feature)
                                <li><i class="fa fa-check" aria-hidden="true"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>

                        <!-- Property Information -->
                        <div class="property-details-info mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Property Information</h6>
                                    <ul class="property-info-list">
                                        <li><strong>Property Type:</strong> {{ $property->property_type }}</li>
                                        @if($property->building_type)
                                            <li><strong>Building Type:</strong> {{ $property->building_type }}</li>
                                        @endif
                                        <li><strong>Bedrooms:</strong> {{ $property->bedrooms }}</li>
                                        <li><strong>Bathrooms:</strong> {{ $property->bathrooms }}</li>
                                        <li><strong>Area:</strong> {{ $property->formatted_area }}</li>
                                        <li><strong>Status:</strong>
                                            <span class="badge bg-success">{{ $property->status }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Listings Btn Groups -->
                        <div class="listings-btn-groups mt-4">
                            <a href="#contact-form" class="btn south-btn">Contact Agent</a>
                            <a href="#" class="btn south-btn active">Schedule Viewing</a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form Sidebar -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="contact-realtor-wrapper" id="contact-form">
                        <div class="realtor-info">
                            <img src="{{ asset('img/bg-img/editor-1.jpg') }}" alt="Real Estate Agent">
                            <div class="realtor---info">
                                <h2>Kevin T. Clayton</h2>
                                <p>Senior Real Estate Agent</p>
                                <h6>
                                    <img src="{{ asset('img/icons/phone-call.png') }}" alt="Phone">
                                    {{ env('PHONE_NUMBER', '+1 (555) 123-4567') }}
                                </h6>
                                <h6>
                                    <img src="{{ asset('img/icons/envelope.png') }}" alt="Email">
                                    {{ env('MAIL_FROM_ADDRESS', 'info@example.com') }}
                                </h6>
                            </div>
                            <div class="realtor--contact-form">
                                <h6 class="mb-3">Inquire About This Property</h6>
                                <form action="{{ route('property.contact', $property->id) }}" method="POST" id="propertyContactForm">
                                    @csrf

                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="name"
                                               id="realtor-name"
                                               placeholder="Your Full Name"
                                               value="{{ old('name') }}"
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="tel"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               name="phone"
                                               id="realtor-number"
                                               placeholder="Your Phone Number"
                                               value="{{ old('phone') }}"
                                               required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               name="email"
                                               id="realtor-email"
                                               placeholder="Your Email Address"
                                               value="{{ old('email') }}"
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <textarea name="message"
                                                  class="form-control @error('message') is-invalid @enderror"
                                                  id="realtor-message"
                                                  cols="30"
                                                  rows="6"
                                                  placeholder="I'm interested in this property. Please contact me with more details."
                                                  required>{{ old('message', "I'm interested in the property: " . $property->title . ". Please contact me with more details.") }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn south-btn" id="submitPropertyBtn">
                                        <span class="btn-text">Send Inquiry</span>
                                        <span class="btn-loading" style="display: none;">
                                            <i class="fa fa-spinner fa-spin"></i> Sending...
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Listings Content Area End ##### -->

    @if($relatedProperties && $relatedProperties->count() > 0)
        <!-- ##### Related Properties Start ##### -->
        <section class="south-featured-properties section-padding-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading wow fadeInUp" data-wow-delay="250ms">
                            <h2>Similar Properties</h2>
                            <p>Properties in the same area</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach($relatedProperties as $relatedProperty)
                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="single-featured-property mb-30">
                                <!-- Property Thumbnail -->
                                <div class="property-thumb">
                                    <img src="{{ $relatedProperty->image_url }}" alt="{{ $relatedProperty->title }}">
                                    <div class="tag">
                                        <span>{{ $relatedProperty->property_type }}</span>
                                    </div>
                                    <div class="list-price">
                                        <p>{{ $relatedProperty->formatted_price }}</p>
                                    </div>
                                </div>
                                <!-- Property Content -->
                                <div class="property-content">
                                    <h5><a href="{{ route('property.show', $relatedProperty->id) }}">{{ $relatedProperty->title }}</a></h5>
                                    <p class="location">
                                        <img src="{{ asset('img/icons/location.png') }}" alt="Location">
                                        {{ $relatedProperty->address }}
                                    </p>
                                    <p>{{ Str::limit($relatedProperty->description, 80) }}</p>
                                    <div class="property-meta-data d-flex align-items-end justify-content-between">
                                        @if($relatedProperty->is_new)
                                            <div class="new-tag">
                                                <img src="{{ asset('img/icons/new.png') }}" alt="New">
                                            </div>
                                        @endif
                                        <div class="bathroom">
                                            <img src="{{ asset('img/icons/bathtub.png') }}" alt="Bathrooms">
                                            <span>{{ $relatedProperty->bathrooms }}</span>
                                        </div>
                                        <div class="garage">
                                            <img src="{{ asset('img/icons/garage.png') }}" alt="Bedrooms">
                                            <span>{{ $relatedProperty->bedrooms }}</span>
                                        </div>
                                        <div class="space">
                                            <img src="{{ asset('img/icons/space.png') }}" alt="Space">
                                            <span>{{ $relatedProperty->formatted_area }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ##### Related Properties End ##### -->
    @endif
@endsection

@push('styles')
<style>
.property-info-list {
    list-style: none;
    padding: 0;
}

.property-info-list li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}

.property-info-list li:last-child {
    border-bottom: none;
}

.property-details-info {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-top: 20px;
}

.alert {
    margin-bottom: 20px;
}

.invalid-feedback {
    display: block;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('propertyContactForm');
    const submitBtn = document.getElementById('submitPropertyBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');

    form.addEventListener('submit', function() {
        // Disable button and show loading state
        submitBtn.disabled = true;
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-block';
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.style.display = 'none';
            }, 300);
        }, 5000);
    });

    // Smooth scroll to contact form
    const contactLinks = document.querySelectorAll('a[href="#contact-form"]');
    contactLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('contact-form').scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
</script>
@endpush
