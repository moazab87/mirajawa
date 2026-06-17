<!DOCTYPE html>

<html class="light-style layout-navbar-fixed layout-menu-fixed" dir="{{ trans('route.dir') }}" data-theme="theme-default"
    lang="{{ trans('route.thisLang') }}" data-assets-path="/admin/assets/" data-template="vertical-menu-template"
    data-textdirection="{{ trans('route.dir') }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ getSettingImageLink('logo_favicon') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/select2/select2.css') }}" />
    <!-- Page CSS -->

    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/custom/css/myStyle.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/custom/css/dashboard-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/custom/css/rich-editor.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/custom/css/fileinput.min.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('/admin/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    {{-- <script src="{{ asset('admin/assets/vendor/js/template-customizer.js') }}"></script> --}}
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>

    <x-admin.uploadImage.css />
    @yield('css-vendor')
    @yield('css')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('admin.layouts.partials.menu')

            <div class="layout-page">
                <!-- Navbar -->
                @include('admin.layouts.partials.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @yield('content')
                    <!-- / Content -->

                    @include('admin.layouts.partials.footer')

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/admin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('/admin/assets/vendor/libs/hammer/hammer.js') }}"></script>

    <script src="{{ asset('/admin/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('/admin/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('/admin/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Notifications js function -->
    <script src="{{ asset('admin/assets/js/notifications-helper.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('admin/assets/vendor/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/scripts/forms/select/forms-selects.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    {{-- <script src="{{asset('admin/assets/vendor/libs/select2/select2.js')}}"></script> --}}
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages-account-settings-account.js') }}"></script>

    <script src="{{ asset('admin/assets/js/forms-extras.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/toastr/toastr.js') }}"></script>

    <script src="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

    <!-- purify.min.js is only needed if you wish to purify HTML content in your preview for HTML files.
     This must be loaded before fileinput.min.js -->
    <script src="{{ asset('admin/assets/js/scripts/files/purify.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/js/scripts/files/fileinput.js') }}"></script>

    @include('admin.shared.deleteOne')

    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if (session('failed'))
        <script>
            toastr.error("{{ session('failed') }}");
        </script>
    @endif

    @if (session()->has('Lang'))
        {{ app()->setLocale(session('Lang')) }}
    @endif
    <x-admin.uploadImage.script />

    <script src="https://cdn.jsdelivr.net/npm/tinymce@7.5.1/tinymce.min.js"></script>
    <script src="{{ asset('admin/custom/js/rich-editor.js') }}"></script>

    @yield('script')

</body>

</html>
