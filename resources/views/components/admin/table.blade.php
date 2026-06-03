@props([
    'headers' => [],
    'title' => null,
    'createRoute' => null,
    'buttonText' => null,
    'search' => false,
    'indexRoute' => null,
])

<div class="card dash-card dash-table-card">
    @if ($title || $search || $createRoute)
        <div class="dash-table-header d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                @if ($title)
                    <h5 class="dash-page-title">{{ $title }}</h5>
                @endif
            </div>
            <div class="dash-table-toolbar">
                @if ($search && $indexRoute)
                    <x-admin.search-form :route="$indexRoute" />
                @endif
                @if ($createRoute)
                    <a href="{{ $createRoute }}" class="btn btn-primary">
                        <i class="bx bx-plus"></i>
                        {{ $buttonText }}
                    </a>
                @endif
            </div>
        </div>
    @endif

    <div class="card-body">
        @include('admin.layouts.partials.alerts')
        <div class="table-responsive">
            <table class="table dash-table text-center mb-0">
                <thead>
                    <tr>
                        @foreach ($headers as $header)
                            <th>{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>
