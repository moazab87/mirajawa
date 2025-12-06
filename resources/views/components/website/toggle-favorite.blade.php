<div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.toggleFavorite', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('web.product.toggle-favorite') }}',
                    method: 'post',
                    data: {
                        product_id: $(this).data('id'),
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.key == 'success') {
                            if (response.data.is_fav) {
                                $('#favorite_' + response.data.product_id).css('color', 'red');
                            } else {
                                $('#favorite_' + response.data.product_id).css('color', '');
                            }
                        }
                        toastr.success(response.msg);
                    },
                    error: function(err) {
                        toastr.error(err.responseJSON.message);
                    }
                });

            });
        });
    </script>
</div>
