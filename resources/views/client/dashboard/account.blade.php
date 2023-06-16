@extends('client.layouts.dashboard-layout')
@section('extra-style')
    <link rel="stylesheet" href="{{ asset('/css/doctor.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('/css/client.css') }}?v={{ time() }}">
@endsection
@section('account_link', 'active')

@section('title', 'Account')

@section('content')
    @php
        $client = Auth::guard('client')->user();
    @endphp
    <style>
        .photo_group {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .photo_group input {
            opacity: 0;
            display: none !important;
        }

        .photo_group label {
            font-size: clamp(2.5rem, 1.6964rem + 3.2967vw, 4.375rem);
            width: clamp(6.25rem, 4.9107rem + 5.4945vw, 9.375rem);
            height: clamp(6.25rem, 4.9107rem + 5.4945vw, 9.375rem);
            display: flex;
            justify-content: center;
            align-content: center;
            align-items: center;
            background: #D7D7D7;
            color: #132F75;
            border-radius: 50%;
            position: relative;
            cursor: pointer;
        }

        .photo_group label img {
            width: 100%;
            height: 100%;
            position: absolute;
            object-fit: cover;
            top: 0;
            left: 0;
            border: none;
            border-radius: 50%;
            margin-bottom: clamp(0rem, -0.413rem + 1.7391vw, 1rem);
        }

        .photo_group label i {
            position: relative;
            z-index: 99999;
        }

        .photo_group label .after {
            position: absolute;
            bottom: clamp(0.3125rem, 0.4464rem - 0.5495vw, 0rem);
            right: clamp(0.3125rem, 0.4464rem - 0.5495vw, 0rem);
            background-color: #FFC400;
            color: #132F75;
            font-size: clamp(0.9375rem, 0.8036rem + 0.5495vw, 1.25rem);
            border: 2px solid #ffffff;
            font-weight: 600;
            border-radius: 50%;
            width: clamp(1.6875rem, 1.2054rem + 1.978vw, 2.8125rem);
            height: clamp(1.6875rem, 1.2054rem + 1.978vw, 2.8125rem);
            z-index: 2255;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form>div {
            margin: 0 !important;
        }
    </style>
    <div id="errors"></div>
    <main class="account_wrapper login_wrapper">
        <div id="register_root">
            <form action="" id="update" class="lg-grid register_form client_register">
                <div class="profile g-12 lg-grid" style="flex-direction: column;gap: 0px;">
                    <div class="form-group g-12 photo_group">
                        <input type="file" name="photo" id="photo" class="form-control">
                        <label for="photo">
                            <img id="preview"
                                src="/imgs/client/uploads/client_profile/{{ $client->photo ? $client->photo : 'default_client_profile.jpg' }}"
                                alt="">
                            <div class="after">
                                <i class="fa fa-edit"></i>
                            </div>
                        </label>
                    </div>
                    <h1>{{ $client->first_name }} {{ $client->last_name }}</h1>
                    <a href="/client/logout" class="btn btn-danger">Log out</a>
                </div>

                <div class="form-group g-6">
                    <input type="text" name="first_name" id="first_name" value="{{ $client->first_name }}"
                        class="form-control" placeholder="First name *">
                </div>
                <div class="form-group g-6">
                    <input type="text" name="last_name" id="last_name" class="form-control"
                        value="{{ $client->last_name }}" placeholder="Last name *">
                </div>
                <div class="form-group g-6">
                    <input type="email" name="email" id="email" class="form-control" value="{{ $client->email }}"
                        placeholder="Email *">
                </div>
                <div class="form-group g-6 lg-grid">
                    @include('doctor.includes.phonekeys')
                    <input type="text" name="phone" id="phone" class="form-control g-7"
                        value="{{ $client->phone }}" placeholder="Phone number *">
                </div>
                <div class="form-group g-12">
                    <input type="hidden" name="address_lat" id="address_lat">
                    <input type="hidden" name="address_lng" id="address_lng">
                    <input type="hidden" name="address" id="address">
                    <a href="" id="address-a">{{ $client->address }}</a>
                </div>
                <div class="form-group g-6">
                    <input type="text" name="dob" id="dob" placeholder="Date of birth *"
                        onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control"
                        value="{{ $client->dob }}">
                </div>
                <div class="form-group g-6">
                    <button type="submit" class="btn btn-primary text-center form-control w-100"
                        id="update-btn">Save</button>
                </div>
            </form>
        </div>

        <div class="pop-up address-pop-up">
            <div class="ways">
                Enter your address
                <div id="enable-location-access">
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
                <p>drag the marker to pick your accurate location</p>
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
                    <button class="btn btn-success confirm">Confirm</button>
                </div>

            </div>
        </div>

        <div class="hide-content"></div>

    </main>
@endSection
@section('scripts')
    <script src="{{ asset('/js/maps.js') }}?v={{ time() }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGhGk3DTCkjF1EUxpMm5ypFoQ-ecrS2gY&callback=initMap&libraries=places&v=weekly"
        defer></script>
    <script>
        $('.edit_address').on('click', function(e) {
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
    <script>
        document.getElementById("update-btn").addEventListener("click", function(event) {
            event.preventDefault();
            $('.loader').fadeIn().css('display', 'flex');
            let formData = new FormData(document.getElementById('update'))
            $.ajax({
                url: '/client/update',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(data) {
                    if (data.status == 200) {
                        document.getElementById('errors').innerHTML = ''
                        let error = document.createElement('div')
                        error.classList = 'alert alert-success'
                        error.innerHTML = data.msg
                        document.getElementById('errors').append(error)
                        $('#errors').fadeIn('slow')
                        $('.loader').fadeOut()
                        setTimeout(() => {
                            $('#errors').fadeOut('slow')
                        }, 3500);
                    }
                },
                error: function(err) {
                    document.getElementById('errors').innerHTML = ''
                    $.each(err.responseJSON.errors, function(key, value) {
                        let error = document.createElement('div')
                        error.classList = 'alert alert-danger'
                        error.innerHTML = value[0]
                        document.getElementById('errors').append(error)
                    });
                    $('#errors').fadeIn('slow')
                    $('.loader').fadeOut()
                    setTimeout(() => {
                        $('#errors').fadeOut('slow')
                    }, 3500);
                },
            })
        });
    </script>
    <script>
        $("#photo").change(function() {
            // check if file is valid image
            var file = this.files[0];
            var fileType = file.type;
            var validImageTypes = ["image/gif", "image/jpeg", "image/jpg", "image/png"];
            if ($.inArray(fileType, validImageTypes) < 0) {
                document.getElementById('errors').innerHTML = ''
                let error = document.createElement('div')
                error.classList = 'alert alert-danger'
                error.innerHTML = "Invalid file type. Please choose a GIF, JPEG, or PNG image."
                document.getElementById('errors').append(error)
                $('#errors').fadeIn('slow')
                setTimeout(() => {
                    $('#errors').fadeOut('slow')
                }, 2000);

                $(this).val(null);
                $("#preview").attr("src", "/imgs/doctor/uploads/therapist_profile/default.png");
                $('.photo_group label >i').fadeIn('fast');
                $('.photo_group .after i').removeClass('fa-edit').addClass('fa-plus');
            } else {
                // display image preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#preview").attr("src", e.target.result);
                    $('.photo_group .after i').removeClass('fa-plus').addClass('fa-edit');
                    $('.photo_group label >i').fadeOut('fast');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
