 <!DOCTYPE html>
    <html>
        <head>
        <title>Place Autocomplete With Latitude & Longitude </title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <style>
    #pac-input {
        background-color: #fff;
        padding: 0 11px 0 13px;
        width: 400px;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        text-overflow: ellipsis;
    }
    #pac-input:focus {
        border-color: #4d90fe;
        margin-left: -1px;
        padding-left: 14px;  /* Regular padding-left + 1. */
        width: 401px;
    }
    }
    </style>
         <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=[AIzaSyDGhGk3DTCkjF1EUxpMm5ypFoQ-ecrS2gY]"></script> 
        <script>
    
    
      function initialize() {
            var address = (document.getElementById('pac-input'));
            var autocomplete = new google.maps.places.Autocomplete(address);
            autocomplete.setTypes(['geocode']);
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }
    
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
            }
            /*********************************************************************/
            /* var address contain your autocomplete address *********************/
            /* place.geometry.location.lat() && place.geometry.location.lat() ****/
            /* will be used for current address latitude and longitude************/
            /*********************************************************************/
            document.getElementById('lat').innerHTML = place.geometry.location.lat();
            document.getElementById('long').innerHTML = place.geometry.location.lng();
            });
      }
    
       google.maps.event.addDomListener(window, 'load', initialize);
    
        </script>
        </head>
        <body>
    <input id="pac-input" class="controls" type="text"
            placeholder="Enter a location">
    <div id="lat"></div>
    <div id="long"></div>
    </body>
    </html>