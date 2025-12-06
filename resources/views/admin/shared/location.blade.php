<script
    src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyB4fYmF8tMMXR4NQTmITpAuauE7hMIxWIg&libraries=places">
</script>

<script>
    google.maps.event.addDomListener(window, 'load', initialize);

    function initialize() {
        var input           = document.getElementById('address');
        var autocomplete    = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            // place variable will have all the information you are looking for.

            document.getElementById("latitude").value   = place.geometry['location'].lat();
            document.getElementById("longitude").value  = place.geometry['location'].lng();
        });
    }
    $('[href="#finish"]').click(function() {
        $('#branchForm').submit();
    })
</script>
