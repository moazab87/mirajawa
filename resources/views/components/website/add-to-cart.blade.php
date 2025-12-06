<div>
   <script>
        $(document).ready(function() {
            $(document).on('click', '.add_cart', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('web.cart.store') }}',
                    method: 'post',
                    data: {
                        product_id: $(this).data('id'),
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        toastr.success(response.message);
                        $('#cart_count').text(response.data.cart.length);
                    },
                    error: function(err) {
                        toastr.error(err.responseJSON.message);
                    }
                });

            });
        });
    </script>
</div>
