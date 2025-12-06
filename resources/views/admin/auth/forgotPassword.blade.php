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
    <link rel="stylesheet" type="text/css" href="{{ asset('/AdminAssets/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/AdminAssets/app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/AdminAssets/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/AdminAssets/app-assets/css/plugins/forms/form-validation.css') }}">
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
                                    <!-- /Logo -->
                                    <p class="mb-4">
                                        We sent a verification code to your email. Enter the code from your mail in the
                                        field below.
                                        <span class="fw-bold d-block mt-2">
                                            <i data-feather="mail" class="me-25"></i>
                                            <span class="text-dark">
                                                {{ substr($email, 0, 4) }}
                                                @for($i = 0; $i < strlen(substr($email, 4, strpos($email, '@') - 4)); $i++)
                                                    *
                                                @endfor
                                                @ {{ substr($email, strpos($email, '@') + 1) }}
                                            </span>
                                    </p>
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show d-flex
                                        align-items-center" role="alert">
                                            <i data-feather="alert-octagon" class="me-50"></i>
                                            <span>{{ session('error') }}</span>
                                        </div>
                                    @endif
                                    <p class="mb-0 fw-semibold">Type your 4 digit security code</p>
                                    <form id="twoStepsForm" action="{{ route('forgot-password') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <div class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper">
                                                @for ($i = 1; $i <= 4; $i++)
                                                    <input type="text"
                                                        class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                                                        maxlength="1" name="digit_{{ $i }}"
                                                        {{ $i == 1 ? 'autofocus' : '' }}
                                                            required/>
                                                @endfor
                                            </div>
                                            <button class="btn btn-primary d-grid w-100 mb-2">
                                                Verify
                                            </button>
                                            <a href="{{ route('admin.login') }}" class="btn btn-outline-primary d-grid w-100 mb-1">
                                                Back
                                            </a>
                                            <div class="text-center">
                                                Didn't get the code?
                                                <a href="{{route('forgot-password')}}"> Resend </a>
                                            </div>
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
