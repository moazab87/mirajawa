@extends('admin.layouts.app')
@section('title', $subTitle)
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <x-admin.breadcrumb :links="[
        ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
        ['url' => $route, 'text' => $title],
        ['url' => '#', 'text' => __('dashboard.show')],
    ]" />
    <div class="card">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-lg-6">
                    @if($model->video_url)
                        <video class="w-100 rounded" style="max-height:360px;background:#000;" muted playsinline preload="metadata" controls>
                            <source src="{{ $model->video_url }}" type="{{ $model->video_mime }}">
                            {{ __('dashboard.video_not_supported') }}
                        </video>
                    @endif
                </div>
                <div class="col-lg-6">
                    <p class="mb-2"><strong>{{ __('dashboard.status') }}:</strong> <x-admin.status-badge :status="$model->status" /></p>
                    <p class="mb-2"><strong>{{ __('dashboard.sort_order') }}:</strong> {{ $model->sort_order }}</p>
                    <p class="mb-2"><strong>{{ __('dashboard.created_at') }}:</strong> {{ $model->created_at?->format('Y-m-d H:i') }}</p>
                </div>
            </div>
            <hr>
            <x-admin.translatable-show
                :model="$model"
                :fields="['title', 'description']"
                header-field="title"
                :edit-route="route($editRoute, $model->id)"
                :back-route="$route"
                icon="bx-video"
            />
        </div>
    </div>
</div>
@endsection
