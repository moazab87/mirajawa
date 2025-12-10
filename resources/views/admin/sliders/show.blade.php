@extends('admin.layouts.app')

@section('title', $subTitle)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('admin.show')],
        ]" />

        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('admin.slider_details') ?? 'Slider Details' }}</h5>
                    <div>
                        <a href="{{ route('admin.sliders.edit', $model->id) }}" class="btn btn-sm btn-primary">
                            <i class="bx bx-edit"></i> {{ __('admin.edit') }}
                        </a>
                        <a href="{{ $route }}" class="btn btn-sm btn-secondary">
                            <i class="bx bx-arrow-back"></i> {{ __('admin.back') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>{{ __('admin.status') }}:</strong>
                            <p>
                                <span class="badge bg-{{ $model->is_active ? 'success' : 'secondary' }}">
                                    {{ $model->is_active ? __('admin.active') : __('admin.inactive') }}
                                </span>
                            </p>
                        </div>
                        @php
                            $media = $model->attachments->first();
                        @endphp
                        @if($media)
                            <div class="col-md-12 mb-3">
                                <strong>{{ __('admin.media') ?? 'Media' }}:</strong>
                                <div class="mt-2">
                                    @if(str_starts_with($media->mime, 'image/'))
                                        <img src="{{ asset('storage/attachments/sliders/' . $media->file_name) }}"
                                            alt="{{ $media->original_name }}"
                                            class="img-fluid rounded" style="max-height: 400px;">
                                    @else
                                        <video class="w-100 rounded" controls style="max-height: 400px;">
                                            <source src="{{ asset('storage/attachments/sliders/' . $media->file_name) }}" type="{{ $media->mime }}">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

