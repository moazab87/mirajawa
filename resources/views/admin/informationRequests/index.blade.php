@extends('admin.layouts.app')
@section('title', $title)
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <x-admin.breadcrumb :links="[
        ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
        ['url' => '#', 'text' => $title],
    ]" />
    <form method="GET" class="mb-3 row g-2">
        <div class="col-md-4">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">{{ __('dashboard.all_statuses') }}</option>
                @foreach($statuses as $statusCase)
                    <option value="{{ $statusCase->value }}" {{ request('status') === (string)$statusCase->value ? 'selected' : '' }}>{{ $statusCase->label() }}</option>
                @endforeach
            </select>
        </div>
    </form>
    <x-admin.table :headers="['#', __('dashboard.name'), __('dashboard.email'), __('dashboard.status'), __('dashboard.actions')]" :title="$title" :search="true" :indexRoute="$route">
        @forelse($models as $model)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $model->name }}</td>
                <td>{{ $model->email }}</td>
                <td><x-admin.status-badge :status="$model->status" /></td>
                <td>
                    <a href="{{ route($showRoute, $model->id) }}" class="btn btn-sm btn-info">{{ __('dashboard.show') }}</a>
                    <x-admin.buttons :editRoute="null" :showRoute="null" :deleteRoute="route($deleteRoute, $model->id)" />
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center py-4">{{ __('dashboard.no_data_available') }}</td></tr>
        @endforelse
    </x-admin.table>
</div>
@if ($models->count() > 0)
<div class="d-flex justify-content-center my-2">{{ $models->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}</div>
@endif
@endsection
