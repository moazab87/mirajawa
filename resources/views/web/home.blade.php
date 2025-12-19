@extends('web.layouts.app')

@section('title', config('app.name'))

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h1 class="display-4 fw-bold mb-4" style="color: var(--primary-color);">
                        {{ __('admin.welcome_message_title') ?? 'Welcome' }}
                    </h1>
                    <p class="lead mb-4 text-muted">
                        {{ __('admin.welcome_message') ?? 'Discover our amazing collection' }}
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('web.categories.index') }}" class="btn btn-primary btn-lg">
                            {{ __('admin.categories') }} <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        @if($fixedPages->count() > 0)
                            <a href="#fixed-page-{{ $fixedPages->first()->id }}" class="btn btn-outline-primary btn-lg">
                                {{ __('admin.learn_more') ?? 'Learn More' }} <i class="bi bi-arrow-down ms-2"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    @if($sliders && $sliders->count() > 0)
                        <div id="heroSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
                            <div class="carousel-inner rounded shadow-lg" style="border-radius: 20px !important; overflow: hidden;">
                                @foreach($sliders as $slider)
                                    @php
                                        $media = $slider->attachments->first();
                                    @endphp
                                    @if($media)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            @if(str_starts_with($media->mime, 'image/'))
                                                <img src="{{ asset('storage/attachments/sliders/' . $media->file_name) }}" 
                                                     class="d-block w-100" 
                                                     alt="Slider {{ $loop->iteration }}"
                                                     style="height: 400px; object-fit: cover;">
                                            @else
                                                <video class="d-block w-100" autoplay muted loop style="height: 400px; object-fit: cover;">
                                                    <source src="{{ asset('storage/attachments/sliders/' . $media->file_name) }}" type="{{ $media->mime }}">
                                                </video>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @if($sliders->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                <div class="carousel-indicators">
                                    @foreach($sliders as $slider)
                                        <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="{{ $loop->index }}" 
                                                class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800" alt="Hero" class="img-fluid rounded shadow-lg" style="border-radius: 20px !important;">
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-10 rounded" style="border-radius: 20px;"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Fixed Pages Sections -->
    @foreach($fixedPages as $fixedPage)
        <section id="fixed-page-{{ $fixedPage->id }}" class="fixed-page-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto" data-aos="fade-up">
                        <h2 class="section-title text-center">{{ $fixedPage->name }}</h2>
                        <div class="content-wrapper text-center">
                            {!! $fixedPage->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach

    <!-- Categories Section -->
    @if($categories->count() > 0)
        <section class="py-5" style="background: linear-gradient(135deg, #fafafa 0%, #ffffff 100%);">
            <div class="container">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">{{ __('admin.categories') }}</h2>
                    <p class="lead text-muted">{{ __('admin.browse_categories') ?? 'Explore our collection' }}</p>
                </div>
                <div class="row g-4">
                    @foreach($categories as $category)
                        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="card h-100">
                                <div class="card-body text-center p-5">
                                    <div class="mb-4">
                                        <i class="bi bi-grid-3x3-gap display-4 text-primary"></i>
                                    </div>
                                    <h4 class="card-title mb-3 fw-bold">{{ $category->name }}</h4>
                                    @if($category->description)
                                        <p class="card-text text-muted mb-4">{{ Str::limit($category->description, 120) }}</p>
                                    @endif
                                    <div class="d-flex justify-content-center align-items-center gap-3">
                                        <span class="badge bg-primary">{{ $category->products_count ?? 0 }} {{ __('admin.products') }}</span>
                                        <a href="{{ route('web.categories.show', $category->id) }}" class="btn btn-primary">
                                            {{ __('admin.view') }} <i class="bi bi-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-5" data-aos="fade-up">
                    <a href="{{ route('web.categories.index') }}" class="btn btn-outline-primary btn-lg">
                        {{ __('admin.view_all_categories') ?? 'View All Categories' }} <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif
@endsection

