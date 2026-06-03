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
        :title="$model->name"
        :back-route="$route"
        icon="bx-mail-send"
        icon-variant="primary-soft"
    >
        <x-slot name="headerMeta">
            <x-admin.status-badge :status="$model->status" />
        </x-slot>

        <x-admin.detail-item :label="__('dashboard.email')" icon="bx-envelope" icon-variant="muted">
            {{ $model->email }}
        </x-admin.detail-item>

        <x-admin.detail-item :label="__('dashboard.company_name')" icon="bx-buildings" icon-variant="muted">
            {{ $model->company_name ?: '—' }}
        </x-admin.detail-item>

        <x-admin.detail-item :label="__('dashboard.phone')" icon="bx-phone" icon-variant="muted">
            {{ $model->phone ?: '—' }}
        </x-admin.detail-item>

        <x-admin.detail-item :label="__('dashboard.message')" icon="bx-message-detail" icon-variant="muted" :full-width="true">
            {{ $model->message }}
        </x-admin.detail-item>
    </x-admin.show-page>

    @if($model->status->value === 0)
        <form action="{{ route('admin.contactMessages.markReplied', $model->id) }}" method="POST" class="text-center">
            @csrf
            <button type="submit" class="btn btn-success">
                <i class="bx bx-check"></i>
                {{ __('dashboard.mark_replied') }}
            </button>
        </form>
    @endif
</div>
@endsection
