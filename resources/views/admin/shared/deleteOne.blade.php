<script>
    $(document).on('click', '.delete-row', function (e) {
        e.preventDefault();
        const $row = $(this);
        Swal.fire({
            title: "{{ __('dashboard.confirm') }}",
            text: "{{ __('dashboard.delete_confirmation') }}",
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ __('dashboard.confirm') }}',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonText: '{{ __('dashboard.cancel') }}',
            cancelButtonClass: 'btn btn-danger ml-1',
            buttonsStyling: false,
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'delete',
                    url: $row.data('url'),
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: 'json',
                    success: function () {
                        toastr.success("{{ __('dashboard.deleted_successfully') }}");
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: '{{ __('dashboard.the_selected_has_been_successfully_deleted') }}',
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        });
                        $row.closest('tr').remove();
                    },
                    error: function () {
                        toastr.error("{{ __('dashboard.error_occurred') }}");
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: '{{ __('dashboard.messages.error') }}',
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        });
                    }
                });
            }
        });
    });
</script>
