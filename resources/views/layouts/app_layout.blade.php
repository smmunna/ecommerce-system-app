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
    @stack('scripts')
</body>

</html>
