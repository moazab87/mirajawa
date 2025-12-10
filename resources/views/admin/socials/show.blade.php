@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('admin.show')],
        ]" />

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $model->name }}</h5>
                        <div>
                            <a href="{{ route('admin.socials.edit', $model->id) }}" class="btn btn-primary">
                                <i class="bx bx-edit-alt me-1"></i> {{ __('admin.edit') }}
                            </a>
                            <a href="{{ $route }}" class="btn btn-outline-secondary">
                                <i class="bx bx-arrow-back me-1"></i> {{ __('admin.back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">{{ __('admin.basic_information') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <strong>{{ __('admin.name') }}:</strong> {{ $model->name }}
                                        </div>
                                        <div class="mb-3">
                                            <strong>{{ __('admin.url') }}:</strong> 
                                            <a href="{{ $model->url }}" target="_blank" class="text-primary">
                                                <i class="bx bx-link-external"></i> {{ $model->url }}
                                            </a>
                                        </div>
                                        @if($model->icon)
                                            <div class="mb-3">
                                                <strong>{{ __('admin.icon') }}:</strong> 
                                                <i class="{{ $model->icon }}" style="font-size: 1.5rem;"></i>
                                                <small class="d-block text-muted">{{ $model->icon }}</small>
                                            </div>
                                        @endif
                                        <div class="mb-3">
                                            <strong>{{ __('admin.status') }}:</strong> 
                                            <span class="badge bg-{{ $model->is_active ? 'success' : 'secondary' }}">
                                                {{ $model->is_active ? __('admin.active') : __('admin.inactive') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

