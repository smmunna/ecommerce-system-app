<!-- Admin Sidebar-->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('products.index') }}" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                    Products
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.users') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Users
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.orders') }}" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                    Orders
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.reviews.index') }}" class="nav-link">
                <i class="nav-icon fas fa-comments"></i>
                <p>
                    Reviews
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('orders.reports') }}" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Reports
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Basic Rules
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="fas fa-angle-right nav-icon"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.size') }}" class="nav-link">
                        <i class="fas fa-angle-right nav-icon"></i>
                        <p>Size</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('brands.index') }}" class="nav-link">
                        <i class="fas fa-angle-right nav-icon"></i>
                        <p>Brands</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cupons.index') }}" class="nav-link">
                        <i class="fas fa-angle-right nav-icon"></i>
                        <p>Cupons</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('settings') }}" class="nav-link">
                        <i class="fas fa-angle-right nav-icon"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p>Logout</p>
            </a>
        </li>

    </ul>
</nav>
