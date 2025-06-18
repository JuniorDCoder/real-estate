@extends('layouts.auth')
@section('body-class', 'pages-admin-list-properties')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span class="breadcrumb-separator">/</span>
    <span>List Properties</span>
@endsection


@section('content')
<div class="card">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title">All Properties</h2>
        <a href="{{ route('properties.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Property
        </a>
    </div>
    <div class="table-responsive">
        <table class="table sortable-table">
            <thead>
                <tr>
                   <th>{!! sortablelink('title', 'Title', $sort, $direction) !!}</th>
                    <th>{!! sortablelink('city', 'City', $sort, $direction) !!}</th>
                    <th>{!! sortablelink('price', 'Price', $sort, $direction) !!}</th>
                    <th>{!! sortablelink('bedrooms', 'Beds', $sort, $direction) !!}</th>
                    <th>{!! sortablelink('bathrooms', 'Baths', $sort, $direction) !!}</th>
                    <th>{!! sortablelink('area', 'Area', $sort, $direction) !!}</th>
                    <th>{!! sortablelink('status', 'Status', $sort, $direction) !!}</th>
                    <th>{!! sortablelink('created_at', 'Created', $sort, $direction) !!}</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($properties as $property)
                <tr>
                    <td>{{ $property->title }}</td>
                    <td>{{ $property->city }}</td>
                    <td>${{ number_format($property->price, 2) }}</td>
                    <td>{{ $property->bedrooms }}</td>
                    <td>{{ $property->bathrooms }}</td>
                    <td>{{ $property->area }}</td>
                    <td>
                        <span class="badge badge-{{ $property->status == 'Active' ? 'success' : 'secondary' }}">
                            {{ $property->status }}
                        </span>
                    </td>
                    <td>{{ $property->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('property.show', $property->id) }}" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('properties.destroy', $property->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this property?');">
                            @csrf
                            @method('DELETE')
                            <!-- Delete Button -->
                            <button type="button"
                                class="btn btn-sm btn-danger delete-property-btn"
                                data-id="{{ $property->id }}"
                                data-title="{{ $property->title }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No properties found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $properties->appends(['sort' => $sort, 'direction' => $direction])->links() }}
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal" id="deletePropertyModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Property</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeDeleteModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deletePropertyTitle"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelDeleteBtn">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Simple sort links for table headers
document.querySelectorAll('.sortable-table th').forEach(function(th) {
    th.addEventListener('click', function() {
        const url = new URL(window.location.href);
        const sort = this.dataset.sort;
        if (!sort) return;
        let direction = url.searchParams.get('direction') === 'asc' ? 'desc' : 'asc';
        url.searchParams.set('sort', sort);
        url.searchParams.set('direction', direction);
        window.location = url.toString();
    });
});
</script>
@endpush

@php
// Helper for sortable links
@endphp
@once
    @push('scripts')
    <script>
    document.querySelectorAll('[data-sort]').forEach(function(th) {
        th.style.cursor = 'pointer';
    });
    </script>
    @endpush
@endonce

@php
function sortablelink($column, $label, $sort, $direction) {
    $isSorted = $sort === $column;
    $icon = $isSorted ? ($direction === 'asc' ? '↑' : '↓') : '';
    return '<span data-sort="'.$column.'">'.$label.' '.$icon.'</span>';
}
@endphp

