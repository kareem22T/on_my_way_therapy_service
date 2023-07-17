// Initialize and add the map
$(function () {
  $('input[type="radio"]:checked').each(function () {
      $(this).nextAll("label").addClass("active");
  });

  $(document).on("click", ".radio label", function () {
      $(this).addClass("active");
      $(this).parent().siblings().find("label").removeClass("active");
  });
})
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

$('.start').on('click', function () {
  $('.start-popup').fadeIn()
  $('.hide-content').fadeIn();
})

$('.cancel').on('click', function () {
  $('.start-popup').fadeOut()
  $('.hide-content').fadeOut();
})

let appointmentId = $('.dirction').attr('id')

$('.confirm-start').on('click', function () {
  $.ajax({
    url: '/startMove',
    method: 'POST',
    data: {id: $('.dirction').attr('id'),
    success: function () {
        $('.next-step').html('\
                      <button class="Arrived"><i></i> Arrived</button>\
                      <button class="go_to_direction"><i></i> Direction</button>')
    }
  }
  })
  $('.start-popup').fadeOut()
  $('.hide-content').fadeOut();
})

$(document).on('click', '.Arrived', function () {
  $.ajax({
    url: '/arrived',
    method: 'POST',
    data: {id: $('.dirction').attr('id'),
    success: function () {
        $('.next-step').html('\
          <h5>Please press complete after session end</h5>\
          <button class="complete"><i></i> Complete</button>\
        ')
    }
  }
  })
})

$(document).on('click', '.complete', function () {
  $('.complete-pop-up, .hide-content').fadeIn()
})
$(document).on('click', '.confirm-complete', function () {
  $('.loader').fadeIn().css('display', 'flex')
  $.ajax({
    url: '/complete',
    method: 'POST',
    data: {id: $('.dirction').attr('id'), duration: $(this).parents('.pop-up').find('#duration').val(), repeat: $(this).parents('.pop-up').find('input[name="repeat"]:checked').val()}
    ,success: function (data) {
        if (data.status == 200) {
          $('.next-step').html('<h1 class="arrived">Completed !</h1>')
          $('.pop-up, .hide-content').fadeOut()
          $('.loader').fadeOut()
          document.getElementById("errors").innerHTML = "";
          let error = document.createElement("div");
          error.classList = "alert alert-success";
          error.innerHTML = data.msg;
          document.getElementById("errors").append(error);
          $("#errors").fadeIn("slow");
          setTimeout(() => {
            $('.msg-pop-up, .hide-content').fadeIn()
          }, 500);
          setTimeout(() => {
            $("#errors").fadeOut("slow");
          }, 3000);
        }
      },
      error: function (err) {
          document.getElementById("errors").innerHTML = "";
          $(".loader").fadeOut();
          $.each(err.responseJSON.errors, function (key, value) {
              let error = document.createElement("div");
              error.classList = "alert alert-danger";
              error.innerHTML = value[0];
              document.getElementById("errors").append(error);
          });
          $("#errors").fadeIn("slow");
          setTimeout(() => {
              $("#errors").fadeOut("slow");
          }, 5000);
      },
  })
})

$(document).on('click', '.go_to_direction', function() {
    window.open(`https://www.google.com/maps/dir/?api=1&destination=${parseFloat($('#appointment_lat').val())},${parseFloat($('#appointment_lng').val())}`, '_blank')
})

const service = new google.maps.DistanceMatrixService(); // instantiate Distance Matrix service
      const matrixOptions = {
        origins: ["30.1147,31.3466"], // technician locations
        destinations: ["Ali Fahmy Kamel, El-Nozha, El Nozha, Cairo Governorate, Egypt"], // customer address
        travelMode: 'DRIVING',
        unitSystem: google.maps.UnitSystem.IMPERIAL
      };
      // Call Distance Matrix service
      service.getDistanceMatrix(matrixOptions, callback);

      // Callback function used to process Distance Matrix response
      function callback(response, status) {
        if (status !== "OK") {
          alert("Error with distance matrix");
          return;
        }
        console.log(response);        
      }
