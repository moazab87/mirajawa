@extends('admin.layouts.app')

@section('title', $title)


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Breadcrumb -->
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => route('admin.settings.index'), 'text' => $title],
        ]" />

        <!-- Settings Form -->
        <div class="row" id="table-bordered">
            <div class="col-12">
                {{ Form::open(['url' => route('admin.settings.update'), 'files' => 'true']) }}
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ $title }}</h5>
                        <p class="text-muted mb-0">
                            @lang('admin.manage_all_system_settings')
                        </p>
                    </div>
                    <div class="card-body">
                        <!-- Settings Tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general"
                                    aria-controls="home" role="tab" aria-selected="true">
                                    <i class="fas fa-cogs"></i> {{ trans('admin.generalSettings') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="images-tab" data-bs-toggle="tab" href="#images"
                                    aria-controls="images" role="tab" aria-selected="false">
                                    <i class="fas fa-image"></i> {{ trans('admin.imagesSettings') }}
                                </a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content mt-3">
                            <div class="tab-pane active" id="general" aria-labelledby="general-tab" role="tabpanel">
                                @include('admin.settings.includes.general')
                            </div>
                            <div class="tab-pane" id="images" aria-labelledby="images-tab" role="tabpanel">
                                @include('admin.settings.includes.images')
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> {{ trans('admin.Save changes') }}
                        </button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

