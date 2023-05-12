@extends('doctor.layouts.register-layout')

@section("title", "Register")

@section('content')
    <div id="errors">
        {{-- validation errors will appear here. --}}
    </div>
    <main class="login_wrapper">
        <div id="register_root">
            <p class="h2 text-center">
                Get access to thousands of clients in your local area create your account as a therapist
            </p>
            <ul class="steps">
                <li class="active">1</li>
                <li>2</li>
                <li>3</li>
            </ul>
            <form action="POST" class="lg-grid register_form" id="step-1" autocomplete="off">
                @csrf
                <div class="form-group g-12 photo_group">
                    <input type="file" name="photo" id="photo" class="form-control">
                    <label for="photo" class="mb-3">
                        <img id="preview" src="{{ asset('/imgs/doctor/uploads/therapist_profile/default.png') }}" alt="">
                        <i class="fa fa-user"></i>
                        <div class="after">
                            <i class="fa fa-plus"></i>
                        </div>
                    </label>
                </div>
                <div class="form-group g-6">
                    <input type="text" name="first_name" id="name" class="form-control" placeholder="First name *">
                </div>
                <div class="form-group g-6">
                    <input type="text" name="last_name" id="name" class="form-control" placeholder="Last name *">
                </div>
                <div class="form-group g-6">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email *" autocomplete="off">
                </div>

                <div class="form-group g-6 lg-grid">
                    @include('doctor.includes.phonekeys')
                    <input type="text" name="phone" id="phone" class="form-control g-7" placeholder="Phone number *">
                </div>
                <div class="form-group g-12">
                    <input type="hidden" name="address_lat" id="address_lat">
                    <input type="hidden" name="address_lng" id="address_lng">
                    <input type="hidden" name="address" id="address">
                    <a href="" id="address-a">Address *</a>
                </div>
                <div class="form-group g-6">
                    <input type="text" name="dob" id="dob" placeholder="Date of birth *"
                        onfocus="(this.type='date')"
                        onblur="(this.type='text')" class="form-control">
                </div>
                <div class="form-group g-6">
                    <select name="gender" id="gender" class="form-control">
                        <option value="">Gender *</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
                </div>
                <div class="form-group g-12">
                    <button type="submit" class="btn btn-primary from-control" id="step1_submit">Next</button>
                </div>
            </form>
        </div>
    </main>
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
                <button class="btn btn-success confirm">Confirm</button>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('/js/doctor/register.js') }}?v={{time()}}"></script>
<script src="{{ asset('/js/maps.js') }}?v={{time()}}"></script>
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGhGk3DTCkjF1EUxpMm5ypFoQ-ecrS2gY&callback=initMap&libraries=places&v=weekly"
defer
></script>
@endsection