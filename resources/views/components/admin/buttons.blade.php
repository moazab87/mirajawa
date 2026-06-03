<div class="d-inline-flex align-items-center gap-1 flex-nowrap dash-table-actions">

    @if(isset($showRoute))
        <button type="button" class="btn btn-icon dash-btn-icon btn-label-secondary" onclick="location.href='{{ $showRoute }}'"
            title="{{ __('dashboard.show') }}" aria-label="{{ __('dashboard.show') }}">
            <i class="bx bx-show"></i>
        </button>
    @endif

    @if(isset($editRoute))
        <button type="button" class="btn btn-icon dash-btn-icon btn-label-primary" onclick="location.href='{{ $editRoute }}'"
            title="{{ __('dashboard.edit') }}" aria-label="{{ __('dashboard.edit') }}">
            <i class="bx bx-edit-alt"></i>
        </button>
    @endif

    @if(isset($deleteRoute))
        <span class="delete-row btn btn-icon dash-btn-icon btn-label-danger" data-url="{{ $deleteRoute }}"
            style="cursor: pointer;" title="{{ __('dashboard.delete') }}" aria-label="{{ __('dashboard.delete') }}">
            <i class="bx bx-trash"></i>
        </span>
    @endif
</div>
