@extends('client.layouts.dashboard-layout')

@section('chats_link', 'active')
@php
    $guard_type = Auth::guard('client')->check() ? 2 : 1;
    $unSeen = 0;
    foreach (Auth::user()->chats as $chat):
        $unSeen += $chat->msgs
            ->where('seen', 0)
            ->where('sender_guard', '!=', $guard_type)
            ->count();
    endforeach;
@endphp

@section('title', 'Chats (' . $unSeen . ')')

@section('content')
    <style>
        footer {
            display: none !important
        }

        body {
            padding: 0 !important
        }
    </style>
    <main class="chat_wapper">
        <div class="container lg-grid">
            <div class="side-chats g-4">
                <ul>
                    @if ($therapist_data)
                        <li>
                            <a href="/client/chats/{{ $therapist_data['id'] }}" class="selected">
                                <div class="profile">
                                    <img src="{{ asset('imgs/doctor/uploads/therapist_profile/' . $therapist_data['photo']) }}"
                                        alt="therapist img">
                                </div> {{ $therapist_data['first_name'] . ' ' . $therapist_data['last_name'] }}
                            </a>
                        </li>
                    @endif
                    @if ($chats && $chats->count() > 0)
                        @foreach ($chats as $chat)
                            @if ($chat->doctor_id != ($therapist_data !== null ? $therapist_data['id'] : 0))
                                <li>
                                    <a href="/client/chats/{{ $chat->doctor_id }}" class="chat_link" sender_guard="1"
                                        chat_id="{{ $chat->id }}">
                                        <div class="profile">
                                            <img src="{{ asset('imgs/doctor/uploads/therapist_profile/' . $chat->doctor->photo) }}"
                                                alt="therapist img">
                                        </div> {{ $chat->doctor->first_name . ' ' . $chat->doctor->last_name }}
                                        <span
                                            style="display: {{ $chat->msgs->where('seen', false)->where('sender_guard', 1)->count() > 0? 'flex': 'none' }}">
                                            {{ $chat->msgs->where('seen', false)->count() > 0 ? $chat->msgs->where('seen', false)->count() : '' }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @else
                        <h1>No chats yet, <a href="/client">find therapist to contact them ?</a></h1>
                    @endif
                </ul>
            </div>
            <div class="chat g-8">
                @if ($therapist_data)
                    <div class="head">
                        <div>
                            @if ($therapist_data)
                                <a href="/client/therapist{{ '@' . $therapist_data['first_name'] . '_' . $therapist_data['id'] }}"
                                    class="profile">
                                    <img src="{{ asset('imgs/doctor/uploads/therapist_profile/' . $therapist_data['photo']) }}"
                                        alt="therapist img">
                                </a> {{ $therapist_data['first_name'] . ' ' . $therapist_data['last_name'] }}
                            @else
                            @endif
                        </div>
                        <i class="fa-solid fa-ellipsis"></i>
                    </div>
                @endif
                <div class="msgs">
                    @if ($therapist_data)
                        @if ($chats && $chats->count() > 0)
                            @foreach ($chats as $chat)
                                @if ($chat->doctor_id == $therapist_data['id'])
                                    <ul>
                                        @foreach ($chat->msgs as $msg)
                                            @if (strpos($msg['msg_data'], 'appointment') === 0)
                                                @php
                                                    $appointment_id_str = substr($msg['msg_data'], strpos($msg['msg_data'], ':') + 1);
                                                    $appointment_id = intval($appointment_id_str);
                                                    $appointment = App\Models\Appointment::find($appointment_id);
                                                @endphp
                                                <li class="your-msg appointment">
                                                    <h4>Appointment</h4>
                                                    <div class="profile">
                                                        <div class="img">
                                                            <img src="/imgs/client/uploads/client_profile/{{ $appointment->client->photo ? $appointment->client->photo : 'default_client_profile.jpg' }}"
                                                                alt="">
                                                        </div>
                                                        <div class="name">
                                                            <h6>{{ $appointment->client->first_name }}</h6>
                                                            <h6>{{ $appointment->client->last_name }}</h6>
                                                        </div>
                                                        <div class="genderYage">
                                                            <span>{{ $appointment->client->gender }}</span>
                                                            <span>
                                                                {{ Carbon\Carbon::parse($appointment->client->dob)->age }}
                                                                yo
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="date">
                                                        <span>{{ \Carbon\Carbon::parse($appointment->date)->format('M d') }}</span>
                                                        <span>{{ \Carbon\Carbon::parse($appointment->date)->format('h:i a') }}</span>
                                                    </div>
                                                    @if ($appointment->visit_type == 0)
                                                        <div class="address">
                                                            <span>{{ $appointment->client->address }}</span>
                                                            <span class="distance"
                                                                therapist_profession="{{ $appointment->doctor->profession->id }}"
                                                                therapist_address="{{ $appointment->doctor->address }}"
                                                                client_address="{{ $appointment->address }}">
                                                            </span>
                                                        </div>
                                                    @else
                                                        <div class="online_session">
                                                            Online session
                                                        </div>
                                                    @endif
                                                    <div class="status">
                                                        Status: {{ $appointment->status }}
                                                    </div>
                                                    @if ($appointment->journey < 2 && $appointment->status != 'Cancelled')
                                                        <div class="controls">
                                                            <button appointment_id="{{ $appointment->id }}"
                                                                class="cancel_session">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    @endif
                                                    <span>
                                                        {{ $msg['created_at']->format('n/j, g:i A') }}
                                                        @if ($msg['sender_guard'] == 2)
                                                            <i
                                                                class="fa-solid {{ $msg['seen'] ? 'fa-check-double' : 'fa-check' }}"></i>
                                                        @endif
                                                    </span>
                                                </li>
                                            @else
                                                <li class="{{ $msg['sender_guard'] == 2 ? 'your-msg' : 'their-msg' }}">
                                                    {!! $msg['msg_data'] !!}
                                                    <span>
                                                        {{ $msg['created_at']->format('n/j, g:i A') }}
                                                        @if ($msg['sender_guard'] == 2)
                                                            <i
                                                                class="fa-solid {{ $msg['seen'] ? 'fa-check-double' : 'fa-check' }}"></i>
                                                        @endif
                                                    </span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                @endif
                            @endforeach
                        @else
                        @endif
                    @else
                        <p>
                            <i class="fa-regular fa-comments"></i>
                        </p>
                    @endif
                    {{-- <ul>
                    <li class="your-msg">
                        Hello how are you Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolor odio cum hic in voluptates veniam ipsa minus sed architecto ex magnam, praesentium dignissimos velit et nam, ullam consequuntur vero autem!
                    </li>
                    <li class="their-msg">
                        I'm good how may i help you Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem quis natus, accusantium et pariatur repudiandae reprehenderit, sit voluptatem eos vel amet perspiciatis distinctio. Facere ipsam dignissimos quae sit explicabo omnis.
                    </li>
                </ul> --}}
                </div>
                <form action="" class="send" id="send" autocomplete="off">
                    @csrf
                    <input type="hidden" name="guard_type" id="guard_type"
                        value="{{ Auth::guard('client')->check() ? 2 : 1 }}">
                    <input type="hidden" name="client_id" value="{{ Auth::guard('client')->user()->id }}">
                    @if ($therapist_data)
                        <input type="hidden" name="doctor_id" value="{{ $therapist_data['id'] }}">
                    @endif
                    @if ($therapist_data)
                        <input type="text" name="msg" id="msg" placeholder="Type message" autocomplete="off">
                        <button type="submit" class="send-btn"><i class='bx bxs-send'></i></button>
                    @endif
                </form>
            </div>
        </div>
    </main>

    <div class="pop-up cancel_session_pop_up">
        Are you sure you want to cancel the session
        <div class="btns">
            <button class="no btn btn-secondary">No</button>
            <button class="yes_cancel btn btn-danger">Yes cancel</button>
        </div>
    </div>
    <div class="hide-content"></div>
@endSection

@section('scripts')
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

                    element.html(`${distanceInKilometers} km in ${averageTimeInMinutes.toFixed(0)} min`);
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
