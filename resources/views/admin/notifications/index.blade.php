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
            __('admin.notification'),
            __('admin.body'),
            __('admin.date'),
            __('admin.actions'),
        ]" {{-- :route=$createRoute --}} :title=$title :buttonText="__('admin.add')">

            @forelse ($models as $model)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($model->data['url'])
                            <a href="{{ $model->data['url'] }}" >{{ $model->title }}</a>
                        @else
                        {{ $model->title }}
                        @endif
                    </td>
                    <td>
                        {{ $model->body }}
                    </td>
                    <td>{{ $model->created_at->format('Y-m-d') }}</td>
                    <td>
                        <x-admin.buttons
                            deleteRoute="{{ route($deleteRoute, [$singleName => $model->id]) }}"
                            />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">
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
            {{ $models->links('vendor.pagination.bootstrap-4') }}
        </div>
    @endif
@endsection

