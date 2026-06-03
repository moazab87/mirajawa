@extends('admin.fixedPages.create')

@section('content')
@php $storeRoute = $updateRoute; @endphp
<div class="container-xxl flex-grow-1 container-p-y">
    <x-admin.breadcrumb :links="[
        ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
        ['url' => $route, 'text' => $title],
        ['url' => '#', 'text' => __('dashboard.edit')],
    ]" />
    <div class="card"><div class="card-body">
        <form action="{{ $updateRoute }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.layouts.partials.alerts')
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label">{{ __('dashboard.slug') }}</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $model->slug) }}">
                </div>
                @include('admin.shared.language-tabs', [
                    'fields' => [
                        'name' => ['type' => 'text', 'label' => 'dashboard.name', 'required' => true],
                        'sub_title' => ['type' => 'text', 'label' => 'dashboard.sub_title'],
                        'description' => ['type' => 'textarea', 'label' => 'dashboard.description'],
                    ],
                    'model' => $model,
                ])
                @include('admin.shared.status-select', ['model' => $model])
                <div class="mb-3 col-md-6">
                    <label class="form-label">{{ __('dashboard.image') }}</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if($model->image_url)<img src="{{ $model->image_url }}" class="img-thumbnail mt-2" style="max-height:120px">@endif
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-primary">{{ __('dashboard.update') }}</button>
                <a href="{{ $route }}" class="btn btn-outline-secondary mx-1">{{ __('dashboard.back') }}</a>
            </div>
        </form>
    </div></div>
</div>
@endsection
