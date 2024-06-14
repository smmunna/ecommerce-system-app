 <!--User Sidebar Menu -->
 <nav class="mt-2">
     <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
             <a href="{{ route('logout') }}" class="nav-link">
                 <i class="nav-icon far fa-circle text-warning"></i>
                 <p>Logout</p>
             </a>
         </li>

     </ul>
 </nav>
 <!-- /.sidebar-menu -->
