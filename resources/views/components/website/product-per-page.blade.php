<script>
    $(document).ready(function() {
        $('#perPageSelect').on('change', function() {
            const perPage = $(this).val(); // Get the selected value
            // Show a loading state (optional)
            $('#products-container').html(
                '<p><i class="fa fa-spinner fa-spin"></i> @lang('website.loading_products')</p>');

            // Send an AJAX request to fetch products
            $.ajax({
                url: "{{ route('web.category.show', $category) }}", // Correct route
                type: 'GET',
                data: {
                    perPage: perPage,
                },
                success: function(response) {
                    if (response.products) {
                        // Update the products container
                        $('#products-container').html(response.products);
                        $('#productCount').html(
                            `@lang('website.showing') ${response[0]}-${response[1]} @lang('website.of') ${response[2]} @lang('website.results')`
                        );
                    }
                    // Optional: Update other UI elements if necessary (like pagination)
                    if (response.pagination) {
                        $('#pagination-links').html(response.pagination);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading products:', error);
                    // Show an error message to the user
                    $('#products-container').html(
                        '<p>Failed to load products. Please try again later.</p>');
                },
            });
        });
    });
</script>
