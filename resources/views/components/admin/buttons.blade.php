<!-- admin-buttons.blade.php -->

<div class="d-inline-block text-nowrap">

    @if(isset($showRoute))
        <button type="button" class="btn btn-icon btn-label-secondary" onclick="location.href='{{ $showRoute }}'">
            <span class="tf-icons bx bx-show"></span>
        </button>
    @endif

    @if(isset($editRoute))
        <button type="button" class="btn btn-icon btn-label-primary" onclick="location.href='{{ $editRoute }}'">
            <span class="tf-icons bx bx-edit-alt"></span>
        </button>
    @endif
    <!-- Delete Form -->
    @if(isset($deleteRoute))
        <span class="delete-row btn btn-icon btn-label-danger" data-url="{{ $deleteRoute }}" style="cursor: pointer;">
            <i class="tf-icons bx bx-trash"></i>
        </span>
    @endif
</div>
