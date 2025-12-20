<!DOCTYPE html>

<html class="light-style layout-navbar-fixed layout-menu-fixed" dir="{{trans('route.dir')}}" data-theme="theme-default"
    lang="{{trans('route.thisLang')}}"
    data-assets-path="/admin/assets/" data-template="vertical-menu-template" data-textdirection="{{trans('route.dir')}}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Self Labsite Admin Panel" />
    <meta name="keywords"
        content="admin, admin dashboard, admin panel, admin template, analytics, bootstrap, crm, dashboard, flat, flat design, responsive, rtl, web app, html, sass, css, frontend, minimal, modern, professional, retina, ui kit, web app, clean, admin template, flat, responsive, admin dashboard, web app, backend, premium, oms, bootstrap" />
    <meta name="author" content="Self Labsite" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? __('admin.admin_login_page')}}</title>

    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/img/favicon/logo.png') }}" />
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
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/page-auth.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/toastr/toastr.css') }}" />
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('admin/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
</head>

<div>
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Language Toggle -->
                <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                    <a class="nav-link hide-arrow d-flex align-items-center"
                        href="{{ route('web.change.language', trans('route.otherLang')) }}"
                        id="languageToggle"
                        title="{{ __('admin.change_language') }}"
                        aria-label="{{ __('admin.change_language') }}"
                        style="min-width: 40px; min-height: 40px;">
                        <i class="fi fi-{{ trans('route.langFlag') }} fis rounded-circle fs-3 toggleLang" style="display: inline-block;"></i>
                    </a>
                </li>
                <!--/ Language Toggle -->

            </ul>
        </div>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <img src="{{ getSettingImageLink('logo', true) }}" alt="Logo"
                                class="app-brand-logo demo"
                                style="width: 170px; height: auto; display: block; margin: 0 auto;">
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2 text-center">{{ trans('admin.WelcomeToAdminPanel!') }} 👋</h4>
                        <p class="mb-4 text-center">{{ trans('admin.PleaseSign-inToYourAccountAndStartTheAdventure') }}</p>
                        <form id="formAuthentication" class="mb-3 form-horizontal" action="{{ route('admin.login') }}" method="POST">
                            @csrf
                            @error('inValid')
                                <div class="alert alert-danger mt-1 text-center">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ trans('admin.email') }}</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="{{ __('admin.EnterYourEmail') }}" autofocus />
                                @error('email')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label for="password" class="form-label">{{ trans('admin.password') }}</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    value="{{ old('password') }}" placeholder="{{ __('admin.EnterYourPassword') }}" autofocus />
                                    {{-- <div class="alert alert-danger mt-1">{{ $message }}</div> --}}
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me">{{ trans('admin.RememberMe') }}</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100 submit_button" type="submit">{{ trans('admin.Login') }}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
</div>


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('admin/assets/vendor/libs/hammer/hammer.js') }}"></script>

<script src="{{ asset('admin/assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

<script src="{{ asset('admin/assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Notifications js function -->
<script src="{{ asset('admin/assets/js/notifications-helper.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/libs/toastr/toastr.js') }}"></script>
<!-- Vendors JS -->

<!-- Main JS -->
<script src="{{ asset('admin/assets/js/main.js') }}"></script>
 <script>
        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "showMethod": "slideDown",
            "hideMethod": "slideUp",
            timeOut: 2000
        };
        $(document).ready(function(){
            $(document).on('submit','.form-horizontal',function(e){
                e.preventDefault();
                var url = $(this).attr('action')
                $.ajax({
                    url: url,
                    method: 'post',
                    data: new FormData($(this)[0]),
                    dataType:'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $(".submit_button").html('<i class="fas fa-spinner"></i>').attr('disables',true);
                    },
                    success: function(response){
                        $(".text-danger").remove()
                        $('.form-horizontal input').removeClass('border-danger')
                        if (response.status == 'login'){
                            toastr.success(response.message)
                            setTimeout(function(){
                                window.location.replace(response.url)
                            }, 1000);
                        }else{
                            console.log(response.message)
                            $(".submit_button").html(`<i class="ft-unlock"></i> {{ __('admin.Login') }}`).attr('disable',false)
                            $('.form-horizontal input[name=password]').addClass('border-danger')
                            $('.form-horizontal input[name=password').after(`<span class="mt-5 text-danger">${response.message}</span>`);
                        }
                    },
                    error: function (xhr) {
                        $(".submit_button").html("{{ __('admin.Login')}}").attr('disable',false)
                        $(".text-danger").remove()
                        $('.form-horizontal input').removeClass('border-danger')

                        $.each(xhr.responseJSON.errors, function(key,value) {
                            $('.form-horizontal input[name='+key+']').addClass('border-danger')
                            $('.form-horizontal input[name='+key+']').after(`<span class="mt-5 text-danger">${value}</span>`);
                        });
                    },
                });

            });
        });
    </script>
</body>

</html>
