<div>
    <script>
        $(document).ready(function() {
            $('.check-coupon').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                const coupon = $('input[name="coupon_num"]').val();
                const totalPrice = $('.total_price').data('total-price');
                const button = $(this);

                if (!coupon) {
                    alert("{{ __('website.enter_coupon_code') }}");
                    return;
                }

                $('input[name="coupon_num"]').removeClass('border-danger');
                $.ajax({
                    url: '{{ route('web.check-coupon') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        coupon_num: coupon
                    },
                    success: function(response) {
                        $('input[name="coupon_num"]').addClass('border-success').prop(
                            'readonly', true);
                        button.remove();
                        if (response.status) {
                            $('input[name="coupon_id"]').val(response.data.id);
                            $('.discount').text(response.data.discount + ' @lang('admin.rs')');
                            $('.total_price').text((totalPrice - response.data.discount) +
                                ' @lang('admin.rs')');
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(err) {
                        toastr.error(err.responseJSON.message);
                        for (let key in err.responseJSON.errors) {
                            $(`input[name='${key}']`).addClass('border-danger');
                        }
                    }
                });
            });
        });
    </script>
</div>
