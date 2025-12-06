<div>
    <script>
        $(document).ready(function() {
            $('.store-form').submit(function(e) {
                e.preventDefault();
                var form = $(this);

                var url = form.attr('action');
                var type = form.attr('method');
                var data = new FormData(this);
                // get value from submit_button
                var submit_button = $(".submit_button").html();

                data.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    url: url,
                    type: type,
                    data: data,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(".submit_button").html('<i class="fas fa-spinner"></i>').attr('disables', true);
                    },
                    success: function(response) {
                        if (response.status) {
                            toastr.success(response.message)
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        $(".submit_button").html(submit_button).attr('disable', false)
                        $(".text-danger").remove()
                        $('.store-form input').removeClass('border-danger')

                        $.each(xhr.responseJSON.errors, function(key, value) {
                            toastr.error(value);
                            $('.store-form input[name=' + key + ']').addClass(
                                'border-danger mb-1')
                            $('.store-form input[name=' + key + ']').after(
                                `<span class="text-danger">${value}</span>`);
                        });
                    },
                });
            });
        });
    </script>
</div>
