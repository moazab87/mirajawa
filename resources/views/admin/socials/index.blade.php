@extends('admin.layouts.app')

@section('title', $title)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('dashboard.admin_panel')],
            ['url' => '#', 'text' => $title],
        ]" />

        <x-admin.table :headers="['#', __('dashboard.name'), __('dashboard.url'), __('dashboard.icon'), __('dashboard.status'), __('dashboard.actions')]" :createRoute="$createRoute" :title="$title" :buttonText="__('dashboard.add')"
            :search="true" :indexRoute="$route">

            @forelse($models as $model)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $model->name }}</td>
                    <td>
                        <a href="{{ $model->url }}" target="_blank" rel="noopener noreferrer" class="text-primary">
                            <i class="bx bx-link-external"></i> {{ Str::limit($model->url, 40) }}
                        </a>
                    </td>
                    <td>
                        @if($model->icon)
                            <div class="d-flex flex-column align-items-center gap-1">
                                <i class="{{ $model->icon }}" style="font-size: 1.375rem; line-height: 1;"></i>
                                <small class="text-muted">{{ $model->icon }}</small>
                            </div>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $model->is_active ? 'success' : 'secondary' }}">
                            {{ $model->is_active ? __('dashboard.statuses.active') : __('dashboard.statuses.inactive') }}
                        </span>
                    </td>
                    <td>
                        <x-admin.buttons :editRoute="route($editRoute, $model->id)" :deleteRoute="route($deleteRoute, $model->id)" :showRoute="route($showRoute, $model->id)" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="bx bx-folder-open text-secondary mb-2" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">{{ __('dashboard.no_data_available') }}</h5>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-admin.table>
    </div>
    @if ($models->count() > 0 && $models instanceof \Illuminate\Pagination\AbstractPaginator)
        <div class="d-flex justify-content-center my-2">
            {{ $models->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    @endif
@endsection
