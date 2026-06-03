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
                    @include('admin.shared.language-tabs', [
                        'fields' => [
                            'title' => ['type' => 'text', 'label' => 'dashboard.title', 'required' => true],
                            'description' => ['type' => 'textarea', 'label' => 'dashboard.description'],
                        ],
                    ])
                    @include('admin.shared.status-select')
                    <div class="mb-3 col-md-12">
                        <label for="media" class="form-label">{{ __('dashboard.media') }}</label>
                        <input type="file" class="form-control" id="media" name="media" accept="image/*,video/*">
                        <small class="text-muted">{{ __('dashboard.slider_media_hint') }}</small>
                        @error('media')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary">{{ __('dashboard.create') }}</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-warning mx-1">{{ __('dashboard.back') }}</a>
                </div>
            </form>
        </div></div>
    </div>
@endsection
