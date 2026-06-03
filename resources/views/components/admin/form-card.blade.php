@props(['title' => null])

<div class="col-12">
    <div class="card dash-card">
        @if($title)
            <div class="card-header border-bottom">
                <h5 class="dash-page-title mb-0">{{ $title }}</h5>
            </div>
        @endif
        <div class="card-body">
            {{ $slot }}
        </div>
    </div>
</div>
