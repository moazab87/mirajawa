@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('admin.create')],
        ]" />
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $storeRoute }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.layouts.partials.alerts')
                        <div class="row">
                            <!-- Status Field -->
                            <div class="mb-3 col-md-6">
                                <label for="is_active" class="form-label">{{ __('admin.status') }}</label>
                                <select class="form-select" id="is_active" name="is_active">
                                    <option value="1" {{ old('is_active', true) ? 'selected' : '' }}>{{ __('admin.active') }}</option>
                                    <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>{{ __('admin.inactive') }}</option>
                                </select>
                                @error('is_active')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>

                            <!-- Media Field (Image or Video) -->
                            <div class="mb-3 col-md-12">
                                <label for="media" class="form-label">{{ __('admin.media') ?? 'Media (Image or Video)' }}</label>
                                <input type="file" class="form-control" id="media" name="media"
                                    accept="image/*,video/*" required>
                                <small class="text-muted">{{ __('admin.slider_media_hint') ?? 'Upload an image (JPEG, PNG, GIF, WEBP) or video (MP4, MOV, AVI, WMV, FLV, WEBM). Max size: 5MB' }}</small>
                                @error('media')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">{{ __('admin.create') }}</button>
                            <a href="{{ url()->previous() }}" type="reset"
                                class="btn btn-outline-warning mx-1">{{ __('admin.back') }}</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

