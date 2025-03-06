<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', '')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css" rel="stylesheet">

    {{-- <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet"> --}}

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    @include('admin.frontend.header')
    @include('admin.frontend.sidebar')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>@yield('page-title')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    @if (request()->is('admin/beranda-klien') ||
                            request()->is('admin/domain-klien') ||
                            request()->is('admin/artikel-klien') ||
                            request()->is('admin/tentang-klien'))
                        <li class="breadcrumb-item">Clients Content</li>
                        @if (request()->is('admin/beranda-klien'))
                            <li class="breadcrumb-item active">Beranda</li>
                        @elseif (request()->is('admin/domain-klien'))
                            <li class="breadcrumb-item active">Domain SPBE</li>
                        @elseif (request()->is('admin/artikel-klien'))
                            <li class="breadcrumb-item active">Artikel SPBE</li>
                        @elseif (request()->is('admin/tentang-klien'))
                            <li class="breadcrumb-item active">Tentang SPBE</li>
                        @endif
                    @else
                        <li class="breadcrumb-item active">@yield('breadcrumb-active')</li>
                    @endif
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @yield('content-section')
        @yield('additional-script')
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- data table --}}
    <script>
        $(document).ready(function() {
            $('#datatable1').DataTable(); // Inisialisasi jQuery DataTables
        });
    </script>
    <script></script>
</body>

</html>
