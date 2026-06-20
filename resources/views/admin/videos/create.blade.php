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
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="video">{{ __('dashboard.video_file') }} <span class="text-danger">*</span></label>
                    <input type="file" name="video" id="video" class="form-control" accept="video/mp4,video/webm,video/quicktime,.mp4,.webm,.mov" required>
                    <small class="text-muted d-block mt-1">{{ __('dashboard.videos_upload_hint') }}</small>
                </div>
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="sort_order">{{ __('dashboard.sort_order') }}</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control" min="0" value="{{ old('sort_order', 0) }}">
                </div>
                @include('admin.shared.status-select', ['model' => $model ?? null])
                @include('admin.shared.language-tabs', ['fields' => [
                    'title' => ['type' => 'text', 'label' => 'dashboard.title'],
                    'description' => ['type' => 'textarea', 'label' => 'dashboard.description'],
                ], 'model' => $model ?? null])
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-primary">{{ __('dashboard.create') }}</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-warning mx-1">{{ __('dashboard.back') }}</a>
            </div>
        </form>
    </div></div>
</div>
@endsection
