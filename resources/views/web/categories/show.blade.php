@extends('web.layouts.app')

@php
    $fixedPages = $fixedPages ?? \App\Models\FixedPage::all();
@endphp

@section('title', $category->name)

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
                            <li class="breadcrumb-item active">{{ $category->name }}</li>
                        </ol>
                    </nav>
                    <h1 class="display-4 fw-bold mb-3">{{ $category->name }}</h1>
                    @if($category->description)
                        <p class="lead text-muted">{{ $category->description }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-5">
        <div class="container">
            @if($products->count() > 0)
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="card h-100 shadow-sm">
                                @php
                                    $firstImage = $product->attachments->filter(function($att) {
                                        return str_starts_with($att->mime, 'image/');
                                    })->first();
                                @endphp
                                @if($firstImage)
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <img src="{{ asset('storage/attachments/products/' . $firstImage->file_name) }}" 
                                             class="card-img-top" 
                                             alt="{{ $product->name }}">
                                    </a>
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                                        <i class="bi bi-image display-4 text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    @if($product->description)
                                        <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                                    @endif
                                    @if($product->link)
                                        <a href="{{ $product->link }}" target="_blank" class="btn btn-outline-primary btn-sm mb-2">
                                            <i class="bi bi-link-45deg"></i> {{ __('admin.view_link') }}
                                        </a>
                                    @endif
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary w-100">
                                        {{ __('admin.view_details') ?? 'View Details' }} <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-5">
                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <p class="lead text-muted mt-3">{{ __('admin.no_products_available') ?? 'No products available in this category' }}</p>
                    <a href="{{ route('web.categories.index') }}" class="btn btn-primary mt-3">
                        {{ __('admin.back_to_categories') ?? 'Back to Categories' }}
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection

