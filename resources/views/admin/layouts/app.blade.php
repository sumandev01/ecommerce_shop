<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NobleUI Responsive Bootstrap 4 Dashboard Template</title>
    <!-- Bootstrap -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/core/core.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    {{-- <link rel="stylesheet" href="{{ asset('admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}"> --}}
    <!-- end plugin css for this page -->
    <!-- endinject -->
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.css') }}" />
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" />
    <!-- Select2 css -->
    <link href="{{ asset('admin/assets/css/select2.min.css') }}" rel="stylesheet">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">
    <!-- summer note css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">

    @stack('style')
</head>

<body>
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        @include('admin.layouts.partials.sidebar')
        <nav class="settings-sidebar">
            <div class="sidebar-body">
                <a href="#" class="settings-sidebar-toggler">
                    <i data-feather="settings"></i>
                </a>
                <h6 class="text-muted">Sidebar:</h6>
                <div class="form-group border-bottom">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                                value="sidebar-light" checked>
                            Light
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                                value="sidebar-dark">
                            Dark
                        </label>
                    </div>
                </div>
                <div class="theme-wrapper">
                    <h6 class="mb-2 text-muted">Light Theme:</h6>
                    <a class="theme-item active" href="../demo_1/dashboard-one.html">
                        <img src="../assets/images/screenshots/light.jpg" alt="light theme">
                    </a>
                    <h6 class="mb-2 text-muted">Dark Theme:</h6>
                    <a class="theme-item" href="../demo_2/dashboard-one.html">
                        <img src="../assets/images/screenshots/dark.jpg" alt="light theme">
                    </a>
                </div>
            </div>
        </nav>
        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            @include('admin.layouts.partials.header')
            <!-- partial -->
            <div class="page-content">
                @yield('content')
            </div>

            <!-- partial:partials/_footer.html -->
            @include('admin.layouts.partials.footer')
            <!-- partial -->

        </div>
    </div>
    {{-- Delete Form --}}
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    {{-- Bootstrap --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script> --}}
    <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>

    <!-- core:js -->
    <script src="{{ asset('admin/assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    {{-- <script src="{{ asset('admin/assets/vendors/chartjs/Chart.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/assets/vendors/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/progressbar.js/progressbar.min.js') }}"></script> --}}
    <!-- end plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- sweetalert2 -->
    <script src="{{ asset('admin/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- DataTables JS -->
    <script src="{{ asset('admin/assets/js/dataTables.js') }}"></script>
    <!-- custom js for this page -->
    <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
    {{-- <script src="{{ asset('admin/assets/js/datepicker.js') }}"></script> --}}
    <!-- Select2 JS -->
    <script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>
    <!-- lucide icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <!-- summer note editor -->
    <script src="{{ asset('admin/assets/js/summernote.min.js') }}"></script>
    <!-- end custom js for this page -->

    @stack('script')
    <script>
        $.fn.dataTable.ext.errMode = 'throw';
        document.addEventListener('DOMContentLoaded', function() {
            $('.deleteConfirm').on('click', function(e) {
                e.preventDefault();
                const href = $(this).attr('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deleteForm').attr('action', href).submit();
                    }
                })
            });
        });
    </script>
    <script>
        lucide.createIcons();
    </script>

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

</body>

</html>
