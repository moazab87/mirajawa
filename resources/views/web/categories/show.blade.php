@extends('web.layouts.app')

@section('title', $category->name)

@section('content')
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    @include('web.partials.breadcrumb', [
                        'items' => [
                            __('website.breadcrumb_home') => route('web.home'),
                            __('website.categories') => route('web.categories.index'),
                            $category->name => url()->current(),
                        ],
                    ])
                    <h1 class="display-4 fw-bold mb-3">{{ $category->name }}</h1>
                    @if($category->description)
                        <div class="lead text-muted mj-content">{!! $category->description !!}</div>
                    @endif
                </div>
            </div>
        </div>
    </section>

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
                                    <a href="{{ route('web.products.show', $product->id) }}">
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
                                        <p class="card-text text-muted">{{ Str::limit(strip_tags($product->description), 100) }}</p>
                                    @endif
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <a href="{{ route('web.products.show', $product->id) }}" class="btn btn-primary w-100">
                                        {{ __('website.view_details') }} <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5">
                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <p class="lead text-muted mt-3">{{ __('website.no_products_available') }}</p>
                    <a href="{{ route('web.categories.index') }}" class="btn btn-primary mt-3">
                        {{ __('website.back_to_categories') }}
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
