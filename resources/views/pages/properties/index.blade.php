@extends('layouts.default')
@section('content')
 @include('includes.breadcrumb', [
        'title' => 'Properties',
        'backgroundImage' => 'img/bg-img/hero1.jpg'
    ])
        <!-- ##### Listing Content Wrapper Area Start ##### -->
    <section class="listings-content-wrapper section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="listings-top-meta d-flex justify-content-between mb-100">
                        <div class="view-area d-flex align-items-center">
                            <span>View as:</span>
                            <div class="grid_view ml-15"><a href="#" class="active"><i class="fa fa-th" aria-hidden="true"></i></a></div>
                            <div class="list_view ml-15"><a href="#"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>
                        </div>
                        <div class="order-by-area d-flex align-items-center">
                            <span class="mr-15">Order by:</span>
                            <form method="GET" action="{{ route('properties.index') }}" class="d-inline">
                                @foreach(request()->except('sort') as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                <select name="sort" onchange="this.form.submit()">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="area_large" {{ request('sort') == 'area_large' ? 'selected' : '' }}>Largest Area</option>
                                    <option value="area_small" {{ request('sort') == 'area_small' ? 'selected' : '' }}>Smallest Area</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section (Optional) -->
            @if(isset($filterOptions))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="filter-section bg-light p-4 rounded">
                        <form method="GET" action="{{ route('properties.index') }}" class="row">
                            <div class="col-md-3 mb-2">
                                <select name="property_type" class="form-control">
                                    <option value="">All Property Types</option>
                                    @foreach($filterOptions['property_types'] ?? [] as $type)
                                        <option value="{{ $type }}" {{ request('property_type') == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <select name="bedrooms" class="form-control">
                                    <option value="">Any Bedrooms</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ request('bedrooms') == $i ? 'selected' : '' }}>
                                            {{ $i }}+ Bed{{ $i > 1 ? 's' : '' }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <input type="number" name="min_price" class="form-control" placeholder="Min Price" value="{{ request('min_price') }}">
                            </div>
                            <div class="col-md-2 mb-2">
                                <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">
                            </div>
                            <div class="col-md-2 mb-2">
                                <select name="city" class="form-control">
                                    <option value="">All Cities</option>
                                    @foreach($filterOptions['cities'] ?? [] as $city)
                                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                            {{ $city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 mb-2">
                                <button type="submit" class="btn btn-primary btn-block">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            <!-- Properties Grid -->
            <div class="row">
                @forelse($properties as $property)
                <!-- Single Featured Property -->
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="single-featured-property mb-50">
                        <!-- Property Thumbnail -->
                        <div class="property-thumb">
                            <img src="{{ $property->image ? asset('img/properties/' . $property->image) : asset('img/bg-img/feature1.jpg') }}"
                                 alt="{{ $property->title }}" style="height: 250px; object-fit: cover; width: 100%;">

                            <!-- Status Tag -->
                            <div class="tag">
                                <span>{{ $property->status === 'Active' ? 'For Sale' : $property->status }}</span>
                            </div>

                            <!-- Price -->
                            <div class="list-price">
                                <p>${{ number_format($property->price, 0) }}</p>
                            </div>
                        </div>

                        <!-- Property Content -->
                        <div class="property-content">
                            <h5>{{ $property->title }}</h5>
                            <p class="location">
                                <img src="{{ asset('img/icons/location.png') }}" alt="">
                                {{ $property->address }}{{ $property->city ? ', ' . $property->city : '' }}
                            </p>
                            <p>{{ Str::limit($property->description, 80) }}</p>

                            <div class="property-meta-data d-flex align-items-end justify-content-between">
                                <!-- New/Featured Tags -->
                                <div class="badges">
                                    @if($property->is_new)
                                        <div class="new-tag">
                                            <img src="{{ asset('img/icons/new.png') }}" alt="">
                                        </div>
                                    @endif
                                    @if($property->is_featured)
                                        <div class="featured-tag" style="background: #f39c12; color: white; padding: 2px 8px; border-radius: 3px; font-size: 10px; margin-left: 5px;">
                                            FEATURED
                                        </div>
                                    @endif
                                </div>

                                <!-- Property Details -->
                                <div class="bathroom">
                                    <img src="{{ asset('img/icons/bathtub.png') }}" alt="">
                                    <span>{{ $property->bathrooms }}</span>
                                </div>

                                <div class="bedroom">
                                    <img src="{{ asset('img/icons/bed.png') }}" alt="" style="width: 16px; height: 16px;">
                                    <span>{{ $property->bedrooms }}</span>
                                </div>

                                <div class="space">
                                    <img src="{{ asset('img/icons/space.png') }}" alt="">
                                    <span>{{ number_format($property->area) }} sq ft</span>
                                </div>
                            </div>

                            <!-- Property Type -->
                            <div class="property-type mt-2">
                                <small class="text-muted">{{ $property->property_type }}{{ $property->building_type ? ' - ' . $property->building_type : '' }}</small>
                            </div>

                            <!-- View Details Button -->
                            <div class="mt-3">
                                <a href="{{ route('property.show', $property->id) }}" class="btn btn-outline-primary btn-sm">
                                    View Details
                                </a>
                               <a href="{{ route('property.show', $property->id) }}" class="btn btn-outline-success btn-sm ml-2" >
                                        Inquire
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- No Properties Found -->
                <div class="col-12">
                    <div class="text-center py-5">
                        <img src="{{ asset('img/icons/no-results.png') }}" alt="No properties found" style="width: 100px; opacity: 0.5;">
                        <h4 class="mt-3 text-muted">No Properties Found</h4>
                        <p class="text-muted">Try adjusting your search criteria or browse all properties.</p>
                        <a href="{{ route('properties.index') }}" class="btn btn-primary">View All Properties</a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($properties->hasPages())
            <div class="row">
                <div class="col-12">
                    <div class="south-pagination d-flex justify-content-center">
                        {{ $properties->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
            @endif

            <!-- Results Info -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="results-info text-center text-muted">
                        <small>
                            Showing {{ $properties->firstItem() ?? 0 }} to {{ $properties->lastItem() ?? 0 }}
                            of {{ $properties->total() }} properties
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Listing Content Wrapper Area End ##### -->

@endsection
