@extends('client.layouts.dashboard-layout')

@section('title', 'Confirm session')

@section('content')
    <style>
        form {
            max-width: 550px;
            margin: 70px auto;
            padding: 20px;
            border-radius: 20px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 50px;
            text-align: center;
        }

        form h4 {
            margin-bottom: 15px;
            color: #132F75;
        }

        select {
            width: 40% !important;
            font-size: 18px;
            padding: 13px 15px;
            text-align: center;
            margin: auto;
        }

        .choice {
            margin-top: 20px !important;
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            gap: 0 !important;

        }

        .choice>div {
            gap: 10px;
            font-weight: 500;
            font-size: clamp(1rem, 0.6128rem + 1.6304vw, 1.9375rem);
            line-height: clamp(1.5rem, 0.9837rem + 2.1739vw, 2.75rem);
            text-align: center;
            color: #132F75;
            display: flex;
            width: 80%;
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

        .confirm {
            font-size: 25px;
            border-radius: 20px;
        }
    </style>

    <div id="errors"></div>
    <main>
        @if ($appointment)
            <form id="confirm_form">
                @csrf

                <head>
                    Appointment date: {{ \Carbon\Carbon::parse($appointment->date)->format('M d') }}
                    {{ \Carbon\Carbon::parse($appointment->date)->format('h:i a') }}
                    <br>
                    Appointment therapist: {{ $appointment->doctor->first_name . ' ' . $appointment->doctor->last_name }}
                    <br>
                    <br>
                </head>
                <h4>what was the session duration?</h4>
                <select name="duration" id="duration" class="form-control">
                    <option value="45">45 minutes</option>
                    <option value="60">60 minutes</option>
                    <option value="75">1 hour 15 minutes</option>
                    <option value="90">1 hour 30 minutes</option>
                    <option value="120">2 hours</option>
                </select>
                <br>
                <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                <input type="hidden" name="client_cost" class="client_cost"
                    therapist_profession="{{ $appointment->doctor->profession->id }}"
                    therapist_address="{{ $appointment->doctor->address }}" client_address="{{ $appointment->address }}">
                <input type="hidden" name="therapist_profit" class="therapist_profit"
                    therapist_profession="{{ $appointment->doctor->profession->id }}"
                    therapist_address="{{ $appointment->doctor->address }}" client_address="{{ $appointment->address }}">
                <button class="confirm btn btn-success" type="submit">Confirm</button>
            </form>
        @endif
    </main>
@endSection

@section('scripts')
    <script>
        $(function() {
            $('input[type="radio"]:checked').each(function() {
                $(this).nextAll("label").addClass("active");
            });

            $(document).on("click", ".radio label", function() {
                $(this).addClass("active");
                $(this).parent().siblings().find("label").removeClass("active");
            });

            $('#confirm_form').on('submit', function(e) {
                e.preventDefault();
                $('.loader').fadeIn().css('display', 'flex')
                let formData = new FormData(document.getElementById("confirm_form"));
                $.ajax({
                    url: '/client/session-confirmation',
                    data: formData,
                    processData: false,
                    contentType: false,
                    method: 'POST',
                    success: function(data) {
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
                                $("#errors").fadeOut("slow");
                                location.reload()
                            }, 3000);
                        }
                    },
                    error: function(err) {
                        document.getElementById("errors").innerHTML = "";
                        $(".loader").fadeOut();
                        $.each(err.responseJSON.errors, function(key, value) {
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
        })
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGhGk3DTCkjF1EUxpMm5ypFoQ-ecrS2gY" defer></script>
    <script>
        function clientCost(originAddress, destinationAddress, element) {
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

                    element.val(`$${cost.toFixed(2)}`);
                } else {
                    console.log("Error: " + status);
                }
            });
        }

        function therapistProfit(originAddress, destinationAddress, element) {
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
                    let cost = distanceInKilometers * (0.80)

                    element.val(`$${cost.toFixed(2)}`);
                } else {
                    console.log("Error: " + status);
                }
            });
        }
        $(function() {
            $('.client_cost').each(function() {
                clientCost(
                    $(this).attr('therapist_address'),
                    $(this).attr('client_address'), $(this));
                // $(this).text(distance)
            })
            $('.therapist_profit').each(function() {
                therapistProfit(
                    $(this).attr('therapist_address'),
                    $(this).attr('client_address'), $(this));
                // $(this).text(distance)
            })
        })
    </script>
@endsection
