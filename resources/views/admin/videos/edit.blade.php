@extends('admin.layouts.app')
@section('title', $subTitle)
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <x-admin.breadcrumb :links="[
        ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
        ['url' => $route, 'text' => $title],
        ['url' => '#', 'text' => __('dashboard.edit')],
    ]" />
    <div class="card"><div class="card-body">
        <form action="{{ $updateRoute }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.layouts.partials.alerts')
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="video">{{ __('dashboard.video_file') }}</label>
                    <input type="file" name="video" id="video" class="form-control" accept="video/mp4,video/webm,video/quicktime,.mp4,.webm,.mov">
                    <small class="text-muted d-block mt-1">{{ __('dashboard.videos_upload_hint') }}</small>
                    @if($model->video_url)
                        <div class="mt-3">
                            <p class="form-label mb-2">{{ __('dashboard.video_preview') }}</p>
                            <video class="mj-admin-video-preview" muted playsinline preload="metadata" controls>
                                <source src="{{ $model->video_url }}" type="{{ $model->video_mime }}">
                            </video>
                        </div>
                    @endif
                </div>
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="sort_order">{{ __('dashboard.sort_order') }}</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control" min="0" value="{{ old('sort_order', $model->sort_order ?? 0) }}">
                </div>
                @include('admin.shared.status-select', ['model' => $model])
                @include('admin.shared.language-tabs', ['fields' => [
                    'title' => ['type' => 'text', 'label' => 'dashboard.title'],
                    'description' => ['type' => 'textarea', 'label' => 'dashboard.description'],
                ], 'model' => $model])
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-primary">{{ __('dashboard.update') }}</button>
                <a href="{{ url()->previous() }}" class="btn btn-outline-warning mx-1">{{ __('dashboard.back') }}</a>
            </div>
        </form>
    </div></div>
</div>
@endsection
