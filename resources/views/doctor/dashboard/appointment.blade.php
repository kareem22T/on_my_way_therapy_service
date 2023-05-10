@extends('doctor.layouts.dashboard-layout')

@section('title', 'Appointment')

@section('content')
<div id="errors">
    {{-- validation errors will appear here. --}}
</div>
@if ($appointment !== null) 
    <div class="container home">
        <div class="appointment_wrapper mt-5">
            <input type="hidden" name="appointment_lat" id="appointment_lat" value="{{$appointment->address_lat}}">
            <input type="hidden" name="appointment_lng" id="appointment_lng" value="{{$appointment->address_lng}}">

            <input type="hidden" name="current_location_lat" id="current_location_lat" value="">
            <input type="hidden" name="current_location_lng" id="current_location_lng" value="">
            <div class="appointment">
                <div>
                    <div class="img">
                        <img src="/imgs/client/uploads/client_profile/{{ $appointment->client->photo ? $appointment->client->photo : 'default_client_profile.jpg' }}" alt="client img">
                    </div>
                    <div class="details">
                        <div class="information">
                            <h1>
                                {{ $appointment->client->first_name . ' ' . $appointment->client->last_name }}
                            </h1>
                            <p>
                                <span>{{ $appointment->client->gender }}</span>
                                <span>{{ Carbon\Carbon::parse($appointment->client->dob)->age }} yo</span>
                            </p>
                        </div>
                        <div class="address">
                            {{ $appointment->address }}
                        </div>
                        <div class="time">
                            <span>{{ \Carbon\Carbon::parse($appointment->date)->format('M d') }}</span>
                            <span>Start in: {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $appointment->date, 'UTC')->format('g:i a') }}</span>
                        </div>
                        <div class="btns">
                            <button><i></i> Call</button>
                            <button><i></i> Message</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="dirction">
                <h1>Appointment location</h1>
                <div id="client_location"></div>
                <div class="next-step">
                    <button class="go_to_direction"><i></i> Direction</button>
                    <button class="Arrived"><i></i> Arrived</button>
                </div>
            </div>
        </div>
    </div>

    <div class="pop-up address-pop-up">
        <div class="ways">
            Approve your location
            <div class="get-location-access">
                <i class="fa-solid fa-location-dot"></i>
                <p>Enable location access</p>
            </div>
            <button class="btn btn-danger cancel">Cancel</button>
        </div>
    </div>
    <div class="hide-content"></div>
@else
    <h1 class="text-center">Appointment not found</h1>
@endif
@endSection

@section('scripts')
<script src="{{ asset('/js/doctor/calendar.js') }}"></script>
<script src="{{ asset('/js/doctor/appointment-map.js') }}"></script>
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGhGk3DTCkjF1EUxpMm5ypFoQ-ecrS2gY&callback=initMap&libraries=places&v=weekly"
defer
></script>
@endsection
