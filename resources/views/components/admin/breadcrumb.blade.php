<h4 class="py-3 breadcrumb-wrapper mb-4">
    @foreach($links as $link)
        <a href="{{ $link['url'] }}" class="text-decoration-none">
            <span class="{{ $loop->last ? 'text-primary fw-semibold' : 'text-muted' }}  fw-light">{{ $link['text'] }}</span>
        </a>
        @if (!$loop->last)
            <span class="text-muted fw-light"> / </span>
        @endif
    @endforeach
</h4>
