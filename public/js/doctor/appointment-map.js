// Initialize and add the map

let map, directionsService, directionsRenderer, marker;

async function initMap() {
    // The location of Uluru
    const position = { lat: parseFloat($('#appointment_lat').val()), lng: parseFloat($('#appointment_lng').val()) };
    // Request needed libraries.
    //@ts-ignore
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    // The map, centered at Uluru
    map = new Map(document.getElementById("client_location"), {
        zoom: 18,
        center: position,
        mapId: "DEMO_MAP_ID",
    });

    // The marker, positioned at Uluru
    marker = new AdvancedMarkerElement({
        map: map,
        position: position,
        title: "Client",
    });

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer() 
}
initMap();

function calcRoute(startLat, startLng) {
    let start = new google.maps.LatLng(startLat,startLng);//define start point
    let end = new google.maps.LatLng(
        parseFloat($('#appointment_lat').val()), parseFloat($('#appointment_lng').val())
    );//define end point

    let request = {
        origin: start,
        destination: end,
        travelMode: 'DRIVING',
    }

    directionsService.route(request, function(result, status) { 
    if (status == google.maps.DirectionsStatus.OK) {  
            directionsRenderer.setMap(map);
            directionsRenderer.setDirections(result);  
        }
    });
    // map.setCenter(marker.getPosition()); // center the map on the marker
    // map.setZoom(18); // adjust zoom as needed

    // make the map follow the marker
    setInterval(function() {
    // marker.setPosition(new google.maps.LatLng(startLat, startLng));
    // map.setCenter(marker.getPosition());
    }, 1000); // update the marker position and map center every secondmap.setCenter(marker.getPosition()); // center the map on the marker
    map.setZoom(18); // adjust zoom as needed

    // make the map follow the marker
    // setInterval(function() {
    // marker.setPosition(new google.maps.LatLng(startLat, startLat));
    // map.setCenter(marker.getPosition());
    // }, 7000); // update the marker position and map center every second
}

function showPosition(position) {
    // Get latitude and longitude values from the position object
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;
    $('#current_location_lat').val(latitude)
    $('#current_location_lng').val(longitude)
}

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(showPosition,showError);
    // navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    console.log("Geolocation is not supported by this browser.");
  }
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

$('.go_to_direction').on('click', function() {
    window.open(`https://www.google.com/maps/dir/?api=1&destination=${parseFloat($('#appointment_lat').val())},${parseFloat($('#appointment_lng').val())}`, '_blank')
})