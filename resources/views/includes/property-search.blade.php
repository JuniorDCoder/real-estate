<!-- ##### Advanced Property Search Area Start ##### -->
<div class="south-search-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="advanced-search-form">
                    <!-- Search Title -->
                    <div class="search-title">
                        <p>Advanced Property Search</p>
                    </div>
                    <!-- Search Form -->
                    <form action="{{ route('properties.search') }}" method="post" id="advanceSearch">
                        @csrf
                        <div class="row">

                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="keyword"
                                           placeholder="Search Keywords"
                                           value="{{ request('keyword') }}">
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <select class="form-control" name="location">
                                        <option value="">All Locations</option>
                                        @if(isset($filterOptions['locations']))
                                            @foreach($filterOptions['locations'] as $location)
                                                <option value="{{ $location }}"
                                                        {{ request('location') == $location ? 'selected' : '' }}>
                                                    {{ $location }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <select class="form-control" name="property_type">
                                        <option value="">Property Type</option>
                                        @if(isset($filterOptions['property_types']))
                                            @foreach($filterOptions['property_types'] as $type)
                                                <option value="{{ $type }}"
                                                        {{ request('property_type') == $type ? 'selected' : '' }}>
                                                    {{ ucfirst($type) }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <select class="form-control" name="price_range">
                                        <option value="">Price Range</option>
                                        @if(isset($filterOptions['price_ranges']))
                                            @foreach($filterOptions['price_ranges'] as $range)
                                                <option value="{{ $range }}"
                                                        {{ request('price_range') == $range ? 'selected' : '' }}>
                                                    {{ $range }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-xl-3">
                                <div class="form-group">
                                    <select class="form-control" name="listing_status">
                                        <option value="">Listing Status</option>
                                        @if(isset($filterOptions['listing_statuses']))
                                            @foreach($filterOptions['listing_statuses'] as $status)
                                                <option value="{{ $status }}"
                                                        {{ request('listing_status') == $status ? 'selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-xl-2">
                                <div class="form-group">
                                    <select class="form-control" name="bedrooms">
                                        <option value="">Bedrooms</option>
                                        @if(isset($filterOptions['bedrooms_options']))
                                            @foreach($filterOptions['bedrooms_options'] as $bedroom)
                                                <option value="{{ $bedroom }}"
                                                        {{ request('bedrooms') == $bedroom ? 'selected' : '' }}>
                                                    {{ $bedroom }}{{ $bedroom >= 5 ? '+' : '' }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-xl-2">
                                <div class="form-group">
                                    <select class="form-control" name="bathrooms">
                                        <option value="">Bathrooms</option>
                                        @if(isset($filterOptions['bathrooms_options']))
                                            @foreach($filterOptions['bathrooms_options'] as $bathroom)
                                                <option value="{{ $bathroom }}"
                                                        {{ request('bathrooms') == $bathroom ? 'selected' : '' }}>
                                                    {{ $bathroom }}{{ $bathroom >= 5 ? '+' : '' }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-8 col-lg-12 col-xl-5 d-flex">
                                <!-- Living Space Range -->
                                <div class="slider-range">
                                    <label>Square Footage</label>
                                    <div class="d-flex gap-2">
                                        <input type="number" class="form-control" name="min_sqft"
                                               placeholder="Min" value="{{ request('min_sqft') }}">
                                        <input type="number" class="form-control" name="max_sqft"
                                               placeholder="Max" value="{{ request('max_sqft') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 search-form-second-steps" style="display: none;" id="advanced-filters">
                                <div class="row">

                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <select class="form-control" name="building_type">
                                                <option value="">Building Type</option>
                                                @if(isset($filterOptions['building_types']))
                                                    @foreach($filterOptions['building_types'] as $type)
                                                        <option value="{{ $type }}"
                                                                {{ request('building_type') == $type ? 'selected' : '' }}>
                                                            {{ ucfirst($type) }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <select class="form-control" name="transaction_type">
                                                <option value="">Transaction Type</option>
                                                @if(isset($filterOptions['transaction_types']))
                                                    @foreach($filterOptions['transaction_types'] as $type)
                                                        <option value="{{ $type }}"
                                                                {{ request('transaction_type') == $type ? 'selected' : '' }}>
                                                            {{ ucfirst($type) }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <select class="form-control" name="neighborhood">
                                                <option value="">Neighborhoods</option>
                                                @if(isset($filterOptions['neighborhoods']))
                                                    @foreach($filterOptions['neighborhoods'] as $neighborhood)
                                                        <option value="{{ $neighborhood }}"
                                                                {{ request('neighborhood') == $neighborhood ? 'selected' : '' }}>
                                                            {{ $neighborhood }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label>Special Features</label>
                                            @if(isset($filterOptions['features']))
                                                @foreach($filterOptions['features'] as $feature)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               name="features[]" value="{{ $feature }}"
                                                               id="feature_{{ $loop->index }}"
                                                               {{ in_array($feature, (array) request('features', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="feature_{{ $loop->index }}">
                                                            {{ $feature }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-between align-items-end">
                                <!-- More Filter -->
                                <div class="more-filter">
                                    <a href="#" id="moreFilter">+ Advanced Filters</a>
                                </div>
                                <!-- Submit -->
                                <div class="form-group mb-0 d-flex gap-2">
                                    <button type="submit" class="btn south-btn">Search Properties</button>
                                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">Clear All</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const moreFilterBtn = document.getElementById('moreFilter');
    const advancedFilters = document.getElementById('advanced-filters');

    if (moreFilterBtn && advancedFilters) {
        moreFilterBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (advancedFilters.style.display === 'none' || advancedFilters.style.display === '') {
                advancedFilters.style.display = 'block';
                this.textContent = '- Hide Filters';
            } else {
                advancedFilters.style.display = 'none';
                this.textContent = '+ Advanced Filters';
            }
        });
    }
});
</script>
<!-- ##### Advanced Property Search Area End ##### -->
