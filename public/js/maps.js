$('#address-a, #old_address, #edit-address').on('click', function (e) {
    e.preventDefault();
    $('.address-pop-up').fadeIn().css('display', 'flex');
    $('.hide-content').fadeIn()
})

$('.address-pop-up .cancel').on('click', function () {
    $('.address-pop-up').fadeOut();
    $('.hide-content').fadeOut()
    setTimeout(() => {
    
      $('.autocomplete-map').fadeOut()    
      $('.ways').fadeIn()    
      $('.ways').removeClass('animate__animated  animate__backOutUp')    
    }, 200);

})

$('#choose_location, #enable-location-access').on('click', function () {
  $('.ways').addClass('animate__animated  animate__backOutUp').fadeOut()
  setTimeout(() => {
    $('.autocomplete-map').addClass('animate__animated  animate__zoomInUp').fadeIn()    
  }, 200);
})

// // autocomplete
// let addressLat;
// let addressLng;
// let currentLat = null;
// let currentLng = null;
function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -33.8882727 , lng: 151.1921473 },
    zoom: 15,
    mapTypeControl: false,
  });
  const card = document.getElementById("pac-card");
  const input = document.getElementById("pac-input");
  const biasInputElement = document.getElementById("use-location-bias");
  const strictBoundsInputElement = document.getElementById("use-strict-bounds");
  const options = {
    fields: ["formatted_address", "geometry", "name"],
    strictBounds: false,
    types: ["establishment"],
  };

  map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

  const autocomplete = new google.maps.places.Autocomplete(input, options);

  // Bind the map's bounds (viewport) property to the autocomplete object,
  // so that the autocomplete requests use the current map bounds for the
  // bounds option in the request.
  autocomplete.bindTo("bounds", map);

  const infowindow = new google.maps.InfoWindow();
  const infowindowContent = document.getElementById("infowindow-content");

  infowindow.setContent(infowindowContent);

  const marker = new google.maps.Marker({
    draggable: true,
    animation: google.maps.Animation.DROP, 
    map,
    anchorPoint: new google.maps.Point(0, -29),
  });

  geocodePosition(marker.getPosition())

  google.maps.event.addListener(marker, 'dragend', function () {
    map.setCenter(marker.getPosition())
    geocodePosition(marker.getPosition())
    addressLat = marker.getPosition().lat()
    addressLng = marker.getPosition().lng()
  })


  autocomplete.addListener("place_changed", () => {
    infowindow.close();
    marker.setVisible(false);

    const place = autocomplete.getPlace();
    let lat = place.geometry.location.lat()
    let lng = place.geometry.location.lng()
    addressLat = lat;
    addressLng = lng;

    if (!place.geometry || !place.geometry.location) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);
    }

    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
    infowindowContent.children["place-name"].textContent = place.name;
    infowindowContent.children["place-address"].textContent =
      place.formatted_address;
    infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
    window.onload = function() {
        autocomplete.setTypes(["address"]);
    };

    $('#enable-location-access').on('click', function() {
        $('#pac-input').val('')
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            function showPosition(position) {
                let currentLatitude = position.coords.latitude;
                let currentLongitude = position.coords.longitude;
                addressLat = currentLatitude;
                addressLng = currentLongitude;
                let current = new google.maps.LatLng(currentLatitude, currentLongitude)
                map.setCenter(current);
                map.setZoom(18);
                marker.setPosition(current);
                marker.setVisible(true);
                infowindow.open(map, marker);
                geocodePosition(marker.getPosition())
            }
            ,showError
          );
          // navigator.geolocation.getCurrentPosition(showPosition);
        } else {
          console.log("Geolocation is not supported by this browser.");
        }
        geocodePosition(marker.getPosition())
    })

}
// window.initMap = initMap;
// end ...
function geocodePosition(pos) {
  geocoder = new google.maps.Geocoder()
  geocoder.geocode({
    latLng: pos
  },
  function (results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      $('#place-address').text(results[0].formatted_address)
      $('#place-name').text(results[0].formatted_address.split(',')[0])
    }else {
      
    }
  }
  )
}

$('.confirm').on('click', function (e) {
  e.preventDefault()
  if (addressLat && addressLng) {
    $('.address-pop-up').fadeOut();
    $('.hide-content').fadeOut()
    $('#address_lat').val(addressLat)
    $('#address_lng').val(addressLng)
    $('#address').val($('#place-address').text())
    $('#address-a').text($('#place-address').text())
  } else {
    document.getElementById('errors').innerHTML = ''
    let error = document.createElement('div')
    error.classList = 'alert alert-danger'
    error.innerHTML = 'Please pick your address !'
    document.getElementById('errors').append(error)
    $('#errors').fadeIn('slow')
    setTimeout(() => {
      $('#errors').fadeOut('slow')
    }, 2500);
  }
})


function getLocation() {
}

function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      console.log("User denied the request for Geolocation.")
      break;
    case error.POSITION_UNAVAILABLE:
      console.log("Location information is unavailable.")
      break;
    case error.TIMEOUT:
      console.log("The request to get user location timed out.")
      break;
    case error.UNKNOWN_ERROR:
      console.log("An unknown error occurred.")
      break;
  }
}

