@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('dashboard.edit')],
        ]" />

        <div class="row">
            <x-admin.form-card>
                <form action="{{ $updateRoute }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.layouts.partials.alerts')
                    <div class="row">
                        @include('admin.shared.language-tabs', [
                            'model' => $model,
                            'fields' => [
                                'name' => ['type' => 'text', 'label' => 'dashboard.name', 'required' => true],
                                'description' => ['type' => 'textarea', 'label' => 'dashboard.description'],
                            ],
                        ])
                        <div class="mb-3 col-md-6">
                            <label class="form-label">{{ __('dashboard.color') }}</label>
                            <input type="color" name="color" class="form-control form-control-color" value="{{ old('color', $model->color ?? '#2563eb') }}">
                        </div>
                        @include('admin.shared.status-select', ['model' => $model])
                    </div>
                    <x-admin.form-actions :submit-text="__('dashboard.edit')" :back-url="$route" />
                </form>
            </x-admin.form-card>
        </div>
    </div>
@endsection
