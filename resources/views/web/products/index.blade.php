@extends('web.layouts.app')

@section('title', ($page?->name ?? __('website.products')) . ' | ' . config('app.name'))
@section('meta_description', Str::limit(strip_tags($page?->description ?? ''), 160))

@section('content')
    @include('web.partials.page-hero', [
        'title' => $page?->name ?? __('website.products'),
        'subtitle' => $page?->sub_title ?? null,
        'breadcrumbs' => [
            __('website.breadcrumb_home') => route('web.home'),
            __('website.products') => route('web.products.index'),
        ],
    ])

    <section class="mj-section mj-section--beige">
        <div class="mj-container">
            @if($page && $page?->description)
                <div class="mj-content mj-content-narrow mb-4 mj-reveal">{!! $page?->description !!}</div>
            @endif

            {{-- @if($categories->count())
                <nav class="mj-filter-pills mj-reveal" aria-label="{{ __('website.categories') }}">
                    <a href="{{ route('web.products.index', array_filter(['search' => $search, 'group' => $activeGroupId])) }}"
                       class="mj-filter-pill {{ !$activeCategoryId ? 'active' : '' }}">{{ __('website.all_categories') }}</a>
                    @foreach($categories as $category)
                        <a href="{{ route('web.products.index', array_filter(['category' => $category->id, 'search' => $search, 'group' => $activeGroupId])) }}"
                           class="mj-filter-pill {{ $activeCategoryId == $category->id ? 'active' : '' }}">{{ $category->name }}</a>
                    @endforeach
                </nav>
            @endif --}}

            <form method="GET" action="{{ route('web.products.index') }}" class="mj-filter-bar mj-form mj-reveal">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label" for="search">{{ __('website.search_products') }}</label>
                        <input type="text" name="search" id="search" class="form-control" value="{{ $search }}" placeholder="{{ __('website.search_products') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="category">{{ __('website.category') }}</label>
                        <select name="category" id="category" class="form-select">
                            <option value="">{{ __('website.all_categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected($activeCategoryId == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="group">{{ __('website.product_group') }}</label>
                        <select name="group" id="group" class="form-select">
                            <option value="">{{ __('website.all_groups') }}</option>
                            @foreach($productGroups as $group)
                                <option value="{{ $group->id }}" @selected($activeGroupId == $group->id)>{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="mj-btn mj-btn--primary w-100">{{ __('website.filter') }}</button>
                    </div>
                </div>
            </form>

            @if($products->count())
                <div class="mj-grid mj-grid--3">
                    @foreach($products as $product)
                        @include('web.components.product-card', ['product' => $product])
                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                </div>
            @else
                @include('web.components.empty-state', [
                    'icon' => 'bi-box-seam',
                    'title' => __('website.no_products'),
                    'text' => __('website.no_products_hint'),
                ])
            @endif
        </div>
    </section>

    @include('web.partials.cta-section')
@endsection
