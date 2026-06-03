<!DOCTYPE html>
<html class="light-style" dir="{{ trans('route.dir') }}" data-theme="theme-default"
    lang="{{ trans('route.thisLang') }}" data-assets-path="/admin/assets/"
    data-template="vertical-menu-template" data-textdirection="{{ trans('route.dir') }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? __('admin.admin_login_page') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ getSettingImageLink('logo_favicon') ?? asset('admin/assets/img/favicon/logo.png') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/flag-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/page-auth.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/custom/css/dashboard-ui.css') }}" />

    <script src="{{ asset('admin/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
</head>

<body>
    <div class="dash-auth-lang">
        <ul class="navbar-nav flex-row">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle hide-arrow d-flex align-items-center" href="javascript:void(0);"
                    data-bs-toggle="dropdown" aria-label="{{ __('admin.change_language') }}">
                    <i class="fi fi-{{ trans('route.langFlag') }} fis rounded-circle fs-4"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    @foreach(['en', 'ja', 'ar'] as $lang)
                        @if($lang !== app()->getLocale())
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('web.change.language', $lang) }}">
                                    <i class="fi fi-{{ getLanguageFlag($lang) }} fis me-2"></i>
                                    <span>{{ getLanguageName($lang) }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>

    <div class="authentication-wrapper authentication-basic">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <div class="app-brand justify-content-center mb-3">
                        <img src="{{ getSettingImageLink('logo', true) }}" alt="Logo" class="app-brand-logo demo">
                    </div>

                    <h4 class="mb-2 text-center">{{ trans('admin.WelcomeToAdminPanel!') }} 👋</h4>
                    <p class="mb-4 text-center">{{ trans('admin.PleaseSign-inToYourAccountAndStartTheAdventure') }}</p>

                    <form id="formAuthentication" class="mb-1 form-horizontal" action="{{ route('admin.login') }}" method="POST">
                        @csrf
                        @error('inValid')
                            <div class="alert alert-danger text-center mb-3">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ trans('admin.email') }}</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="{{ old('email') }}" placeholder="{{ __('admin.EnterYourEmail') }}" autofocus />
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ trans('admin.password') }}</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="{{ __('admin.EnterYourPassword') }}" />
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                                <label class="form-check-label" for="remember-me">{{ trans('admin.RememberMe') }}</label>
                            </div>
                        </div>

                        <button class="btn btn-primary d-grid w-100 submit_button" type="submit">
                            {{ trans('admin.Login') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>
    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 2000
        };

        $(document).ready(function() {
            $(document).on('submit', '.form-horizontal', function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    method: 'post',
                    data: new FormData($(this)[0]),
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(".submit_button").html('<i class="bx bx-loader-alt bx-spin"></i>').prop('disabled', true);
                    },
                    success: function(response) {
                        $(".text-danger").remove();
                        $('.form-horizontal input').removeClass('border-danger');
                        if (response.status == 'login') {
                            toastr.success(response.message);
                            setTimeout(function() {
                                window.location.replace(response.url);
                            }, 1000);
                        } else {
                            $(".submit_button").html("{{ __('admin.Login') }}").prop('disabled', false);
                            $('.form-horizontal input[name=password]').addClass('border-danger');
                            $('.form-horizontal input[name=password]').after(`<span class="text-danger small d-block mt-1">${response.message}</span>`);
                        }
                    },
                    error: function(xhr) {
                        $(".submit_button").html("{{ __('admin.Login') }}").prop('disabled', false);
                        $(".text-danger").remove();
                        $('.form-horizontal input').removeClass('border-danger');
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('.form-horizontal input[name=' + key + ']').addClass('border-danger');
                                $('.form-horizontal input[name=' + key + ']').after(`<span class="text-danger small d-block mt-1">${value}</span>`);
                            });
                        }
                    },
                });
            });
        });
    </script>
</body>
</html>
