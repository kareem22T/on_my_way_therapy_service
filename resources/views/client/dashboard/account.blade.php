
@extends('client.layouts.dashboard-layout')

@section('account_link', 'active')

@section('title', 'Account')

@section('content')
@php
    $client = Auth::guard('client')->user()
@endphp
<main class="account_wrapper">
    <div class="container lg-grid">
        <div class="profile g-12">
            <div class="img">
                <img src="/imgs/client/uploads/client_profile/{{$client->photo ? $client->photo : 'default_client_profile.jpg'}}" alt="">
            </div>
            <h1>{{$client->first_name}} {{$client->last_name}}</h1>
            <a href="/client/logout" class="btn btn-danger" >Log out</a>
        </div>

        <div class="form-group g-12">
            <a type="text" id="old_address">{{$client->address}}</a>
            <input type="hidden" name="address" id="address">
            <input type="hidden" name="address_lat" id="address_lat">
            <input type="hidden" name="address_lng" id="address_lng">
            <button id="edit-address"><i class="fa fa-edit"></i></button>
        </div>
        <div class="form-group g-12">
            <input type="text" name="number" id="number" value="{{$client->phone}}" disabled>
            <span>Still your number? <a class="btn btn-danger">No</a></span>
        </div>
    </div>

    <div class="pop-up address-pop-up">
        <div class="ways">
            Enter your address
            <div>
                <i class="fa-solid fa-location-dot"></i>
                <p>Enable location access</p>
            </div>
            <div id="choose_location">
                <i class="fa-solid fa-map-location-dot"></i>
                <p>Choose location on map</p>
            </div>
            <button class="btn btn-danger cancel">Cancel</button>
        </div>

        <div class="autocomplete-map">
            <p>Write down and pick your address</p>
            <div class="pac-card" id="pac-card">
                <div>
                    <div id="strict-bounds-selector" class="pac-controls">
                        <input type="checkbox" id="use-location-bias" value="" checked />
                        <label for="use-location-bias">Bias to map viewport</label>
                    </div>
                </div>
                <div id="pac-container">
                    <input id="pac-input" type="text" placeholder="Enter a location" />
                </div>
            </div>
            <div id="map"></div>
            <div id="infowindow-content">
                <span id="place-name" class="title"></span><br />
                <span id="place-address"></span>
            </div>

            <div class="btns">
                <button class="btn btn-danger cancel">Cancel</button>
                <button class="btn btn-success edit_address">Confirm</button>
            </div>

        </div>
    </div>

    <div class="hide-content"></div>

</main>
@endSection
@section('scripts')
<script src="{{ asset('/js/maps.js') }}?v={{time()}}"></script>
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGhGk3DTCkjF1EUxpMm5ypFoQ-ecrS2gY&callback=initMap&libraries=places&v=weekly"
defer
></script>
<script>
$('.edit_address').on('click', function (e) {
  e.preventDefault()
  if (addressLat && addressLng) {
    $('.address-pop-up').fadeOut();
    $('.hide-content').fadeOut()
    $('#address_lat').val(addressLat)
    $('#address_lng').val(addressLng)
    $('#address').val($('#place-address').text())
    $('#old_address').text($('#place-address').text())
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
</script>
@endsection