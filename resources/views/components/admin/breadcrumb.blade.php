<nav class="dash-breadcrumb" aria-label="breadcrumb">
    @foreach($links as $link)
        @if ($loop->last)
            <span class="dash-breadcrumb-current">{{ $link['text'] }}</span>
        @else
            <a href="{{ $link['url'] }}" class="dash-breadcrumb-link">{{ $link['text'] }}</a>
            <span class="dash-breadcrumb-sep">/</span>
        @endif
    @endforeach
</nav>
