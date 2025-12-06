<!-- show.blade.php -->
@extends('admin.layouts.app')
@section('title', $title)
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
                            <a href="{{ route('admin.projects.edit', $model->id) }}" class="btn btn-primary">
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
                                            <strong>{{ __('admin.name') }}:</strong> {{ $model->name ?? '-' }}
                                        </div>

                                        <div class="mb-3">
                                            <strong>{{ __('admin.team') }}:</strong>
                                            {{ optional($model->team)->name ?? '-' }}
                                        </div>

                                        <div class="mb-3">
                                            <strong>{{ __('admin.client') }}:</strong>
                                            {{ optional($model->client)->name ?? '-' }}
                                        </div>

                                        <div class="mb-3">
                                            <strong>{{ __('admin.status') }}:</strong>
                                            <x-badge :color="$model->status->color()">
                                                {{ $model->status->label() }}
                                            </x-badge>
                                        </div>

                                        <div class="mb-3">
                                            <strong>{{ __('admin.start_date') }}:</strong>
                                            {{ $model->start_date ? $model->start_date->format('Y-m-d') : '-' }}
                                        </div>

                                        <div class="mb-3">
                                            <strong>{{ __('admin.end_date') }}:</strong>
                                            {{ $model->end_date ? $model->end_date->format('Y-m-d') : '-' }}
                                        </div>

                                        <div class="mb-3">
                                            <strong>{{ __('admin.created_by') }}:</strong>
                                            {{ optional($model->creator)->name ?? '-' }}
                                        </div>

                                        <div class="mb-3">
                                            <strong>{{ __('admin.description') }}:</strong>
                                            {{ $model->description ?? '-' }}
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
