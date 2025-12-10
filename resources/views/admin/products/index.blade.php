@extends('admin.layouts.app')

@section('title', $title)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => '#', 'text' => $title],
        ]" />

        <x-admin.table :headers="['#', __('admin.name'), __('admin.category'), __('admin.link'), __('admin.actions')]" :createRoute="$createRoute" :title="$title" :buttonText="__('admin.add')"
            :search="true" :indexRoute="$route">

            @forelse($models as $model)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $model->name }}</td>
                    <td>{{ $model->category?->name ?? __('admin.not_assigned') }}</td>
                    <td>
                        @if($model->link)
                            <a href="{{ $model->link }}" target="_blank" class="text-primary">
                                <i class="bx bx-link-external"></i> {{ __('admin.view_link') }}
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
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

