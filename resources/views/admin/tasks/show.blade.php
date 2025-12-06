<!-- show.blade.php -->
@extends('admin.layouts.app')
@section('title', $title)
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <x-admin.breadcrumb :links="[
            ['url' => route('admin.admin.index'), 'text' => __('admin.AdminPanel')],
            ['url' => $route, 'text' => $title],
            ['url' => '#', 'text' => __('admin.show')],
        ]" />

        <div class="row">
            <!-- Left Column: Task Details -->
            <div class="col-xl-7 col-lg-6 col-md-12 order-1 order-lg-0">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $model->title }}</h5>
                        <div>
                            <a href="{{ route('admin.tasks.edit', $model->id) }}" class="btn btn-primary btn-sm">
                                <i class="bx bx-edit-alt me-1"></i> {{ __('admin.edit') }}
                            </a>
                            <a href="{{ $route }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bx bx-arrow-back me-1"></i> {{ __('admin.back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <small class="text-muted text-uppercase">{{ __('admin.description') }}</small>
                                <p class="mt-2">{{ $model->description ?? __('admin.no_description') }}</p>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <small class="text-muted text-uppercase">{{ __('admin.project') }}</small>
                                <p class="fw-bold mt-1">{{ $model->project->name ?? '-' }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <small class="text-muted text-uppercase">{{ __('admin.client') }}</small>
                                <p class="fw-bold mt-1">{{ $model->project?->client?->name ?? '-' }}</p>
                            </div>

                            <div class="col-md-4 mb-3">
                                <small class="text-muted text-uppercase">{{ __('admin.parent_task') }}</small>
                                <p class="fw-bold mt-1">
                                    @if($model->parent)
                                        <a href="{{ route('admin.tasks.show', $model->parent_id) }}">
                                            {{ $model->parent->title }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subtasks (if any) -->
                @if($model->children->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ __('admin.subtasks') }}</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('admin.title') }}</th>
                                    <th>{{ __('admin.status') }}</th>
                                    <th>{{ __('admin.assignee') }}</th>
                                    <th>{{ __('admin.due_date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($model->children as $child)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.tasks.show', $child->id) }}">{{ $child->title }}</a>
                                    </td>
                                    <td>
                                        <x-badge :color="$child->status->color()">
                                            {{ $child->status->label() }}
                                        </x-badge>
                                    </td>
                                    <td>{{ $child->assignee->name ?? '-' }}</td>
                                    <td>{{ $child->due_date ? $child->due_date->format('Y-m-d') : '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Meta Info -->
            <div class="col-xl-5 col-lg-6 col-md-12 order-0 order-lg-1">
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title mb-3">{{ __('admin.details') }}</h6>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">{{ __('admin.status') }}</span>
                            <x-badge :color="$model->status->color()">
                                {{ $model->status->label() }}
                            </x-badge>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">{{ __('admin.priority') }}</span>
                            <x-badge :color="$model->priority->color()">
                                {{ $model->priority->label() }}
                            </x-badge>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">{{ __('admin.assignee') }}</span>
                            <div class="d-flex align-items-center">
                                @if($model->assignee)
                                    <div class="avatar avatar-xs me-2">
                                        <img src="{{ $model->assignee->image }}" alt="Avatar" class="rounded-circle">
                                    </div>
                                    <span class="fw-semibold">{{ $model->assignee->name }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">{{ __('admin.reporter') }}</span>
                            <div class="d-flex align-items-center">
                                @if($model->reporter)
                                    <div class="avatar avatar-xs me-2">
                                        <img src="{{ $model->reporter->image }}" alt="Avatar" class="rounded-circle">
                                    </div>
                                    <span class="fw-semibold">{{ $model->reporter->name }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <span class="text-muted d-block mb-1">{{ __('admin.start_date') }}</span>
                            <span class="fw-semibold">{{ $model->start_date ? $model->start_date->format('Y-m-d') : '-' }}</span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted d-block mb-1">{{ __('admin.due_date') }}</span>
                            <span class="fw-semibold {{ $model->due_date && $model->due_date->isPast() && $model->status != \App\Enums\TaskStatusTypeEnum::DONE ? 'text-danger' : '' }}">
                                {{ $model->due_date ? $model->due_date->format('Y-m-d') : '-' }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted d-block mb-1">{{ __('admin.estimated_hours') }}</span>
                            <span class="fw-semibold">{{ $model->estimated_hours ?? 0 }} {{ __('admin.h') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
