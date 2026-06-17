@props(['title', 'subtitle' => null, 'breadcrumbs' => []])

<section class="mj-page-hero">
    <div class="mj-container mj-page-hero__inner">
        @include('web.partials.breadcrumb', ['items' => $breadcrumbs])
        <h1 class="mj-page-hero__title">{{ $title }}</h1>
        @if($subtitle)
            <p class="mj-page-hero__subtitle">{{ $subtitle }}</p>
        @endif
    </div>
</section>
