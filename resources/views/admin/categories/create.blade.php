@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('dashboard.create')],
        ]" />

        <div class="row">
            <x-admin.form-card>
                <form action="{{ $storeRoute }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.layouts.partials.alerts')
                    <div class="row">
                        @include('admin.shared.language-tabs', [
                            'fields' => [
                                'name' => ['type' => 'text', 'label' => 'dashboard.name', 'required' => true],
                                'description' => ['type' => 'textarea', 'label' => 'dashboard.description'],
                            ],
                        ])
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{ __('dashboard.color') }}</label>
                            <input type="color" name="color" class="form-control form-control-color" value="{{ old('color', '#2563eb') }}">
                        </div>
                        @include('admin.shared.status-select')
                    </div>
                    <x-admin.form-actions :submit-text="__('dashboard.create')" :back-url="$route" />
                </form>
            </x-admin.form-card>
        </div>
    </div>
@endsection
