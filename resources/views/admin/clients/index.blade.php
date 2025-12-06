@extends('admin.layouts.app')

@section('title', $title)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => $route, 'text' => $title],
        ]" />
        <x-admin.table :headers="[
            '#',
            __('admin.name'),
            __('admin.email'),
            __('admin.phone'),
            __('admin.account_manager'),
            __('admin.actions'),
        ]" :createRoute=$createRoute :title=$title :buttonText="__('admin.add')" :search=true
            :indexRoute=$route
        >

            @forelse ($models as $model)
                <tr class="delete_row">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $model->name }}</td>
                    <td>{{ $model->email }}</td>
                    <td>{{ $model->phone }}</td>
                    <td>{{ $model->accountManager->name ?? '-' }}</td>

                    <td>
                        <x-admin.buttons editRoute="{{ route($editRoute, [$singleName => $model->id]) }}"
                            deleteRoute="{{ route($deleteRoute, [$singleName => $model->id]) }}"
                            showRoute="{{ route($showRoute, [$singleName => $model->id]) }}" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="bx bx-folder-open text-secondary mb-2" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">{{ __('admin.no_data_available') ?? 'No data available' }}</h5>
                            <p class="text-muted small">
                                {{ __('admin.add_new_record') ?? 'Add a new record to get started' }}</p>
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
