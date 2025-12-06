<div class="table-responsive">
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>@lang('admin.name')</th>
                <th>@lang('admin.members_count')</th>
                <th>@lang('admin.actions')</th>
            </tr>
        </thead>
        <tbody>
            @forelse($model->ownedTeams as $team)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span class="badge me-1"
                            style="background-color: {{ $team->color }}; width: 10px; height: 10px; display: inline-block; border-radius: 50%;"></span>
                        {{ $team->name }}
                    </td>
                    <td>
                        <span class="badge bg-label-info">{{ $team->members->count() }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.teams.show', $team->id) }}" class="btn btn-sm btn-icon item-edit">
                            <i class="bx bx-show"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="bx bx-group text-secondary mb-2" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">
                                {{ __('admin.no_data_available') ?? 'No data available' }}</h5>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
