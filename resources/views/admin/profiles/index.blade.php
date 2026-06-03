@extends('admin.layouts.app')
@section('title', $title)
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <x-admin.breadcrumb :links="[
        ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
        ['url' => '#', 'text' => $title],
    ]" />
    <x-admin.table :headers="['#', __('dashboard.name'), __('dashboard.status'), __('dashboard.actions')]" :createRoute="$createRoute" :title="$title" :buttonText="__('dashboard.add')" :search="true" :indexRoute="$route">
        @forelse($models as $model)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $model->getDisplayTranslation('name') }}</td>
                <td><x-admin.status-badge :status="$model->status" /></td>
                <td><x-admin.buttons :editRoute="route($editRoute, $model->id)" :deleteRoute="route($deleteRoute, $model->id)" :showRoute="route($showRoute, $model->id)" /></td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center py-4">{{ __('dashboard.no_data_available') }}</td></tr>
        @endforelse
    </x-admin.table>
</div>
@if ($models->count() > 0)
<div class="d-flex justify-content-center my-2">{{ $models->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}</div>
@endif
@endsection
