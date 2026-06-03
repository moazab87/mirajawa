@extends('admin.layouts.app')

@section('title', $title)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
            ['url' => route('admin.settings.index'), 'text' => __('dashboard.settings.index')],
        ]" />

        <div class="row" id="table-bordered">
            <div class="col-12">
                {{ Form::open(['url' => route('admin.settings.update'), 'files' => 'true']) }}
                <div class="card dash-card">
                    <div class="card-header border-bottom">
                        <h5 class="dash-page-title mb-1">{{ __('dashboard.settings.index') }}</h5>
                        <p class="dash-text-muted mb-0 small">@lang('dashboard.manage_all_system_settings')</p>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#general">@lang('dashboard.settings.general')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#website">@lang('dashboard.settings.website')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#images">@lang('dashboard.settings.images')</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3">
                            <div class="tab-pane active" id="general">
                                @include('admin.settings.includes.general')
                            </div>
                            <div class="tab-pane" id="website">
                                @include('admin.settings.includes.website')
                            </div>
                            <div class="tab-pane" id="images">
                                @include('admin.settings.includes.images')
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save"></i>
                            {{ __('dashboard.save') }}
                        </button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
