@extends('layouts.auth')
@section('body-class', 'pages-admin-list-properties')
@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="breadcrumb-separator">/</span>
    <span>Create Property</span>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Create New Property</h2>
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

        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" id="createPropertyForm">
            @csrf
            <div class="form-group">
                <label class="form-label" for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="city">City</label>
                <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" step="0.01" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="property_type">Property Type</label>
                <select name="property_type" id="property_type" class="form-control" required>
                    <option value="House" {{ old('property_type') == 'House' ? 'selected' : '' }}>House</option>
                    <option value="Apartment" {{ old('property_type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                    <option value="Commercial" {{ old('property_type') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="building_type">Building Type</label>
                <input type="text" name="building_type" id="building_type" class="form-control" value="{{ old('building_type') }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="is_featured">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', 1) ? 'checked' : '' }}>
                    Featured
                </label>
            </div>
            <div class="form-group">
                <label class="form-label" for="is_new">
                    <input type="checkbox" name="is_new" id="is_new" value="1" {{ old('is_new', 1) ? 'checked' : '' }}>
                    New
                </label>
            </div>
            <div class="form-group">
                <label class="form-label" for="bedrooms">Bedrooms</label>
                <input type="number" name="bedrooms" id="bedrooms" class="form-control" value="{{ old('bedrooms') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="bathrooms">Bathrooms</label>
                <input type="number" name="bathrooms" id="bathrooms" class="form-control" value="{{ old('bathrooms') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="area">Area (sq ft or m<sup>2</sup>)</label>
                <input type="number" name="area" id="area" class="form-control" value="{{ old('area') }}" step="0.01" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="image">Property Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                <img id="imagePreview" src="#" alt="Image Preview" style="display:none;max-width:150px;margin-top:10px;">
            </div>
            <button type="submit" class="btn btn-primary w-100">Create Property</button>
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
