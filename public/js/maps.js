$('#address-a').on('click', function (e) {
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

$('#choose_location').on('click', function () {
  $('.ways').addClass('animate__animated  animate__backOutUp').fadeOut()
  setTimeout(() => {
    $('.autocomplete-map').addClass('animate__animated  animate__zoomInUp').fadeIn()    
  }, 200);
})

// autocomplete
let addressLat;
let addressLng;
function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -33.8882727, lng: 151.1921473 },
    zoom: 13,
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
    map,
    anchorPoint: new google.maps.Point(0, -29),
  });

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

  biasInputElement.addEventListener("change", () => {
    if (biasInputElement.checked) {
      autocomplete.bindTo("bounds", map);
    } else {
      // User wants to turn off location bias, so three things need to happen:
      // 1. Unbind from map
      // 2. Reset the bounds to whole world
      // 3. Uncheck the strict bounds checkbox UI (which also disables strict bounds)
      autocomplete.unbind("bounds");
      autocomplete.setBounds({ east: 180, west: -180, north: 90, south: -90 });
      strictBoundsInputElement.checked = biasInputElement.checked;
    }

    input.value = "";
  });
  // strictBoundsInputElement.addEventListener("change", () => {
  //   autocomplete.setOptions({
  //     strictBounds: strictBoundsInputElement.checked,
  //   });
  //   if (strictBoundsInputElement.checked) {
  //     biasInputElement.checked = strictBoundsInputElement.checked;
  //     autocomplete.bindTo("bounds", map);
  //   }

  //   input.value = "";
  // });
}
window.initMap = initMap;
// end ...

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
