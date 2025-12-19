@extends('web.layouts.app')

@php
    $fixedPages = $fixedPages ?? \App\Models\FixedPage::all();
@endphp

@section('title', $product->name)

@section('content')
    <!-- Page Header -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">{{ __('admin.dashboard') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('web.categories.index') }}">{{ __('admin.categories') }}</a></li>
                            @if($product->category)
                                <li class="breadcrumb-item"><a href="{{ route('web.categories.show', $product->category->id) }}">{{ $product->category->name }}</a></li>
                            @endif
                            <li class="breadcrumb-item active">{{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Details -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Product Images/Videos -->
                <div class="col-lg-6 mb-4" data-aos="fade-right">
                    @php
                        $images = $product->attachments->filter(function($att) {
                            return str_starts_with($att->mime, 'image/');
                        });
                        $videos = $product->attachments->filter(function($att) {
                            return str_starts_with($att->mime, 'video/');
                        });
                    @endphp
                    
                    @if($images->count() > 0)
                        <div class="mb-4">
                            <h5 class="mb-3">{{ __('admin.images') }}</h5>
                            <div class="row g-3" data-fancybox="product-images-gallery">
                                @foreach($images as $image)
                                    <div class="col-6">
                                        <a href="{{ asset('storage/attachments/products/' . $image->file_name) }}"
                                           data-fancybox="product-images-gallery"
                                           data-caption="{{ $image->original_name }}">
                                            <img src="{{ asset('storage/attachments/products/' . $image->file_name) }}" 
                                                 class="img-fluid rounded shadow-sm" 
                                                 alt="{{ $image->original_name }}">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    @if($videos->count() > 0)
                        <div>
                            <h5 class="mb-3">{{ __('admin.videos') }}</h5>
                            <div class="row g-3">
                                @foreach($videos as $video)
                                    <div class="col-12">
                                        <a href="#video-{{ $video->id }}"
                                           data-fancybox="product-videos-gallery"
                                           data-caption="{{ $video->original_name }}"
                                           data-type="html">
                                            <div class="position-relative">
                                                <video class="w-100 rounded shadow-sm" style="max-height: 300px;" muted>
                                                    <source src="{{ asset('storage/attachments/products/' . $video->file_name) }}" type="{{ $video->mime }}">
                                                </video>
                                                <div class="position-absolute top-50 start-50 translate-middle">
                                                    <i class="bi bi-play-circle-fill text-white" style="font-size: 4rem; opacity: 0.8;"></i>
                                                </div>
                                            </div>
                                        </a>
                                        <div id="video-{{ $video->id }}" style="display: none;">
                                            <video class="w-100" controls style="max-width: 100%;">
                                                <source src="{{ asset('storage/attachments/products/' . $video->file_name) }}" type="{{ $video->mime }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="col-lg-6" data-aos="fade-left">
                    <h1 class="display-5 fw-bold mb-3">{{ $product->name }}</h1>
                    
                    @if($product->category)
                        <p class="text-muted mb-3">
                            <i class="bi bi-tag"></i> 
                            <a href="{{ route('web.categories.show', $product->category->id) }}" class="text-decoration-none">
                                {{ $product->category->name }}
                            </a>
                        </p>
                    @endif
                    
                    @if($product->description)
                        <div class="mb-4">
                            <h5>{{ __('admin.description') }}</h5>
                            <p class="text-muted">{{ $product->description }}</p>
                        </div>
                    @endif
                    
                    @if($product->link)
                        <div class="mb-4">
                            <a href="{{ $product->link }}" target="_blank" class="btn btn-primary btn-lg">
                                <i class="bi bi-link-45deg"></i> {{ __('admin.view_link') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="section-title mb-5" data-aos="fade-up">{{ __('admin.related_products') ?? 'Related Products' }}</h2>
                <div class="row g-4">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="card h-100 shadow-sm">
                                @php
                                    $firstImage = $relatedProduct->attachments->filter(function($att) {
                                        return str_starts_with($att->mime, 'image/');
                                    })->first();
                                @endphp
                                @if($firstImage)
                                    <a href="{{ route('web.products.show', $relatedProduct->id) }}">
                                        <img src="{{ asset('storage/attachments/products/' . $firstImage->file_name) }}" 
                                             class="card-img-top" 
                                             alt="{{ $relatedProduct->name }}">
                                    </a>
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title">{{ $relatedProduct->name }}</h6>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <a href="{{ route('web.products.show', $relatedProduct->id) }}" class="btn btn-primary btn-sm w-100">
                                        {{ __('admin.view') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Fancybox for images
            if (document.querySelector("[data-fancybox='product-images-gallery']")) {
                Fancybox.bind("[data-fancybox='product-images-gallery']", {
                    Toolbar: {
                        display: {
                            left: ["infobar"],
                            middle: [],
                            right: ["slideshow", "download", "thumbs", "close"],
                        },
                    },
                });
            }

            // Initialize Fancybox for videos
            if (document.querySelector("[data-fancybox='product-videos-gallery']")) {
                Fancybox.bind("[data-fancybox='product-videos-gallery']", {
                    Toolbar: {
                        display: {
                            left: ["infobar"],
                            middle: [],
                            right: ["slideshow", "download", "thumbs", "close"],
                        },
                    },
                });
            }
        });
    </script>
@endsection

