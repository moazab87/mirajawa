@if (config('services.google_maps.key'))
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places"></script>
<script>
    google.maps.event.addDomListener(window, 'load', initialize);

    function initialize() {
        var input = document.getElementById('address');
        if (!input) return;
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) return;
            var latEl = document.getElementById('latitude');
            var lngEl = document.getElementById('longitude');
            if (latEl) latEl.value = place.geometry.location.lat();
            if (lngEl) lngEl.value = place.geometry.location.lng();
        });
    }
</script>
@endif
