<!-- resources/views/layouts/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Include CSS stylesheets or other meta tags -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ asset('/dashboard_files/plugins/fontawesome-free/css/all.min.css') }}>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href={{ asset('/dashboard_files/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}>
    <!-- iCheck -->
    <link rel="stylesheet" href={{ asset('/dashboard_files/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}>
    <!-- JQVMap -->
    <link rel="stylesheet" href={{ asset('/dashboard_files/plugins/jqvmap/jqvmap.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset('/dashboard_files/dist/css/adminlte.min.css') }}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{ asset('/dashboard_files/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}>
    <!-- Daterange picker -->
    <link rel="stylesheet" href={{ asset('/dashboard_files/plugins/daterangepicker/daterangepicker.css') }}>
    <!-- Add Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src={{ asset('/dashboard_files/dist/img/AdminLTELogo.png') }}
                alt="AdminLTELogo" height="60" width="60">
        </div> --}}
        <header>
            <!-- Header content goes here -->
            @include('shared.dashboard.navbar.navbar')
            @include('shared.dashboard.sidebar.sidebar')
        </header>

        <main>
            <!-- Main content goes here -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
            </div>
        </main>

        <footer>
            <!-- Footer content goes here -->
            @include('shared.dashboard.footer.footer')
        </footer>
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    <!-- Include JavaScript files or other scripts -->
    <!-- jQuery -->
    <script src={{ asset('/dashboard_files/plugins/jquery/jquery.min.js') }}></script>
    <!-- jQuery UI 1.11.4 -->
    <script src={{ asset('/dashboard_files/plugins/jquery-ui/jquery-ui.min.js') }}></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src={{ asset('/dashboard_files/plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <!-- ChartJS -->
    <script src={{ asset('/dashboard_files/plugins/chart.js/Chart.min.js') }}></script>
    <!-- Sparkline -->
    <script src={{ asset('/dashboard_files/plugins/sparklines/sparkline.js') }}></script>
    <!-- JQVMap -->
    <script src={{ asset('/dashboard_files/plugins/jqvmap/jquery.vmap.min.js') }}></script>
    <script src={{ asset('/dashboard_files/plugins/jqvmap/maps/jquery.vmap.usa.js') }}></script>
    <!-- jQuery Knob Chart -->
    <script src={{ asset('/dashboard_files/plugins/jquery-knob/jquery.knob.min.js') }}></script>
    <!-- daterangepicker -->
    <script src={{ asset('/dashboard_files/plugins/moment/moment.min.js') }}></script>
    <script src={{ asset('/dashboard_files/plugins/daterangepicker/daterangepicker.js') }}></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src={{ asset('/dashboard_files/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}>
    </script>
    <!-- Summernote -->
    <!-- Add Summernote JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <!-- Initialize Summernote -->
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
    <!-- overlayScrollbars -->
    <script src={{ asset('/dashboard_files/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}></script>
    <!-- AdminLTE App -->
    <script src={{ asset('/dashboard_files/dist/js/adminlte.js') }}></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src={{ asset('/dashboard_files/dist/js/demo.js') }}></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src={{ asset('/dashboard_files/dist/js/pages/dashboard.js') }}></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Check if the success message element exists
            var successMessage = document.getElementById("success");
            if (successMessage) {
                // Remove the success message after 3 seconds
                setTimeout(function() {
                    successMessage.remove();
                }, 3000);
            }

            // Check if the failure message element exists
            var failureMessage = document.getElementById("failure");
            if (failureMessage) {
                // Remove the failure message after 3 seconds
                setTimeout(function() {
                    failureMessage.remove();
                }, 3000);
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
