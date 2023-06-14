@extends('doctor.layouts.dashboard-layout')

@section('title', 'Appointment')

@section('content')
    <div id="errors">
        {{-- validation errors will appear here. --}}
    </div>
    @if ($appointment !== null)
        <div class="container home">
            <div class="appointment_wrapper">
                <input type="hidden" name="appointment_lat" id="appointment_lat" value="{{ $appointment->address_lat }}">
                <input type="hidden" name="appointment_lng" id="appointment_lng" value="{{ $appointment->address_lng }}">

                <input type="hidden" name="current_location_lat" id="current_location_lat" value="">
                <input type="hidden" name="current_location_lng" id="current_location_lng" value="">
                <div class="appointment">
                    <div>
                        <a href="/therapist/cliet/{{ $appointment->client->id }}" target="_blanck" class="img">
                            <img src="/imgs/client/uploads/client_profile/{{ $appointment->client->photo ? $appointment->client->photo : 'default_client_profile.jpg' }}"
                                alt="client img">
                        </a>
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
                                <span>Start in:
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $appointment->date, 'UTC')->format('g:i a') }}</span>
                            </div>
                            <div class="btns">
                                <a href="/therapist/chats/{{ $appointment->client_id }}"><i></i> Message</a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="dirction" id="{{ $appointment->id }}">
                    <h1>Appointment location</h1>
                    <div id="client_location"></div>
                    @if ($appointment->journey == 1)
                        <div class="next-step">
                            <span></span>
                            <button class="start"><i></i> Start</button>
                            <div class="pop-up start-popup">
                                We going to let the client know you will start
                                <div class="btns">
                                    <button class="btn btn-success confirm-start"
                                        id="{{ $appointment->id }}">Confirm</button>
                                    <button class="btn btn-danger cancel">Cancel</button>
                                </div>
                            </div>
                            <div class="hide-content"></div>
                        </div>
                    @elseif ($appointment->journey == 2)
                        <div class="next-step">
                            <button class="Arrived" id="{{ $appointment->id }}"><i></i> Arrived</button>
                            <button class="go_to_direction"><i></i> Direction</button>
                        </div>
                    @elseif ($appointment->journey == 3)
                        <div class="next-step">
                            <h5>Please press complete after session end</h5>
                            <button class="complete" id="{{ $appointment->id }}"><i></i> Complete</button>
                        </div>
                    @else
                        <div class="next-step">
                            <h1 class="arrived">Completed !</h1>
                        </div>
                    @endif
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
        defer></script>
@endsection
