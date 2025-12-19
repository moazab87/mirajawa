<script>
    $(document).on('click' , '.delete-row', function (e) {
        e.preventDefault()
        Swal.fire({
            title: "{{__('admin.confirm')}}",
            text: "{{__('admin.delete_confirmation')}}",
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{__('admin.confirm')}}',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonText: '{{__('admin.cancel')}}',
            cancelButtonClass: 'btn btn-danger ml-1',
            buttonsStyling: false,
            }).then( (result) => {
            if (result.value) {
                $.ajax({
                    type: 'delete',
                    mehtod: 'delete',
                    url: $(this).data('url'),
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success:  (response) => {
                        toastr.success("{{ __('admin.deleted_successfully') }}")
                        Swal.fire(
                        {
                            position: 'center',
                            icon: 'success',
                            title: '{{__('admin.the_selected_has_been_successfully_deleted')}}',
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        });
                        $(this).closest('tr').remove();
                    },
                    error: (error) => {
                        toastr.error("{{ __('admin.error_occurred') }}")
                        Swal.fire(
                        {
                            position: 'center',
                            icon: 'error',
                            title: '{{__('admin.error')}}',
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        });
                    }
                });
            }
        })
    });
</script>
