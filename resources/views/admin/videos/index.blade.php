@extends('admin.layouts.app')
@section('title', $title)
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <x-admin.breadcrumb :links="[
        ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
        ['url' => '#', 'text' => $title],
    ]" />
    <x-admin.table :headers="['#', __('dashboard.video_preview'), __('dashboard.title'), __('dashboard.status'), __('dashboard.sort_order'), __('dashboard.created_at'), __('dashboard.actions')]" :createRoute="$createRoute" :title="$title" :buttonText="__('dashboard.add_video')" :search="true" :indexRoute="$route">
        @forelse($models as $model)
            <tr>
                <td>{{ $loop->iteration + ($models->currentPage() - 1) * $models->perPage() }}</td>
                <td>
                    @if($model->video_url)
                        <video class="mj-admin-video-preview" muted playsinline preload="metadata" controls>
                            <source src="{{ $model->video_url }}" type="{{ $model->video_mime }}">
                        </video>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td>{{ $model->getDisplayTranslation('title') ?: '—' }}</td>
                <td><x-admin.status-badge :status="$model->status" /></td>
                <td>{{ $model->sort_order }}</td>
                <td>{{ $model->created_at?->format('Y-m-d') }}</td>
                <td><x-admin.buttons :editRoute="route($editRoute, $model->id)" :deleteRoute="route($deleteRoute, $model->id)" :showRoute="route($showRoute, $model->id)" /></td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center py-4">{{ __('dashboard.no_data_available') }}</td></tr>
        @endforelse
    </x-admin.table>
</div>
@if ($models->count() > 0)
<div class="d-flex justify-content-center my-2">{{ $models->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}</div>
@endif
@endsection
