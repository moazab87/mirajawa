@extends('admin.layouts.app')

@section('title', $title)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => '#', 'text' => $title],
        ]" />

        <x-admin.table :headers="['#', __('admin.name'), __('admin.content'), __('admin.actions')]" :createRoute="$createRoute" :title="$title" :buttonText="__('admin.add')"
            :search="true" :indexRoute="$route">

            @forelse($models as $model)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span class="badge me-1"
                            style="background-color: {{ $model->color }}; width: 10px; height: 10px; display: inline-block; border-radius: 50%;"></span>
                        {{ $model->name }}
                    </td>
                    <td>{{ $model->content }}</td>
                    <td>
                        <x-admin.buttons :editRoute="route($editRoute, $model->id)" :deleteRoute="route($deleteRoute, $model->id)" :showRoute="route($showRoute, $model->id)" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="bx bx-folder-open text-secondary mb-2" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">
                                {{ __('admin.no_data_available') ?? 'No data available' }}</h5>
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
