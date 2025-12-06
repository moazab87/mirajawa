<div class="table-responsive">
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>@lang('admin.name')</th>
                <th>@lang('admin.status')</th>
                <th>@lang('admin.start_date')</th>
                <th>@lang('admin.end_date')</th>
            </tr>
        </thead>
        <tbody>D
            @forelse($model->projects as $project)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $project->name }}</td>
                    <td>
                        <x-badge :color="$project->status->color()">
                            {{ $project->status->label() }}
                        </x-badge>
                    </td>
                    <td>{{ $project->start_date?->format('Y-m-d') ?? '-' }}</td>
                    <td>{{ $project->end_date?->format('Y-m-d') ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="bx bx-briefcase text-secondary mb-2" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">
                                {{ __('admin.no_data_available') ?? 'No data available' }}</h5>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
