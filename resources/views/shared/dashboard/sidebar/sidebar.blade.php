@php
    // Fetch the first settings record from the database
    $settings = App\Models\Setting::first();
@endphp

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src={{ asset($settings->logo) }} alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $settings->title }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src={{ asset(auth()->user()->photo) }} class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('admin.profile') }}" class="d-block">{{ auth()->user()->name }}</a>
                @else
                    <a href="{{ route('user.profile') }}" class="d-block">{{ auth()->user()->name }}</a>
                @endif
            </div>
        </div>

        <!-- Admin Sidebar Menu -->
        @if (auth()->user()->role == 'admin')
            @include('shared.dashboard.sidebar.admin_sidebar')
        @endif
        <!-- /.sidebar-menu -->


        <!-- User Sidebar Menu -->
        @if (auth()->user()->role == 'user')
            @include('shared.dashboard.sidebar.user_sidebar')
        @endif
        <!-- /. user sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
