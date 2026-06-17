@props([
    'model',
    'fields',
    'headerField' => 'name',
    'editRoute',
    'backRoute',
    'icon' => 'bx-file',
    'richFields' => ['description', 'answer', 'map_desc', 'how_to_use', 'storage_conditions', 'notes'],
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
                    @php
                        $content = $model->getTranslation($field, $lang, false);
                        $isRich = in_array($field, $richFields, true);
                    @endphp
                    <x-admin.detail-item
                        :label="__('dashboard.' . $field)"
                        icon="bx-text"
                        icon-variant="muted"
                        :full-width="$isRich"
                    >
                        @if($isRich && $content)
                            <div class="mj-admin-rich-content">{!! $content !!}</div>
                        @else
                            {{ $content ?: '—' }}
                        @endif
                    </x-admin.detail-item>
                @endforeach
            </div>
        </div>
    @endforeach
</x-admin.show-page>
