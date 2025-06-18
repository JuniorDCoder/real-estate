@extends('layouts.auth')
@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
@endsection

@section('content')
<div class="dashboard-content">
    <h1>Admin Dashboard</h1>
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-home"></i></div>
            <div class="stat-info">
                <h3>{{ $totalProperties }}</h3>
                <p>Total Properties</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <h3>{{ $activeProperties }}</h3>
                <p>Active Properties</p>
            </div>
        </div>
        @if($latestProperty)
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <h3>{{ $latestProperty->title }}</h3>
                <p>Latest Property Added</p>
            </div>
        </div>
        @endif
    </div>
    <a href="{{ route('properties.create') }}" class="btn btn-primary" style="margin-top: 20px;">
            <i class="fas fa-plus"></i> Create New Property
        </a>
</div>
@endsection

@section('scripts')
    <script>
        // Additional page-specific scripts can go here
    </script>
@endsection
