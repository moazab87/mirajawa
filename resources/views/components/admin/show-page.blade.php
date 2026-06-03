@props([
    'title',
    'editRoute' => null,
    'backRoute',
    'icon' => 'bx-detail',
    'iconVariant' => 'primary-soft',
])

<div class="dash-show-page">
    <div class="card dash-card mb-4">
        <div class="dash-show-header">
            <div class="dash-show-icon bg-{{ $iconVariant }}">
                <i class="bx {{ $icon }}"></i>
            </div>
            <h1 class="dash-show-title">{{ $title }}</h1>
            @if(isset($headerMeta))
                <div class="mt-2">{{ $headerMeta }}</div>
            @endif
        </div>

        <div class="dash-show-body">
            <div class="dash-detail-grid">
                {{ $slot }}
            </div>
        </div>

        <div class="dash-show-actions">
            @if($editRoute)
                <a href="{{ $editRoute }}" class="btn btn-primary">
                    <i class="bx bx-edit-alt"></i>
                    {{ __('dashboard.edit') }}
                </a>
            @endif
            <a href="{{ $backRoute }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i>
                {{ __('dashboard.back') }}
            </a>
        </div>
    </div>
</div>
