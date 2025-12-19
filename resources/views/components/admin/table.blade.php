<div class="card">
    <div class="pt-3">
        {{-- if seacrh true --}}
        @if (isset($search))
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    @isset($title)
                        {{ $title }}
                    @endisset
                </h5>
                <div class="d-flex">
                    @if (isset($search))
                        @if ($search)
                            <x-admin.search-form :route="$indexRoute" />
                        @endif
                    @endif
                    @if (isset($createRoute))
                        <a href="{{ $createRoute }}" class="btn btn-primary">{{ $buttonText }}</a>
                    @endif
                </div>
            </div>
        @endif
    </div>
    <div class="card-body">
        @include('admin.layouts.partials.alerts')
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-dark">
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
