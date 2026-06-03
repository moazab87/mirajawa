@extends('admin.layouts.app')
@section('title', $subTitle)
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <x-admin.breadcrumb :links="[
        ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
        ['url' => $route, 'text' => $title],
        ['url' => '#', 'text' => __('dashboard.create')],
    ]" />
    <div class="card"><div class="card-body">
        <form action="{{ $storeRoute }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            @include('admin.layouts.partials.alerts')
            <div class="row">
                @include('admin.shared.language-tabs', ['fields' => [
                    'name' => ['type' => 'text', 'label' => 'dashboard.name', 'required' => true],
                    'description' => ['type' => 'textarea', 'label' => 'dashboard.description']
                ], 'model' => $model ?? null])
                @include('admin.shared.status-select', ['model' => $model ?? null])
                <div class="mb-3 col-md-6"><label class="form-label">{{ __('dashboard.phone') }}</label><input type="text" name="phone" class="form-control" value="{{ old('phone', $model->phone ?? '') }}"></div>
                <div class="mb-3 col-md-6"><label class="form-label">{{ __('dashboard.image') }}</label><input type="file" name="image" class="form-control" accept="image/*"></div>
                @isset($model) @if($model->image)<img src="{{ $model->image_url }}" class="img-thumbnail mt-2" style="max-height:120px">@endif @endisset
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-primary">{{ __('dashboard.create') }}</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-warning mx-1">{{ __('dashboard.back') }}</a>
            </div>
        </form>
    </div></div>
</div>
@endsection
