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
            :edit-route="route('admin.categories.edit', $model->id)"
            :back-route="$route"
            icon="bx-folder"
        >
            <x-slot name="headerMeta">
                <x-admin.status-badge :status="$model->status" />
            </x-slot>

            <x-admin.detail-item :label="__('dashboard.name')" icon="bx-rename">
                {{ $model->getDisplayTranslation('name') }}
            </x-admin.detail-item>

            <x-admin.detail-item :label="__('dashboard.color')" icon="bx-palette">
                @if($model->color)
                    <span class="d-inline-flex align-items-center gap-2">
                        <span style="width: 1rem; height: 1rem; border-radius: 50%; background: {{ $model->color }}; display: inline-block;"></span>
                        {{ $model->color }}
                    </span>
                @else
                    —
                @endif
            </x-admin.detail-item>

            <x-admin.detail-item :label="__('dashboard.description')" icon="bx-text" :full-width="true">
                {{ $model->getDisplayTranslation('description') ?: '—' }}
            </x-admin.detail-item>
        </x-admin.show-page>
    </div>
@endsection
