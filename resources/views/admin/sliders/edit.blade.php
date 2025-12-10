@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('admin.edit')],
        ]" />

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $updateRoute }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        @include('admin.layouts.partials.alerts')

                        <div class="row">
                            <!-- Status Field -->
                            <div class="mb-3 col-md-6">
                                <label for="is_active" class="form-label">{{ __('admin.status') }}</label>
                                <select class="form-select" id="is_active" name="is_active">
                                    <option value="1" {{ old('is_active', $model->is_active) ? 'selected' : '' }}>{{ __('admin.active') }}</option>
                                    <option value="0" {{ old('is_active', $model->is_active) === false ? 'selected' : '' }}>{{ __('admin.inactive') }}</option>
                                </select>
                                @error('is_active')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>

                            @php
                                $existingMedia = $model->attachments->first();
                            @endphp

                            <!-- Existing Media -->
                            @if($existingMedia)
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">{{ __('admin.existing_media') ?? 'Existing Media' }}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body p-2">
                                                    @if(str_starts_with($existingMedia->mime, 'image/'))
                                                        <img src="{{ asset('storage/attachments/sliders/' . $existingMedia->file_name) }}"
                                                            alt="{{ $existingMedia->original_name }}"
                                                            class="img-fluid rounded" style="max-height: 200px; width: 100%; object-fit: cover;">
                                                    @else
                                                        <video class="w-100 rounded" style="max-height: 200px;" controls>
                                                            <source src="{{ asset('storage/attachments/sliders/' . $existingMedia->file_name) }}" type="{{ $existingMedia->mime }}">
                                                        </video>
                                                    @endif
                                                    <small class="text-muted d-block mt-1">{{ $existingMedia->original_name }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- New Media Field (Image or Video) -->
                            <div class="mb-3 col-md-12">
                                <label for="media" class="form-label">{{ __('admin.media') ?? 'Media (Image or Video)' }}</label>
                                <input type="file" class="form-control" id="media" name="media"
                                    accept="image/*,video/*">
                                <small class="text-muted">{{ __('admin.slider_media_hint') ?? 'Upload an image (JPEG, PNG, GIF, WEBP) or video (MP4, MOV, AVI, WMV, FLV, WEBM). Max size: 5MB. Leave empty to keep existing media.' }}</small>
                                @error('media')
                                    <div class="text-danger">{{ $error }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-warning mx-1">
                                {{ __('admin.back') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

