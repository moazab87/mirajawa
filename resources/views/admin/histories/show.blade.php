@extends('admin.layouts.app')
@section('title', $subTitle)
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <x-admin.breadcrumb :links="[
        ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
        ['url' => $route, 'text' => $title],
        ['url' => '#', 'text' => __('dashboard.show')],
    ]" />
    <x-admin.show-page
        :title="$model->getDisplayTranslation('name')"
        :edit-route="route($editRoute, $model->id)"
        :back-route="$route"
        icon="bx-time-five"
    >
        <x-slot name="headerMeta">
            <x-admin.status-badge :status="$model->status" />
        </x-slot>

        <div class="dash-detail-full mb-3">
            <div class="dash-detail-grid">
                <x-admin.detail-item :label="__('dashboard.year')" icon="bx-calendar" icon-variant="muted">
                    {{ $model->year ?? '—' }}
                </x-admin.detail-item>
            </div>
        </div>

        @foreach (languages() as $lang)
            <div class="dash-detail-full dash-lang-section">
                <div class="dash-lang-section-title">{{ getLanguageName($lang) }}</div>
                <div class="dash-detail-grid">
                    @foreach (['name', 'description'] as $field)
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
</div>
@endsection
