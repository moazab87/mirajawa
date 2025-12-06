

<!-- Warehouses Statistics -->
<div class="col-lg-4 col-12 mb-4">
    <a href="{{ route('admin.warehouses.index') }}" class="text-decoration-none text-dark">
        <div class="card">
            <div class="card-body text-center">
                <div class="avatar mx-auto mb-2">
                    <span class="avatar-initial rounded-circle bg-label-danger">
                        <i class="bx bx-building fs-4"></i>
                    </span>
                </div>
                <span class="d-block text-nowrap">@lang('route.warehouses.index')</span>
                <h2 class="mb-0">{{ $tasksCount }}</h2>
            </div>
        </div>
    </a>
</div>
<!-- Warehouses Statistics -->
<div class="col-lg-4 col-12 mb-4">
    <a href="{{ route('admin.shipments.index') }}" class="text-decoration-none text-dark">
        <div class="card">
            <div class="card-body text-center">
                <div class="avatar mx-auto mb-2">
                    <span class="avatar-initial rounded-circle bg-label-danger">
                        <i class="bx bx-package fs-4"></i>
                    </span>
                </div>
                <span class="d-block text-nowrap">@lang('route.shipments.index')</span>
                <h2 class="mb-0">{{ $projectsCount }}</h2>
            </div>
        </div>
    </a>
</div>
