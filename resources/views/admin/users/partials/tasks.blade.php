<div class="table-responsive">
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>@lang('admin.title')</th>
                <th>@lang('admin.project')</th>
                <th>@lang('admin.status')</th>
                <th>@lang('admin.priority')</th>
                <th>@lang('admin.due_date')</th>
            </tr>
        </thead>
        <tbody>
            @forelse($model->assignedTasks as $task)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->project?->name ?? __('admin.not_assigned') }}</td>
                     <td>
                        <x-badge :color="$task->status->color()">
                            {{ $task->status->label() }}
                        </x-badge>
                    </td>
                      <td>
                        <x-badge :color="$task->priority->color()">
                            {{ $task->priority->label() }}
                        </x-badge>
                    </td>
                    <td>{{ $task->due_date?->format('Y-m-d') ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="bx bx-task text-secondary mb-2" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">
                                {{ __('admin.no_data_available') ?? 'No data available' }}</h5>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
