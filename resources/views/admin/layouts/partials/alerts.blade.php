@if (session('success'))
    <div class="alert alert-solid-success alert-dismissible d-flex align-items-center" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(function() {
            $('.alert-solid-success').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 3000); // Auto dismiss after 5 seconds
    </script>
@endif
@if ($errors->any())
    <div class="alert alert-solid-danger alert-dismissible d-flex align-items-center" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(function() {
            $('.alert-solid-danger').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 3000); // Auto dismiss after 5 seconds
    </script>
@endif
