<!-- resources/views/layouts/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Include CSS stylesheets or other meta tags -->
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href={{ asset('/template_files/css/bootstrap.min.css') }} />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href={{ asset('/template_files/css/slick.css') }} />
    <link type="text/css" rel="stylesheet" href={{ asset('/template_files/css/slick-theme.css') }} />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href={{ asset('/template_files/css/nouislider.min.css') }} />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href={{ asset('/template_files/css/font-awesome.min.css') }}>

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href={{ asset('/template_files/css/style.css') }} />

    @stack('styles')
</head>

<body>
    <header>
        <!-- Header content goes here -->
        @include('shared.header.page_header')
        @include('shared.navbar.page_navbar')
    </header>

    <main>
        {{-- Success/Error Message after adding to cart --}}
        <div class="text-center">
            <div>
                @if (session('success'))
                    <div id="success" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('failure'))
                    <div id="failure" class="alert alert-danger">
                        {{ session('failure') }}
                    </div>
                @endif
            </div>
        </div>
        <!-- Main content goes here -->
        @yield('content')
        <!-- News Letter -->
        @include('shared.newsletter.news_letter')
    </main>

    <footer>
        <!-- Footer content goes here -->
        @include('shared.footer.page_footer')
    </footer>

    <!-- Include JavaScript files or other scripts -->
    <!-- jQuery Plugins -->
    <script src={{ asset('/template_files/js/jquery.min.js') }}></script>
    <script src={{ asset('/template_files/js/bootstrap.min.js') }}></script>
    <script src={{ asset('/template_files/js/slick.min.js') }}></script>
    <script src={{ asset('/template_files/js/nouislider.min.js') }}></script>
    <script src={{ asset('/template_files/js/jquery.zoom.min.js') }}></script>
    <script src={{ asset('/template_files/js/main.js') }}></script>
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
