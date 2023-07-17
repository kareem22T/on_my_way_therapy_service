@extends('doctor.layouts.dashboard-layout')

@section('title', 'Chats (0)')

@section('chats_link', 'active')

@section('content')
    <div id="errors">
        {{-- validation errors will appear here. --}}
    </div>
    <style>
        footer {
            display: none !important;
        }
    </style>
    <main class="chat_wapper">
        <div class="container lg-grid">
            <div class="side-chats g-4">
                <ul>
                    @if ($client_data)
                        <li>
                            <a href="/therapist/chats/{{ $client_data['id'] }}" class="selected">
                                <div class="profile">
                                    <img src="/imgs/client/uploads/client_profile/{{ $client_data['photo'] ? $client_data['photo'] : 'default_client_profile.jpg' }}"
                                        alt="client img">
                                </div> {{ $client_data['first_name'] . ' ' . $client_data['last_name'] }}
                            </a>
                        </li>
                    @endif
                    @if ($chats && $chats->count() > 0)
                        @foreach ($chats as $chat)
                            @if ($chat->client_id != ($client_data !== null ? $client_data['id'] : 0))
                                <li>
                                    <a href="/therapist/chats/{{ $chat->client_id }}" class="chat_link" sender_guard="2"
                                        chat_id="{{ $chat->id }}">
                                        <div class="profile">
                                            <img src="/imgs/client/uploads/client_profile/{{ $chat->client->photo ? $chat->client->photo : 'default_client_profile.jpg' }}"
                                                alt="client img">
                                        </div>
                                        {{ $chat->client->first_name . ' ' . $chat->client->last_name }}
                                        <span
                                            style="display: {{ $chat->msgs->where('seen', false)->where('sender_guard', 2)->count() > 0? 'flex': 'none' }}">
                                            {{ $chat->msgs->where('seen', false)->count() > 0 ? $chat->msgs->where('seen', false)->count() : '' }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @else
                    @endif
                </ul>
            </div>
            <div class="chat g-8">
                @if ($client_data)
                    <div class="head">
                        <div>
                            @if ($client_data)
                                <a href="/therapist/client/{{ $client_data['id'] }}" class="profile">
                                    <img src="/imgs/client/uploads/client_profile/{{ $client_data['photo'] ? $client_data['photo'] : 'default_client_profile.jpg' }}"
                                        alt="client img">
                                </a> {{ $client_data['first_name'] . ' ' . $client_data['last_name'] }}
                            @else
                            @endif
                        </div>
                        <i class="fa-solid fa-ellipsis"></i>
                    </div>
                @endif

                <div class="msgs">
                    @if ($client_data)
                        @if ($chats && $chats->count() > 0)
                            @foreach ($chats as $chat)
                                @if ($chat->client_id == $client_data['id'])
                                    <ul>
                                        @foreach ($chat->msgs as $msg)
                                            @if (strpos($msg['msg_data'], 'appointment') === 0)
                                                @php
                                                    $appointment_id_str = substr($msg['msg_data'], strpos($msg['msg_data'], ':') + 1);
                                                    $appointment_id = intval($appointment_id_str);
                                                    $appointment = App\Models\Appointment::find($appointment_id);
                                                @endphp
                                                <li class="their-msg appointment">
                                                    <h4>Appointment</h4>
                                                    <div class="profile">
                                                        <div class="img">
                                                            <img src="/imgs/client/uploads/client_profile/{{ $appointment->client->photo ? $appointment->client->photo : 'default_client_profile.jpg' }}"
                                                                alt="client img">
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
                                                                client_address="{{ $appointment->client->address }}">
                                                            </span>
                                                        </div>
                                                    @else
                                                        <div class="online_session">
                                                            Online session
                                                        </div>
                                                    @endif
                                                    @if ($appointment->status == 'pending' && $appointment->status != 'edited')
                                                        <div class="controls">
                                                            <button class="edit-date"
                                                                appointment_date="{{ $appointment->date }}"
                                                                client_id="{{ $appointment->client->id }}"
                                                                doctor_id="{{ $appointment->doctor->id }}">
                                                                <i class="fa-solid fa-calendar-days"></i>
                                                            </button>
                                                            <button class="approve-appointment"
                                                                appointment_id="{{ $appointment->id }}"><i
                                                                    class="fa fa-check"></i></button>
                                                            <div class="set-date">
                                                                <input type="datetime-local" name="new_date" id="new_date">
                                                                <input type="submit" name="submit_new_date"
                                                                    appointment_id="{{ $appointment->id }}"
                                                                    value="Set date">
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="status">
                                                        <div class="approve"
                                                            style="display: {{ $appointment->status == 'approved' ? 'block' : 'none' }}">
                                                            Session Approved !</div>
                                                        <div class="pending"
                                                            style="color: gray; display: {{ $appointment->status == 'edited' ? 'block' : 'none' }}">
                                                            Session pending !</div>
                                                    </div>
                                                    <span>
                                                        {{ $msg['created_at']->format('n/j, g:i A') }}
                                                        @if ($msg['sender_guard'] == 1)
                                                            <i
                                                                class="fa-solid {{ $msg['seen'] ? 'fa-check-double' : 'fa-check' }}"></i>
                                                        @endif
                                                    </span>
                                                </li>
                                            @else
                                                <li class="{{ $msg['sender_guard'] == 1 ? 'your-msg' : 'their-msg' }}">
                                                    {!! $msg['msg_data'] !!}
                                                    <span>
                                                        {{ $msg['created_at']->format('n/j, g:i A') }}
                                                        @if ($msg['sender_guard'] == 1)
                                                            <i
                                                                class="fa-solid {{ $msg['seen'] ? 'fa-check-double' : 'fa-check' }}"></i>
                                                        @endif
                                                    </span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                    <ul></ul>
                                @endif
                            @endforeach
                        @else
                            <ul></ul>
                        @endif
                    @else
                        <p>
                            <i class="fa-regular fa-comments"></i>
                        </p>
                    @endif
                </div>

                <form action="" class="send" id="send" autocomplete="off">
                    @csrf
                    <input type="hidden" name="guard_type" id="guard_type"
                        value="{{ Auth::guard('client')->check() ? 2 : 1 }}">
                    <input type="hidden" name="doctor_id" value="{{ Auth::guard('doctor')->user()->id }}"
                        autocomplete="off">
                    @if ($client_data)
                        <input type="hidden" name="client_id" value="{{ $client_data['id'] }}">
                    @endif
                    @if ($client_data)
                        <input type="text" name="msg" id="msg" placeholder="Type message">
                        <button type="submit"><i class='bx bxs-send'></i></button>
                    @endif
                </form>
            </div>
        </div>
    </main>
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
