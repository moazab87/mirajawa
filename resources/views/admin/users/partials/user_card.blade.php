<div class="card mb-4" id="customerDetails" data-user-id="{{ $model->id }}" data-lang="{{ app()->getLocale() }}">
    <div class="card-body">
        <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
                <img class="img-fluid rounded my-4" src="{{ $model->image }}" height="110" width="110"
                    alt="User avatar" />
                <div class="user-info text-center">
                    <h5 class="mb-2">{{ $model->name }}</h5>
                    <span class="badge bg-label-secondary">User ID #{{ $model->id }}</span>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-around flex-wrap my-4 py-3">
            <div class="d-flex align-items-start me-4 mt-3 gap-3">
                <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-group bx-sm"></i></span>
                <div>
                    <h5 class="mb-0">{{ $model->teams->count() }}</h5>
                    <span>@lang('admin.teams')</span>
                </div>
            </div>
            <div class="d-flex align-items-start me-4 mt-3 gap-3">
                <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-task bx-sm"></i></span>
                <div>
                    <h5 class="mb-0">{{ $model->assignedTasks->count() }}</h5>
                    <span>@lang('admin.tasks')</span>
                </div>
            </div>
        </div>
        <h5 class="pb-2 border-bottom mb-4">@lang('admin.details')</h5>
        <div class="info-container">
            <ul class="list-unstyled">
                <li class="mb-3">
                    <span class="fw-bold me-2">@lang('admin.name')</span>
                    <span>{{ $model->name }}</span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold me-2">@lang('admin.phone')</span>
                    <span>{{ $model->phone }}</span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold me-2">@lang('admin.email')</span>
                    <span>{{ $model->email }}</span>
                </li>

                <li class="mb-3">
                    <span class="fw-bold me-2">@lang('admin.status')</span>
                    <x-badge :color="$model->status->color()">
                        {{ $model->status->label() }}
                    </x-badge>
                </li>
            </ul>
            <div class="d-flex justify-content-center pt-3">
                <a href="{{ route('admin.users.edit', $model->id) }}" class="btn btn-primary me-3">
                    <i class="bx bx-edit me-2"></i>@lang('admin.edit_user')
                </a>
                <a href="{{ $route }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back me-2"></i>@lang('admin.back')
                </a>
            </div>
        </div>
    </div>
</div>
