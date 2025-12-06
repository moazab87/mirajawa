<script>
    $(document).ready(function() {
        $('.form-check-input, .nav-search-field, .js-range-slider , .select-category').on('change keyup', function() {
            applyFilters();
        });

         function applyFilters() {
            const searchQuery = $('#query-search-autocomplete').val();

            const starRating = [];
            $('.form-check-input:checked').each(function() {
                starRating.push($(this).val());
            });

            const priceRange = $('.js-range-slider').val();
            const minPrice = priceRange.split(';')[0];
            const maxPrice = priceRange.split(';')[1];

            const category = $('#food-options').val();

            const url = $('#filterForm').attr('action');
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    search: searchQuery,
                    rating: starRating,
                    minPrice: minPrice,
                    maxPrice: maxPrice,
                    category: category,
                },
                success: function(response) {
                    if (response.items) {
                        // Update the products container
                        $('#products-container').html(response.items);
                        $('.productCount').html(
                            `@lang('website.showing') ${response.firstItem}-${response.lastItem} @lang('website.of') ${response.total} @lang('website.results')`
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

         }
    });
</script>
