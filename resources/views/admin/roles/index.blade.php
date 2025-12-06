@extends('admin.layouts.app')

@section('title', $title)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => '#', 'text' => $title],
        ]" />

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $title }}</h5>
                <div class="d-flex">
                    <a href="{{ $createRoute }}" class="btn btn-primary">{{ __('admin.add') }}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('admin.name') }}</th>
                                <th>{{ __('admin.created_at') }}</th>
                                <th>{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse($models as $model)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Str::limit($model->name, 20) }}</td>
                                    <td>{{ Carbon\Carbon::parse($model->created_at)->format('Y-m-d H:i A') }}</td>
                                    <td>
                                        @if ($model->name === 'super_admin')
                                            <span class="text-muted">{{ __('admin.no_actions_available') }}</span>
                                        @else
                                            <div class="dropdown position-static">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route($showRoute, $model->id) }}">
                                                        <i class="bx bx-show-alt me-1"></i> {{ __('admin.show') }}
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route($editRoute, $model->id) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> {{ __('admin.edit') }}
                                                    </a>
                                                    <a class="dropdown-item delete-row" href="javascript:void(0);"
                                                        data-id="{{ $model->id }}"
                                                        data-url="{{ route($deleteRoute, $model->id) }}">
                                                        <i class="bx bx-trash me-1"></i> {{ __('admin.delete') }}
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bx bx-folder-open text-secondary mb-2" style="font-size: 3rem;"></i>
                                            <h5 class="text-muted">
                                                {{ __('admin.no_data_available') ?? 'No data available' }}</h5>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if ($models->count() > 0 && $models instanceof \Illuminate\Pagination\AbstractPaginator)
        <div class="d-flex justify-content-center my-2">
            {{ $models->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    @endif
@endsection
