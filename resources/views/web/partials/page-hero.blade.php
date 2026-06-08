@props(['title', 'subtitle' => null, 'breadcrumbs' => []])

<section class="mj-page-hero">
    <div class="mj-container mj-page-hero__inner">
        @if(!empty($breadcrumbs))
            <nav class="mj-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach($breadcrumbs as $label => $url)
                        @if($loop->last)
                            <li class="breadcrumb-item active" aria-current="page">{{ $label }}</li>
                        @else
                            <li class="breadcrumb-item"><a href="{{ $url }}">{{ $label }}</a></li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        @endif
        <h1 class="mj-page-hero__title">{{ $title }}</h1>
        @if($subtitle)
            <p class="mj-page-hero__subtitle">{{ $subtitle }}</p>
        @endif
    </div>
</section>
