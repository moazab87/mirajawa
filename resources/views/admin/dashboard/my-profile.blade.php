@extends('admin.layouts.app')
@section('title', $title)

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ $title }}/</span>
                {{ __('admin.settings') }}</h4>
            <div class="row fv-plugins-icon-container">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0);">
                                <i class="ti-xs ti ti-users me-1"></i>
                                {{ __('admin.profile') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.password.edit') }}">
                            <i class="ti-xs ti ti-lock me-1"></i>
                                {{ __('admin.change_password') }}
                            </a>
                        </li>
                    </ul>
                    <div class="card mb-4">
                        <h5 class="card-header">@lang('admin.ProfileDetails')</h5>
                        <!-- Account -->
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.profile.update') }}"
                            enctype="multipart/form-data" class="fv-plugins-bootstrap5 fv-plugins-framework"
                            novalidate="novalidate">
                            @csrf
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ auth('admin')->user()->image }}" alt="user-avatar"
                                        class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3 waves-effect waves-light">
                                            <span class="d-none d-sm-block">@lang('admin.UploadNewPhoto')</span>
                                            <i class="ti ti-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" class="account-file-input" hidden=""
                                                name="image" accept="image/png, image/jpeg">
                                        </label>
                                        <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6 fv-plugins-icon-container">
                                        <label for="name" class="form-label">@lang('admin.name')</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            value="{{ auth('admin')->user()->name }}" placeholder="John" autofocus="">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">@lang('admin.email')</label>
                                        <input class="form-control" type="text" id="email" name="email"
                                            value="{{ auth('admin')->user()->email }}"
                                            placeholder="{{ __('admin.email') }}">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phone">@lang('admin.phone')</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                value="{{ auth('admin')->user()->phone }}" placeholder="5xxxxxxxx">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">
                                        {{ __('admin.Save changes') }}
                                    </button>
                                    <a href="{{ route('admin.admin.index') }}"
                                     class="btn btn-label-secondary waves-effect">
                                        {{ __('admin.cancel') }}
                                    </a>
                                </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    </div>
@endsection
