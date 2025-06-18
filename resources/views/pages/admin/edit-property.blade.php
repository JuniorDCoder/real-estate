@extends('layouts.auth')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="breadcrumb-separator">/</span>
    <span>Edit Property</span>
@endsection

@section('body-class', 'pages-admin-edit-property')
@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="breadcrumb-separator">/</span>
    <a href="{{ route('admin.properties.index') }}">List Properties</a>
    <span class="breadcrumb-separator">/</span>
    <span>Edit Property</span>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Edit Property</h2>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" id="editPropertyForm">
            @csrf
            <div class="form-group">
                <label class="form-label" for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $property->title) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $property->description) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $property->address) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="city">City</label>
                <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $property->city) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $property->price) }}" step="0.01" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="property_type">Property Type</label>
                <select name="property_type" id="property_type" class="form-control" required>
                    <option value="House" {{ old('property_type', $property->property_type) == 'House' ? 'selected' : '' }}>House</option>
                    <option value="Apartment" {{ old('property_type', $property->property_type) == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                    <option value="Commercial" {{ old('property_type', $property->property_type) == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="building_type">Building Type</label>
                <input type="text" name="building_type" id="building_type" class="form-control" value="{{ old('building_type', $property->building_type) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Active" {{ old('status', $property->status) == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ old('status', $property->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="is_featured">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $property->is_featured) ? 'checked' : '' }}>
                    Featured
                </label>
            </div>
            <div class="form-group">
                <label class="form-label" for="is_new">
                    <input type="checkbox" name="is_new" id="is_new" value="1" {{ old('is_new', $property->is_new) ? 'checked' : '' }}>
                    New
                </label>
            </div>
            <div class="form-group">
                <label class="form-label" for="bedrooms">Bedrooms</label>
                <input type="number" name="bedrooms" id="bedrooms" class="form-control" value="{{ old('bedrooms', $property->bedrooms) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="bathrooms">Bathrooms</label>
                <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ old('bathrooms', $property->bathrooms) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="area">Area (sq ft or m<sup>2</sup>)</label>
                <input type="number" name="area" id="area" class="form-control" value="{{ old('area', $property->area) }}" step="0.01" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="image">Property Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                @if($property->image)
                    <img id="imagePreview" src="{{ asset('img/properties/' . $property->image) }}" alt="Current Image" style="max-width:150px;margin-top:10px;">
                @else
                    <img id="imagePreview" src="#" alt="Image Preview" style="display:none;max-width:150px;margin-top:10px;">
                @endif
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Property</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('image').addEventListener('change', function(e) {
    const [file] = this.files;
    if (file) {
        const preview = document.getElementById('imagePreview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});
</script>
@endpush
