 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         <img src={{ asset('/dashboard_files/dist/img/AdminLTELogo.png') }} alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">E-Shop</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src={{ asset(auth()->user()->photo) }} class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="{{ route('profile') }}" class="d-block">{{ auth()->user()->name }}</a>
             </div>
         </div>

         @if (auth()->user()->role == 'admin')
             <!-- Sidebar Menu -->
             <nav class="mt-2">
                 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
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
                         <a href="pages/widgets.html" class="nav-link">
                             <i class="nav-icon fas fa-th"></i>
                             <p>
                                 Widgets
                                 <span class="right badge badge-danger">New</span>
                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-book"></i>
                             <p>
                                 Pages
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="pages/examples/invoice.html" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Invoice</p>
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
             <!-- /.sidebar-menu -->
         @endif


         @if (auth()->user()->role == 'user')
             <!-- Sidebar Menu -->
             <nav class="mt-2">
                 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                     <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                     <li class="nav-item menu-open">
                         <a href="{{ route('user.dashboard') }}" class="nav-link active">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Dashboard
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="pages/widgets.html" class="nav-link">
                             <i class="nav-icon fas fa-th"></i>
                             <p>
                                 Widgets
                                 <span class="right badge badge-danger">New</span>
                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-book"></i>
                             <p>
                                 Pages
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="pages/examples/invoice.html" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Invoice</p>
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
             <!-- /.sidebar-menu -->
         @endif
     </div>
     <!-- /.sidebar -->
 </aside>
