@extends('client.layouts.dashboard-layout')

@section('title', 'Home')

@section('home_link', 'active')

@section('content')
    <style>
        label+ul {
            font-size: clamp(1rem, 0.6128rem + 1.6304vw, 1.9375rem);
            line-height: clamp(1.5rem, 0.9837rem + 2.1739vw, 2.75rem);
        }
    </style>
    <div id="errors">
        {{-- validation errors will appear here. --}}
    </div>
    @php
        $client = Auth::guard('client')->user();
    @endphp

    <main class="home">
        <div class="container">
            <style>
                .assessment-alert {
                    display: flex;
                    gap: clamp(0.8125rem, calc(0.6318rem + 0.7609vw), 1.25rem);
                    justify-content: space-between;
                    align-items: center;
                    background: #FFFFFF;
                    border: 1px solid #FFC400;
                    box-shadow: -2px 5px 5px rgba(0, 0, 0, 0.25);
                    border-radius: clamp(1.25rem, calc(0.9918rem + 1.087vw), 1.875rem);
                    padding: clamp(1rem, calc(0.8967rem + 0.4348vw), 1.25rem) clamp(1.4375rem, calc(1.3859rem + 0.2174vw), 1.5625rem);
                    font-weight: 600;
                    font-size: clamp(1.0625rem, calc(0.7527rem + 1.3043vw), 1.8125rem);
                    text-align: center;
                    color: #132F75;
                    margin: clamp(0.625rem, calc(0.1087rem + 2.1739vw), 1.875rem) 0 clamp(1.875rem, calc(1.6168rem + 1.087vw), 2.5rem);
                }

                .assessment-pop-up .assessment-alert {
                    flex-direction: column;
                    margin: 0;
                    border: none;
                    box-shadow: none;
                    background: none;
                    padding: 0;
                }

                .assessment-alert>div {
                    display: flex;
                    gap: 20px;
                    align-items: center;
                }

                .assessment-pop-up .assessment-alert>div {
                    flex-direction: column;
                    margin: 0;
                }

                .assessment-alert a {
                    text-decoration: none;
                    background: #FFFFFF;
                    border: 1px solid #D7D7D7;
                    border-radius: 20px;
                    padding: clamp(0.5rem, calc(0.4484rem + 0.2174vw), 0.625rem) 20px;
                    font-weight: 600;
                    font-size: clamp(0.9375rem, calc(0.7568rem + 0.7609vw), 1.375rem);
                    line-height: clamp(0.625rem, calc(-0.0978rem + 3.0435vw), 2.375rem);
                    text-align: center;
                    color: #000000;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    gap: 10px;
                }

                @media (max-width: 599.98px) {

                    .assessment-alert,
                    .assessment-alert>div {
                        flex-direction: column;
                    }
                }
            </style>
            @if ($serviceAgreement == false || $riskAssessment == false)
                <div class="assessment-alert">
                    Please, you have to fill these first
                    <div>
                        <a href="https://form.jotform.com/231594061545557?client_id={{ $client->id }}&first_name={{ $client->first_name }}&last_name={{ $client->last_name }}&email={{ $client->email }}&phone={{ $client->phone }}&dob={{ $client->dob }}"
                            class="{{ $serviceAgreement == true ? 'done_argeement' : '' }}"
                            class="{{ $serviceAgreement == true ? 'done_argeement' : '' }}" target="_blanck">
                            NDIS service agreement
                            @if ($serviceAgreement == true)
                                <i class="fa fa-circle-check text-success"></i>
                            @else
                                <i class="fa-regular fa-circle-play text-danger"></i>
                            @endif
                        </a>
                        <a href="https://form.jotform.com/231613271952554?client_id={{ $client->id }}&first_name={{ $client->first_name }}&last_name={{ $client->last_name }}&email={{ $client->email }}&phone={{ $client->phone }}&dob={{ $client->dob }}"
                            class="{{ $riskAssessment == true ? 'done_risk' : '' }}"
                            class="{{ $riskAssessment == true ? 'done_risk' : '' }}" target="_blanck">
                            Risk assessment template
                            @if ($riskAssessment == true)
                                <i class="fa fa-circle-check text-success"></i>
                            @else
                                <i class="fa-regular fa-circle-play text-danger"></i>
                            @endif
                        </a>
                    </div>
                </div>
            @endif

            <script>
                let a1 = document.querySelector(".done_argeement");
                let a2 = document.querySelector(".done_risk");
                if (a1)
                    a1.addEventListener("click", function(event) {
                        event.preventDefault();
                    });
                if (a2)
                    a2.addEventListener("click", function(event) {
                        event.preventDefault();
                    });
            </script>
        </div>

        @if (!isset($therapist) && !isset($search_results))
            <div class="container">
                <h1>
                    Hello {{ Auth::guard('client')->user()->first_name }}, we’re here to help you find the right therapist,
                    search by name or by therapy type
                </h1>
                <form class="form-group">
                    <input type="text" name="search" id="search" placeholder="Search ..." class="form-control">
                    <i class="fa-solid fa-search"></i>
                    <div class="results">
                    </div>
                </form>
                <p>
                    Please search by, name or service
                </p>
                <div class="professions_wrapper">
                    <h1>Please select your service</h1>
                    <div class="professions">
                        @foreach (App\Models\Profession::all() as $profession)
                            <a href="/client/search:{{ $profession->title }}" class="profession">
                                <div class="img">
                                    <img src="{{ asset('/imgs/professions/' . $profession->id . '.png') }}" alt="">
                                </div>
                                <h4>{{ $profession->title }}</h4>
                                <div class="bg"></div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @elseif (isset($therapist))
            <div class="container lg-grid client_calendar_wrapper">
                <div class="booking g-7">
                    <div class="preview_warapper">
                        <h1>Chose best time for you</h1>
                        <div class="preview">
                            <div class="left">
                                <div class="calendar">
                                    <div class="month">
                                        <i class="fas fa-angle-left prev"></i>
                                        <div class="date">december 2015</div>
                                        <i class="fas fa-angle-right next"></i>
                                    </div>

                                    <div class="weekdays">
                                        <div>Sun</div>
                                        <div>Mon</div>
                                        <div>Tue</div>
                                        <div>Wed</div>
                                        <div>Thu</div>
                                        <div>Fri</div>
                                        <div>Sat</div>
                                    </div>

                                    <div class="days"></div>

                                    {{-- <div class="goto-today">
                                <button class="today-btn">Today</button>
                            </div> --}}
                                </div>

                            </div>

                            <h1 class="slot_head">Avilable slots</h1>
                            <div class="right">
                                <div class="today-date">
                                    <div class="event-day">wed</div>
                                    <div class="event-date">12th december 2022</div>
                                </div>

                                <div class="slots">
                                    <div start="{{ $therapist->working_hours_from }}"
                                        to="{{ $therapist->working_hours_to }}">
                                        <ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <form action="">
                                <div class="visit_type_wrapper">
                                    <h1>visits type</h1>
                                    <div class="btns-wrapper">
                                        <div class="form-group visit_type">
                                            <input type="radio" name="visit_type" id="visit_type_1" value="0"
                                                checked>
                                            <label for="visit_type_1">Mobile therapy includes</label>
                                            <ul class="mt-2">
                                                <li>Home-Visits</li>
                                                <li>School-Visits</li>
                                                <li>Aged-Care Visits</li>
                                            </ul>
                                        </div>
                                        <div class="form-group visit_type">
                                            <input type="radio" name="visit_type" id="visit_type_2" value="1">
                                            <label for="visit_type_2">telehealth online sessions</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="btns">
                        <button id="confirm_appointment" doctor_id="{{ $therapist->id }}">Confirm</button>
                        <button id="join_wait_list" doctor_id="{{ $therapist->id }}">Join wait list</button>
                    </div>
                </div>

                <div class="profile_wrapper g-5">
                    <div class="profile">
                        <div class="img">
                            <img src="{{ asset('/imgs/doctor/uploads/therapist_profile/' . $therapist->photo) }}"
                                alt="">
                        </div>
                        <h1 class="name">Dr.{{ $therapist->first_name . ' ' . $therapist->last_name }}</h1>
                        <span class="rate">
                            @php
                                $rate = 0;
                            @endphp
                            @foreach ($therapist->rating as $rating)
                                @php
                                    $rate += (int) $rating->rating;
                                @endphp
                            @endforeach
                            @for ($i = 0; $i < $rate / ($therapist->rating->count() === 0 ? 1 : $therapist->rating->count()); $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                            @for ($i = 0; $i < 5 - $rate / ($therapist->rating->count() === 0 ? 1 : $therapist->rating->count()); $i++)
                                <i class="fa-regular fa-star"></i>
                            @endfor
                            <span class="text-dark">({{ $therapist->rating->count() }})</span>
                        </span>
                        <h3 class="profession">{{ $therapist->profession->title }}</h3>
                        <p class="distance" therapist_profession="{{ $therapist->profession->id }}"
                            therapist_address="{{ $therapist->address }}"
                            client_address="{{ Auth::guard('client')->user()->address }}">
                        </p>
                        <p class="about">
                            {{ $therapist->about_me }}
                        </p>
                        <div class="bg-border"></div>
                    </div>
                    <a href="/client">select another therapist</a>
                </div>
            </div>
            <div class="pop-up address-pop-up">
                <div class="ways">
                    Confirm your address
                    <input type="text" name="old_address" id="old_address" disabled placeholder="Your address"
                        value="{{ Auth::guard('client')->user()->address }}">
                    <input type="hidden" name="address_lat" id="address_lat" placeholder="Your address"
                        value="{{ Auth::guard('client')->user()->address_lat }}">
                    <input type="hidden" name="address_lng" id="address_lng" placeholder="Your address"
                        value="{{ Auth::guard('client')->user()->address_lng }}">
                    <input type="hidden" name="address" id="address" placeholder="Your address"
                        value="{{ Auth::guard('client')->user()->address }}">
                    <div id="enable-location-access" class="change-location">
                        <h1>Enable location access</h1> <i class="fa fa-location-dot"></i>
                    </div>
                    <div id="choose_location" class="change-location">
                        <h1>change location</h1> <i class="fa fa-edit"></i>
                    </div>
                    <div class="btns m-0">
                        <button class="btn btn-danger cancel">Cancel</button>
                        <button class="btn btn-success confirm-appointment-address-old">Confirm</button>
                    </div>
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
                        <button class="btn btn-success confirm-appointment-address">Confirm</button>
                    </div>

                </div>
            </div>

            <div class="pop-up join-wait-list-pop-up">
                <h1>Join wait list</h1>
                <input type="text" name="date" id="date" placeholder="Session date *"
                    onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control">
                <input type="text" name="time" id="time" placeholder="Session time *"
                    onfocus="(this.type='time')" onblur="(this.type='text')" class="form-control">
                <div class="btns m-0">
                    <button class="btn btn-danger cancel">Cancel</button>
                    <button class="btn btn-success confirm-join-wait-list">Confirm</button>
                </div>
            </div>

            <div class="pop-up assessment-pop-up">
                <div class="assessment-alert">
                    Please, you have to fill these first
                    <div>
                        <a href="https://form.jotform.com/231594061545557?client_id={{ $client->id }}&first_name={{ $client->first_name }}&last_name={{ $client->last_name }}&email={{ $client->email }}&phone={{ $client->phone }}&dob={{ $client->dob }}"
                            class="{{ $serviceAgreement == true ? 'done_argeement' : '' }}" target="_blanck">
                            NDIS service agreement
                            @if ($serviceAgreement == true)
                                <i class="fa fa-circle-check text-success"></i>
                            @else
                                <i class="fa-regular fa-circle-play text-danger"></i>
                            @endif
                        </a>
                        <a href="https://form.jotform.com/231613271952554?client_id={{ $client->id }}&first_name={{ $client->first_name }}&last_name={{ $client->last_name }}&email={{ $client->email }}&phone={{ $client->phone }}&dob={{ $client->dob }}"
                            class="{{ $riskAssessment == true ? 'done_risk' : '' }}" target="_blanck">
                            Risk assessment template
                            @if ($riskAssessment == true)
                                <i class="fa fa-circle-check text-success"></i>
                            @else
                                <i class="fa-regular fa-circle-play text-danger"></i>
                            @endif
                        </a>
                    </div>
                </div>
                <div class="btns">
                    <button class="btn btn-secondary cancel">
                        Cancel
                    </button>
                </div>
            </div>

            <div class="hide-content"></div>
            @section('scripts')
                <script src="{{ asset('/js/maps.js') }}?v={{ time() }}"></script>
                <script src="{{ asset('/js/doctor/calendar.js') }}?v={{ time() }}"></script>
                <script src="{{ asset('/js/client/calendar.js') }}?v={{ time() }}"></script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGhGk3DTCkjF1EUxpMm5ypFoQ-ecrS2gY" defer></script>
                <script
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGhGk3DTCkjF1EUxpMm5ypFoQ-ecrS2gY&callback=initMap&libraries=places&v=weekly"
                    defer></script>


                <script>
                    function getdistance(originAddress, destinationAddress, element) {
                        // Initialize the Directions Service
                        var directionsService = new google.maps.DirectionsService();

                        // Create a Directions Request object
                        var request = {
                            origin: originAddress,
                            destination: destinationAddress,
                            travelMode: google.maps.TravelMode.DRIVING, // You can change the travel mode as per your requirement
                        };

                        // Call the route method of DirectionsService
                        directionsService.route(request, function(response, status) {
                            if (status == google.maps.DirectionsStatus.OK) {
                                // Get the distance in kilometers
                                var distanceInMeters = response.routes[0].legs[0].distance.value;
                                var distanceInKilometers = (distanceInMeters / 1000).toFixed(2);
                                // Get the duration in seconds
                                var durationInSeconds = response.routes[0].legs[0].duration.value;
                                // Calculate the average time in minutes
                                var averageTimeInMinutes = durationInSeconds / 60;
                                let cost = averageTimeInMinutes * (element.attr('therapist_profession') == 6 ? 3.57 : 3.23)

                                element.html(distanceInKilometers + ` km away ` + (distanceInKilometers < 30 ? `| travel cost $${cost.toFixed(2)}` : "<br> (recomended telehealth)"))
                            } else {
                                console.log("Error: " + status);
                            }
                        });
                    }
                    $(function() {
                        $('.distance').each(function() {
                            getdistance(
                                $(this).attr('therapist_address'),
                                $(this).attr('client_address'), $(this));
                            // $(this).text(distance)
                        })
                    })
                </script>
            @endsection
        @elseif (isset($search_results))
            @if (count($search_results) > 0)
                <div class="container search_wrapper">
                    <div class="form-group g-3 mt-0 mb-2">
                        <input type="text" name="search" id="search" placeholder="Search ..."
                            class="form-control">
                        <i class="fa-solid fa-search"></i>
                        <div class="results">
                        </div>
                    </div>
                    <h2 class="g-3 text-center mb-2">
                        {{ $search }} therapists
                    </h2>
                    <div class="search_results_wrapper lg-grid">
                        @foreach ($search_results as $therapist)
                            <a class="g-4 therapist_overview"
                                href="/client/therapist{{ '@' . $therapist->first_name . '_' . App\Models\Doctor::where('email', $therapist->email)->first()->id }}"
                                target="_blanck">
                                <div class="img">
                                    <img src="{{ asset('imgs/doctor/uploads/therapist_profile/' . $therapist->photo) }}"
                                        alt="{{ $therapist->first_name }}">
                                </div>
                                <h3>{{ $therapist->first_name . ' ' . $therapist->last_name }}</h3>
                                <span class="rate">
                                    @for ($i = 0; $i < $therapist->rating; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                    @for ($i = 0; $i < 5 - $therapist->rating; $i++)
                                        <i class="fa-regular fa-star"></i>
                                    @endfor
                                </span>
                                <p class="distance" therapist_profession="{{ $therapist->profession->id }}"
                                    therapist_address="{{ $therapist->address }}"
                                    client_address="{{ Auth::guard('client')->user()->address }}">
                                </p>
                                <h4>
                                    {{ $therapist->experience }} years of experience
                                </h4>
                                <div class="bg"></div>
                            </a>
                        @endforeach
                    </div>
                    {!! $search_results->links('pagination::bootstrap-4') !!}
                @else
                    <div class="container"
                        style="
                display: flex;
                flex-direction: column;
                gap: 0;">
                        <h1 class="mb-3">Try again</h1>
                        <div class="form-group g-2 mt-0 mb-5">
                            <input type="text" name="search" id="search" placeholder="Search ..."
                                class="form-control">
                            <i class="fa-solid fa-search"></i>
                            <div class="results">
                            </div>
                        </div>
                        <img src="{{ asset('/imgs/search_not_found.png') }}" alt=""
                            style="margin: auto;width: 400px;">
                        <h1>No results found !</h1>
                        <h3 class="text-center">Records doesn't match, there is no therapists unfortunately</h3>
                    </div>
            @endif
            </div>
        @else
            sajdj
        @endif
    </main>
@endSection

@section('scripts')
    <script src="{{ asset('/js/client/search.js') }}?v={{ time() }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGhGk3DTCkjF1EUxpMm5ypFoQ-ecrS2gY" defer></script>
    <script>
        function getdistance(originAddress, destinationAddress, element) {
            // Initialize the Directions Service
            var directionsService = new google.maps.DirectionsService();

            // Create a Directions Request object
            var request = {
                origin: originAddress,
                destination: destinationAddress,
                travelMode: google.maps.TravelMode.DRIVING, // You can change the travel mode as per your requirement
            };

            // Call the route method of DirectionsService
            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    // Get the distance in kilometers
                    var distanceInMeters = response.routes[0].legs[0].distance.value;
                    var distanceInKilometers = (distanceInMeters / 1000).toFixed(2);
                    // Get the duration in seconds
                    var durationInSeconds = response.routes[0].legs[0].duration.value;
                    // Calculate the average time in minutes
                    var averageTimeInMinutes = durationInSeconds / 60;
                    let cost = averageTimeInMinutes * (element.attr('therapist_profession') == 6 ? 3.57 : 3.23)

                    element.html(distanceInKilometers + ` km away ` + (distanceInKilometers < 30 ? `| travel cost $${cost.toFixed(2)}` : "<br> (recomended telehealth)"))
                } else {
                    console.log("Error: " + status);
                }
            });
        }
        $(function() {
            $('.distance').each(function() {
                getdistance(
                    $(this).attr('therapist_address'),
                    $(this).attr('client_address'), $(this));
                // $(this).text(distance)
            })
        })
    </script>
@endsection
