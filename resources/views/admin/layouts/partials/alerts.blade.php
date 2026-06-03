@if (session('success'))
    <div class="alert alert-success alert-dismissible d-flex align-items-center dash-alert" role="alert">
        <i class="bx bx-check-circle me-2"></i>
        <span class="flex-grow-1">{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(function() {
            $('.dash-alert.alert-success').fadeOut('slow', function() { $(this).remove(); });
        }, 4000);
    </script>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible dash-alert" role="alert">
        <i class="bx bx-error-circle me-2"></i>
        <ul class="mb-0 flex-grow-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(function() {
            $('.dash-alert.alert-danger').fadeOut('slow', function() { $(this).remove(); });
        }, 6000);
    </script>
@endif
