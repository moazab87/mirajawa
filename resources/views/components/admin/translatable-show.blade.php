@props([
    'model',
    'fields',
    'headerField' => 'name',
    'editRoute',
    'backRoute',
    'icon' => 'bx-file',
])

<x-admin.show-page
    :title="$model->getDisplayTranslation($headerField)"
    :edit-route="$editRoute"
    :back-route="$backRoute"
    :icon="$icon"
>
    @if(isset($model->status))
        <x-slot name="headerMeta">
            <x-admin.status-badge :status="$model->status" />
        </x-slot>
    @endif

    @foreach (languages() as $lang)
        <div class="dash-detail-full dash-lang-section">
            <div class="dash-lang-section-title">{{ getLanguageName($lang) }}</div>
            <div class="dash-detail-grid">
                @foreach ($fields as $field)
                    <x-admin.detail-item
                        :label="__('dashboard.' . $field)"
                        icon="bx-text"
                        icon-variant="muted"
                    >
                        {{ $model->getTranslation($field, $lang) ?: '—' }}
                    </x-admin.detail-item>
                @endforeach
            </div>
        </div>
    @endforeach
</x-admin.show-page>
