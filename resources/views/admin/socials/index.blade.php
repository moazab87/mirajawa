@extends('admin.layouts.app')

@section('title', $title)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => '#', 'text' => $title],
        ]" />

        <x-admin.table :headers="['#', __('admin.name'), __('admin.url'), __('admin.icon'), __('admin.order'), __('admin.status'), __('admin.actions')]" :createRoute="$createRoute" :title="$title" :buttonText="__('admin.add')"
            :search="true" :indexRoute="$route">

            @forelse($models as $model)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $model->name }}</td>
                    <td>
                        <a href="{{ $model->url }}" target="_blank" class="text-primary">
                            <i class="bx bx-link-external"></i> {{ Str::limit($model->url, 40) }}
                        </a>
                    </td>
                    <td>
                        @if($model->icon)
                            <i class="{{ $model->icon }}" style="font-size: 1.5rem;"></i>
                            <small class="d-block text-muted">{{ $model->icon }}</small>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $model->order }}</td>
                    <td>
                        <span class="badge bg-{{ $model->is_active ? 'success' : 'secondary' }}">
                            {{ $model->is_active ? __('admin.active') : __('admin.inactive') }}
                        </span>
                    </td>
                    <td>
                        <x-admin.buttons :editRoute="route($editRoute, $model->id)" :deleteRoute="route($deleteRoute, $model->id)" :showRoute="route($showRoute, $model->id)" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="bx bx-folder-open text-secondary mb-2" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">{{ __('admin.no_data_available') ?? 'No data available' }}</h5>
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

@section('script')

@endsection


