@extends('admin.layouts.app')

@section('title', $title)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
            ['url' => '#', 'text' => $title],
        ]" />

        <x-admin.table :headers="['#', __('dashboard.name'), __('dashboard.color'), __('dashboard.status'), __('dashboard.actions')]" :createRoute="$createRoute" :title="$title" :buttonText="__('dashboard.add')"
            :search="true" :indexRoute="$route">

            @forelse($models as $model)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($model->color)
                            <span class="badge me-1" style="background-color: {{ $model->color }}; width: 10px; height: 10px; display: inline-block; border-radius: 50%;"></span>
                        @endif
                        {{ $model->getDisplayTranslation('name') }}
                    </td>
                    <td>{{ $model->color ?? '—' }}</td>
                    <td><x-admin.status-badge :status="$model->status" /></td>
                    <td>
                        <x-admin.buttons :editRoute="route($editRoute, $model->id)" :deleteRoute="route($deleteRoute, $model->id)" :showRoute="route($showRoute, $model->id)" />
                    </td>
                </tr>
            @empty
                <tr class="dash-empty-state">
                    <td colspan="5">
                        <i class="bx bx-data"></i>
                        {{ __('dashboard.no_data_available') }}
                    </td>
                </tr>
            @endforelse
        </x-admin.table>
    </div>
    @if ($models->count() > 0 && $models instanceof \Illuminate\Pagination\AbstractPaginator)
        <div class="d-flex justify-content-center my-3">
            {{ $models->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    @endif
@endsection
