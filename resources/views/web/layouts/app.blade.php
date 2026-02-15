<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="wpOceans">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('web/assets/images/favicon.png') }}">
    <title>Themart - eCommerce HTML5 Template</title>
    <link href="{{ asset('web/assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/flaticon_ecommerce.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/owl.transitions.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/odometer-theme-default.css') }}" rel="stylesheet">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link href="{{ asset('web/assets/sass/style.css') }}" rel="stylesheet">
    @stack('style')
</head>

<body>
    <!-- start page-wrapper -->
    <div class="page-wrapper">
        <!-- start preloader -->
        <div class="preloader">
            <div class="vertical-centered-box">
                <div class="content">
                    <div class="loader-circle"></div>
                    <div class="loader-line-mask">
                        <div class="loader-line"></div>
                    </div>
                    <img src="{{ asset('web/assets/images/preloader.png') }}" alt="">
                </div>
            </div>
        </div>
        <!-- end preloader -->

        <!-- start header -->
        @include('web.layouts.partials.header')
        <!-- end of header -->
        <!-- start content -->
        @yield('content')
        <!-- end content -->
        <!-- start of wpo-site-footer-section -->
        @include('web.layouts.partials.footer')
        <!-- end of wpo-site-footer-section -->

    </div>
    <!-- end of page-wrapper -->

    <!-- All JavaScript files
    ================================================== -->
    <script src="{{ asset('web/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Plugins for this template -->
    <script src="{{ asset('web/assets/js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery.dlmenu.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery-plugin-collection.js') }}"></script>
    <!-- Custom script for this template -->
    <script src="{{ asset('web/assets/js/script.js') }}"></script>
    <!-- sweetalert2 -->
    <script src="{{ asset('admin/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        // GLOBAL TOAST FUNCTION
        function showToast(type, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: type,
                title: message
            });
        }
    </script>
    @if (session('success'))
        <script>
            showToast('success', "{{ session('success') }}");
        </script>
    @endif

    @if (session('error'))
        <script>
            showToast('error', "{{ session('error') }}");
        </script>
    @endif
    @stack('script')
</body>

</html>
