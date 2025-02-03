<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', '')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
        
    <!-- Vendor CSS Files -->
    <link href="{{ asset('clients/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('clients/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('clients/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('clients/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('clients/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('clients/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('clients/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    @yield('additional-style')

    <!-- Template Main CSS File -->
    <link href="{{ asset('clients/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    @include('clients.layouts.header')
    @yield('content-body')
    @include('clients.layouts.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('clients/assets/vendor/aos/aos.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('clients/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('clients/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('clients/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('clients/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('clients/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('clients/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('clients/assets/vendor/chart.js/chart.umd.js') }}"></script>

    @yield('additional-scripts')

    <!-- Template Main JS File -->
    <script src="{{ asset('clients/assets/js/main.js') }}"></script>
</body>

</html>
