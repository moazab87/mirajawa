@php
    use Carbon\Carbon;
@endphp
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
            __('admin.title'),
            __('admin.project'),
            __('admin.status'),
            __('admin.priority'),
            __('admin.assignee'),
            __('admin.due_date'),
            __('admin.actions'),
        ]" :createRoute=$createRoute :title=$title :buttonText="__('admin.add')" :search=true
            :indexRoute=$route>

            @forelse ($models as $model)
                <tr class="delete_row">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $model->title }}</td>
                    <td>
                        @if ($model?->project)
                            <div class="d-flex flex-column">
                                <a href="{{ route('admin.projects.show', $model->project->id) }}" class="fw-semibold">
                                    {{ $model->project->name }}
                                </a>
                                @if ($model->project->client)
                                    <a href="{{ route('admin.clients.show', $model->project->client->id) }}" class="text-muted small mt-1">
                                        <i class="bx bx-user me-1"></i> {{ $model->project->client->name }}
                                    </a>
                                @endif
                            </div>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <x-badge :color="$model->status->color()">
                            {{ $model->status->label() }}
                        </x-badge>
                    </td>

                    <td>
                        <x-badge :color="$model->priority->color()">
                            {{ $model->priority->label() }}
                        </x-badge>
                    </td>

                    <td>{{ $model?->assignee?->name ?? __('admin.not_assigned') }}</td>
                    <td>{{ $model->due_date ? Carbon::parse($model->due_date)->format('Y-m-d') : '-' }}</td>

                    <td>
                        <x-admin.buttons editRoute="{{ route($editRoute, [$singleName => $model->id]) }}"
                            deleteRoute="{{ route($deleteRoute, [$singleName => $model->id]) }}"
                            showRoute="{{ route($showRoute, [$singleName => $model->id]) }}" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="bx bx-task text-secondary mb-2" style="font-size: 3rem;"></i>
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
