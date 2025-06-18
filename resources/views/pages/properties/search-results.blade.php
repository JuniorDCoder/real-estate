@extends('layouts.default')

@section('content')
    <!-- ##### Search Results Header ##### -->
    <section style="padding-top: 40%;" class="search-results-header bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="mb-3">Property Search Results</h1>

                    @if(!empty($searchParams))
                        <div class="search-summary">
                            <p class="mb-2">
                                <strong>{{ $properties->total() }}</strong> properties found
                                @if(array_filter($searchParams))
                                    matching your criteria:
                                @endif
                            </p>

                            @if(array_filter($searchParams))
                                <div class="active-filters d-flex flex-wrap gap-2 mb-3">
                                    @foreach($searchParams as $key => $value)
                                        @if($value && $key !== '_token' && $key !== 'page')
                                            <span class="badge bg-primary">
                                                {{ ucfirst(str_replace('_', ' ', $key)) }}:
                                                @if(is_array($value))
                                                    {{ implode(', ', $value) }}
                                                @else
                                                    {{ $value }}
                                                @endif
                                                <a href="{{ request()->fullUrlWithQuery([$key => null]) }}"
                                                   class="text-white ms-1">×</a>
                                            </span>
                                        @endif
                                    @endforeach

                                    @if(count(array_filter($searchParams)) > 1)
                                        <a href="{{ route('properties.index') }}" class="btn btn-sm btn-outline-secondary">
                                            Clear All Filters
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- ##### Search Form ##### -->
    @include('includes.property-search')

    <!-- ##### Search Results ##### -->
    <section class="search-results py-5">
        <div class="container">

            @if($properties->count() > 0)
                <!-- Sort and View Options -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="results-info">
                            <p>Showing {{ $properties->firstItem() }} - {{ $properties->lastItem() }}
                               of {{ $properties->total() }} results</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sort-options d-flex justify-content-end">
                            <form method="GET" class="d-flex align-items-center">
                                @foreach(request()->query() as $key => $value)
                                    @if($key !== 'sort')
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endif
                                @endforeach
                                <label for="sort" class="me-2">Sort by:</label>
                                <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                                        Latest First
                                    </option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                        Price: Low to High
                                    </option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                        Price: High to Low
                                    </option>
                                    <option value="sqft_large" {{ request('sort') == 'sqft_large' ? 'selected' : '' }}>
                                        Largest First
                                    </option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Properties Grid -->
                <div class="row">
                    @foreach($properties as $property)
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            <div class="property-card h-100">
                                <div class="card shadow-sm">
                                    <!-- Property Image -->
                                    <div class="property-image position-relative">
                                        @if($property->featured_image)
                                            <img src="{{ asset('storage/' . $property->featured_image) }}"
                                                 class="card-img-top" alt="{{ $property->title }}"
                                                 style="height: 250px; object-fit: cover;">
                                        @else
                                            <div class="placeholder-image bg-light d-flex align-items-center justify-content-center"
                                                 style="height: 250px;">
                                                <i class="fa fa-home fa-3x text-muted"></i>
                                            </div>
                                        @endif

                                        <!-- Status Badge -->
                                        <span class="badge position-absolute top-0 end-0 m-2
                                                   {{ $property->status === 'Active' ? 'bg-success' :
                                                      ($property->status === 'Pending' ? 'bg-warning' : 'bg-danger') }}">
                                            {{ $property->status }}
                                        </span>

                                        <!-- Price Badge -->
                                        <div class="price-badge position-absolute bottom-0 start-0 m-2">
                                            <span class="badge bg-dark fs-6">
                                                ${{ number_format($property->price) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Property Details -->
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $property->title }}</h5>
                                        <p class="text-muted mb-2">
                                            <i class="fa fa-map-marker-alt me-1"></i>
                                            {{ $property->address }}
                                        </p>

                                        <!-- Property Features -->
                                        <div class="property-features d-flex justify-content-between mb-3">
                                            @if($property->bedrooms)
                                                <span class="feature">
                                                    <i class="fa fa-bed me-1"></i>{{ $property->bedrooms }} Bed
                                                </span>
                                            @endif
                                            @if($property->bathrooms)
                                                <span class="feature">
                                                    <i class="fa fa-bath me-1"></i>{{ $property->bathrooms }} Bath
                                                </span>
                                            @endif
                                            @if($property->square_footage)
                                                <span class="feature">
                                                    <i class="fa fa-ruler-combined me-1"></i>{{ number_format($property->square_footage) }} sqft
                                                </span>
                                                                                            @endif
                                        </div>

                                        <!-- Property Description (Truncated) -->
                                        <p class="card-text">
                                            {{ Str::limit($property->description, 100) }}
                                        </p>

                                        <!-- Property Actions -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('property.show', $property->id) }}"
                                               class="btn btn-primary btn-sm">
                                                View Details
                                            </a>
                                            <small class="text-muted">
                                                {{ $property->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            {{ $properties->appends(request()->query())->links() }}
                        </nav>
                    </div>
                </div>
            @else
                <!-- No Results Found -->
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info text-center py-5">
                            <h4>No properties found matching your criteria</h4>
                            <p class="mb-0">Try adjusting your search filters or <a href="{{ route('properties.index') }}">browse all properties</a>.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Initialize any necessary JavaScript for the search results page
        document.addEventListener('DOMContentLoaded', function() {
            // You can add any specific JavaScript functionality here
            // For example, handling the favorite button clicks or map integration
        });
    </script>
@endsection
