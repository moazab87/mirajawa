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
                            <a class="nav-link" href="{{ route('admin.profile.edit') }}">
                                <i class="ti-xs ti ti-users me-1"></i>
                                {{ __('admin.profile') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.password.edit') }}">
                                <i class="ti-xs ti ti-lock me-1"></i>
                                {{ __('admin.change_password') }}
                            </a>
                        </li>
                    </ul>
                    <div class="card mb-4">
                        <h5 class="card-header">@lang('admin.editPassword')</h5>
                        <!-- Account -->
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.password.update') }}"
                            enctype="multipart/form-data" class="fv-plugins-bootstrap5 fv-plugins-framework"
                            novalidate="novalidate">
                            @csrf

                            <div class="card-body">
                                <div class="row mb-4">
                                    @include('admin.layouts.partials.alerts')
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label" for="password">{{ trans('admin.password') }}</label>
                                        {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'required']) }}
                                        @if ($errors->has('password'))
                                            <span class="text-danger" role="alert">
                                                <b>{{ $errors->first('password') }}</b>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label"
                                            for="passwordConfirmation">{{ trans('admin.passwordConfirmation') }}</label>
                                        {{ Form::password('password_confirmation', ['id' => 'passwordConfirmation', 'class' => 'form-control', 'required']) }}
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">
                                        {{ __('admin.Save changes') }}
                                    </button>
                                    <a href="{{ route('admin.admin.index') }}" class="btn btn-label-secondary waves-effect">
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
