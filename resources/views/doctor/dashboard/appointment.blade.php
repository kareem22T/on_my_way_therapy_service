@extends('doctor.layouts.dashboard-layout')

@section('title', 'Appointment')

@section('content')
    <div id="errors">
        {{-- validation errors will appear here. --}}
    </div>
    @if ($appointment !== null)
        <style>
            .complete-pop-up h4 {
                margin-bottom: 15px;
            }

            .complete-pop-up select {
                width: 40%;
                font-size: 18px;
                padding: 13px 15px;
                text-align: center;
                margin: auto;
            }

            .complete-pop-up .choice {
                margin-top: 20px;
            }

            .choice>div {
                gap: 10px;
                font-weight: 500;
                font-size: clamp(1rem, 0.6128rem + 1.6304vw, 1.9375rem);
                line-height: clamp(1.5rem, 0.9837rem + 2.1739vw, 2.75rem);
                text-align: center;
                color: #132F75;
                display: flex;
            }

            .choice>div .form-group {
                gap: clamp(0.9375rem, 0.8084rem + 0.5435vw, 1.25rem);
                font-weight: 500;
                font-size: 18px;
                line-height: clamp(1.5rem, 0.9837rem + 2.1739vw, 2.75rem);
                text-align: center;
                display: flex;
                color: #132F75 !important;
                width: 100%;
                text-align: center;
            }

            .choice>div .form-group input {
                display: none;
            }

            .choice>div label {
                width: 100%;
                border: 3px solid #D7D7D7;
                border-radius: 17px;
                transition: border-color 0.2s ease-out;
                color: #132F75 !important;
                cursor: pointer;
            }

            .choice>div label.active {
                border: 3px solid #FFC400;
                font-weight: 600
            }
        </style>
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
                                {{ trim(explode(',', $appointment->address)[0]) }}
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
        <div class="pop-up complete-pop-up">
            <h4>what was the session duration?</h4>
            <select name="duration" id="duration" class="form-control">
                <option value="45">45 minutes</option>
                <option value="60">60 minutes</option>
                <option value="75">1 hour 15 minutes</option>
                <option value="90">1 hour 30 minutes</option>
                <option value="120">2 hours</option>
            </select>
            <div class="form-group g-12 choice radio">
                <h4>Do you want to repeat this session again?</h4>
                <div>
                    <div class="form-group">
                        <input type="radio" name="repeat" id="no_repeat" class="form-control" value="0" checked>
                        <label for="no_repeat">None</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="repeat" id="week" class="form-control" value="1">
                        <label for="week">weekly</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="repeat" id="two_week" class="form-control" value="2">
                        <label for="two_week">every 2 week</label>
                    </div>
                </div>
            </div>
            <div class="btns">
                <button class="cancel btn btn-secondary">Cancel</button>
                <button class="confirm-complete btn btn-success">Confirm</button>
            </div>
        </div>

        <div class="msg-pop-up pop-up">
            <h3 style="font-weight: 600;">Please ensure that the client has confirmed the session from their side</h3>
            <h3>(They have recieved an email)</h3>
            <div class="btns">
                <button class="cancel btn btn-secondary">Okay</button>
            </div>
        </div>
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
