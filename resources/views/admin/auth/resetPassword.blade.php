<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="{{ trans('common.thisLang') }}" data-layout="semi-dark-layout">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content=".">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="PIXINVENT">
    <title>{{ $title }}</title>
    <link rel="apple-touch-icon" href="{{ asset('/AdminAssets/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ getSettingImageLink('logo') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/AdminAssets/app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/AdminAssets/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/AdminAssets/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/AdminAssets/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/AdminAssets/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/AdminAssets/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/AdminAssets/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/AdminAssets/app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/AdminAssets/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/AdminAssets/app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/AdminAssets/app-assets/css/pages/authentication.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/AdminAssets/app-assets/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/AdminAssets/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click"
    data-menu="vertical-menu-modern" data-col="blank-page" data-layout="semi-dark-layout">

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-basic px-2">
                    <div class="auth-inner my-2">
                        <!-- Login basic -->
                        <div class="card mb-0">
                            <div class="card">
                                <div class="card-body">
                                    <div class="app-brand justify-content-center mb-4 mt-2">
                                        <span class="app-brand-logo demo">
                                            <a href="#" class="brand-logo">
                                                <img src="{{ getSettingImageLink('logo') }}" width="90%"
                                                    style="object-fit: cover;" />
                                            </a>
                                        </span>
                                    </div>
                                    <h4 class="card-title" style="text-align: center; margin-bottom: 1rem;">
                                        {{ $title }}
                                    </h4>
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show d-flex
                                        align-items-center"
                                            role="alert">
                                            <i data-feather="alert-octagon" class="me-50"></i>
                                            <span>{{ session('error') }}</span>
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form class="auth-login-form mt-2" action="{{ route('reset-password') }}"
                                        method="POST">
                                        @csrf
                                        <div class="mb-1">
                                            <label for="login-email"
                                                class="form-label">{{ trans('common.email') }}</label>
                                            <input type="text"
                                                class="form-control
                                        @error('email') is-invalid @enderror"
                                                id="login-email" name="email" placeholder="john@example.com"
                                                aria-describedby="login-email" tabindex="1" autofocus />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-1">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label"
                                                    for="login-password">{{ trans('common.password') }}</label>
                                            </div>
                                            <div class="input-group input-group-merge form-password-toggle">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="login-password" name="password" tabindex="2"
                                                    aria-describedby="login-password" placeholder="Enter Password"
                                                    required />
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-1">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label"
                                                    for="password_confirmation">{{ trans('common.password_confirmation') }}</label>
                                            </div>
                                            <div
                                                class="input-group input-group-merge form-password_confirmation-toggle">
                                                <input type="password"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    id="password_confirmation" name="password_confirmation"
                                                    tabindex="2" aria-describedby="password_confirmation"
                                                    placeholder="Enter Password" required />
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <button class="btn btn-primary w-100"
                                            tabindex="4">{{ trans('common.resetPassword') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Login basic -->
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- END: Content-->
</body>
<!-- END: Body-->

</html>
