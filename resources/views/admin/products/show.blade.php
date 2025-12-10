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
                    <h5 class="mb-0">{{ __('admin.product_details') }}</h5>
                    <div>
                        <a href="{{ route('admin.products.edit', $model->id) }}" class="btn btn-sm btn-primary">
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
                            <strong>{{ __('admin.name') }}:</strong>
                            <p>{{ $model->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>{{ __('admin.category') }}:</strong>
                            <p>{{ $model->category?->name ?? __('admin.not_assigned') }}</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <strong>{{ __('admin.description') }}:</strong>
                            <p>{{ $model->description ?? '-' }}</p>
                        </div>
                        @if ($model->link)
                            <div class="col-md-12 mb-3">
                                <strong>{{ __('admin.link') }}:</strong>
                                <p>
                                    <a href="{{ $model->link }}" target="_blank" class="text-primary">
                                        <i class="bx bx-link-external"></i> {{ $model->link }}
                                    </a>
                                </p>
                            </div>
                        @endif
                        @php
                            $images = $model->attachments->filter(function($attachment) {
                                return str_starts_with($attachment->mime, 'image/');
                            });
                            $videos = $model->attachments->filter(function($attachment) {
                                return str_starts_with($attachment->mime, 'video/');
                            });
                        @endphp

                        @if ($images->count() > 0)
                            <div class="col-md-12 mb-3">
                                <strong>{{ __('admin.images') }}:</strong>
                                <div class="row mt-2" data-fancybox="product-images-gallery">
                                    @foreach ($images as $attachment)
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <div class="card-body p-2">
                                                    <a href="{{ asset('storage/attachments/products/' . $attachment->file_name) }}"
                                                        data-fancybox="product-images-gallery"
                                                        data-caption="{{ $attachment->original_name }}">
                                                        <img src="{{ asset('storage/attachments/products/' . $attachment->file_name) }}"
                                                            alt="{{ $attachment->original_name }}"
                                                            class="img-fluid rounded cursor-pointer" 
                                                            style="max-height: 150px; width: 100%; object-fit: cover;">
                                                    </a>
                                                    <small class="text-muted d-block mt-1">{{ $attachment->original_name }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($videos->count() > 0)
                            <div class="col-md-12 mb-3">
                                <strong>{{ __('admin.videos') }}:</strong>
                                <div class="row mt-2">
                                    @foreach ($videos as $attachment)
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <div class="card-body p-2">
                                                    <a href="#video-{{ $attachment->id }}"
                                                        data-fancybox="product-videos-gallery"
                                                        data-caption="{{ $attachment->original_name }}"
                                                        data-type="html">
                                                        <video class="w-100 rounded cursor-pointer" style="max-height: 150px; object-fit: cover;" muted>
                                                            <source src="{{ asset('storage/attachments/products/' . $attachment->file_name) }}" type="{{ $attachment->mime }}">
                                                        </video>
                                                        <div class="text-center mt-2">
                                                            <i class="bx bx-play-circle text-primary" style="font-size: 1.5rem;"></i>
                                                            <p class="small mb-0">{{ $attachment->original_name }}</p>
                                                        </div>
                                                    </a>
                                                    <div id="video-{{ $attachment->id }}" style="display: none;">
                                                        <video class="w-100" controls style="max-width: 100%;">
                                                            <source src="{{ asset('storage/attachments/products/' . $attachment->file_name) }}" type="{{ $attachment->mime }}">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    </div>
                                                    <small class="text-muted d-block mt-1">{{ $attachment->original_name }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <style>
        .cursor-pointer {
            cursor: pointer;
        }
        .cursor-pointer:hover {
            opacity: 0.8;
        }
    </style>
@endsection

@section('script')
    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Fancybox for images gallery
            if (document.querySelector("[data-fancybox='product-images-gallery']")) {
                Fancybox.bind("[data-fancybox='product-images-gallery']", {
                    Toolbar: {
                        display: {
                            left: ["infobar"],
                            middle: [],
                            right: ["slideshow", "download", "thumbs", "close"],
                        },
                    },
                    Thumbs: {
                        autoStart: false,
                    },
                });
            }

            // Initialize Fancybox for videos gallery
            if (document.querySelector("[data-fancybox='product-videos-gallery']")) {
                Fancybox.bind("[data-fancybox='product-videos-gallery']", {
                    Toolbar: {
                        display: {
                            left: ["infobar"],
                            middle: [],
                            right: ["slideshow", "download", "thumbs", "close"],
                        },
                    },
                    Thumbs: {
                        autoStart: false,
                    },
                });
            }
        });
    </script>
@endsection

