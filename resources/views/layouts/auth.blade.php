<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }} - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-dashboard @yield('body-class')">
    <div class="dashboard-container">
        <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
        </button>
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1 class="logo">{{ env('APP_NAME') }}</h1>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li class="nav-item  {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.properties.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.properties.index') }}">
                            <i class="fas fa-home"></i>
                            <span>Properties</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>
         <!-- Overlay for mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="dashboard-header">
                <div class="header-left">
                    <div class="breadcrumbs">
                        @yield('breadcrumbs')
                    </div>
                </div>
                <div class="header-right">
                    <div class="user-profile">
                        <div class="profile-info">
                            <span class="user-name">{{ Auth::user()->name }}</span>

                        </div>
                        <div class="profile-image">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4f46e5&color=fff" alt="Profile">
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="content-wrapper">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
    @yield('scripts')
</body>
</html>
