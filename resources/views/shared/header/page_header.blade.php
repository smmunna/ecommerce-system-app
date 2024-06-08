@php
    // Fetch the first settings record from the database
    $settings = App\Models\Setting::first();
@endphp
<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i>{{ $settings->phone }}</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i>{{ $settings->email }}</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i>{{ $settings->address }}</a></li>
            </ul>
            <ul class="header-links pull-right">
                <li><a href="#">{{ $settings->currency_symbol }} {{ $settings->currency }}</a></li>
                @auth
                    @if (auth()->user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-user-o"></i> My Account</a></li>
                    @elseif (auth()->user()->role === 'user')
                        <li><a href="{{ route('user.dashboard') }}"><i class="fa fa-user-o"></i> My Account</a></li>
                    @else
                        <!-- Optionally, handle unexpected roles here, or just show nothing -->
                    @endif
                @else
                    <li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i> Login</a></li>
                @endauth

            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="#" class="logo">
                            <img src="./img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form>
                            <select class="input-select">
                                <option value="0">All Categories</option>
                                <option value="1">Category 01</option>
                                <option value="1">Category 02</option>
                            </select>
                            <input class="input" placeholder="Search here">
                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>
                            <a href="#">
                                <i class="fa fa-heart-o"></i>
                                <span>Your Wishlist</span>
                                <div class="qty">2</div>
                            </a>
                        </div>
                        <!-- /Wishlist -->

                        <!-- Cart -->
                        @include('shared.header.cart_header')
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->
