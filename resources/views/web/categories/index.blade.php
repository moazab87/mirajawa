@extends('web.layouts.app')

@section('title', __('website.categories'))

@section('content')
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-up">
                    <h1 class="display-4 fw-bold mb-3">{{ __('website.categories') }}</h1>
                    <p class="lead text-muted">{{ __('website.browse_categories') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            @if($categories->count() > 0)
                <div class="row g-4">
                    @foreach($categories as $category)
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body p-4">
                                    <h3 class="card-title mb-3">{{ $category->name }}</h3>
                                    @if($category->description)
                                        <p class="card-text text-muted mb-4">{{ Str::limit(strip_tags($category->description), 150) }}</p>
                                    @endif
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary">{{ $category->products_count ?? 0 }} {{ __('website.products') }}</span>
                                        <a href="{{ route('web.categories.show', $category->id) }}" class="btn btn-primary btn-sm">
                                            {{ __('website.view_details') }} <i class="bi bi-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <p class="lead text-muted mt-3">{{ __('website.no_content') }}</p>
                </div>
            @endif
        </div>
    </section>
@endsection
