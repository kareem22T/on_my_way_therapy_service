@extends('doctor.layouts.register-layout')

@section('title', 'Register')

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
                        <img id="preview" src="{{ asset('/imgs/doctor/uploads/therapist_profile/default.png') }}"
                            alt="">
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
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email *"
                        autocomplete="off">
                </div>

                <div class="form-group g-6 lg-grid">
                    @include('doctor.includes.phonekeys')
                    <input type="text" name="phone" id="phone" class="form-control g-7"
                        placeholder="Phone number *">
                </div>
                <div class="form-group g-12">
                    <input type="hidden" name="address_lat" id="address_lat">
                    <input type="hidden" name="address_lng" id="address_lng">
                    <input type="hidden" name="address" id="address">
                    <a href="" id="address-a">Address *</a>
                </div>
                <div class="form-group g-6">
                    <input type="text" name="dob" id="dob" placeholder="Date of birth *"
                        onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control">
                </div>
                <div class="form-group g-6">
                    <select name="gender" id="gender" class="form-control">
                        <option value="">Gender *</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
                </div>

                <section class="extra_section form-group g-12 pt-3" id="therapy">
                    <h1 class="head">The expected earnings from your work with us</h1>
                    <div class="btns-extra">
                        <button class="active">Full-time</button>
                        <button>Part-time</button>
                    </div>
                    <div class="full-time">
                        <input class="custom-range" type="range" value="1" min="1" max="38"
                            v-model="fullval">
                        <div class="value">
                            <output>@{{ fullval }} hours per week</output>
                            <span class="max">38</span>
                        </div>
                        <a href="" @click.prevent>= $@{{ fullval * 139 }}</a>
                    </div>
                    <div class="part-time">
                        <input class="custom-range" type="range" value="1" min="1" max="30"
                            v-model="partval">
                        <div class="value">
                            <output>@{{ partval }} hours per week</output>
                            <span class="max">30</span>
                        </div>
                        <a href="" @click.prevent>= $@{{ partval * 139 }}</a>
                    </div>
                    <p>You will be paid $139 per hour + 80 cent for each travailed kilometer</p>
                </section>

                <div class="form-group g-12">
                    <button type="submit" class="btn btn-primary from-control" id="step1_submit">Next</button>
                </div>
            </form>
        </div>
    </main>
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
            <p>Address will be used to match you with your most local clients as per your chosen travel radius</p>
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

    <form action="" class="pop-up verify-pop-up">
        We have sent you verification codes on your enterd phone and email
        <input type="text" name="phone_code" id="phone_code" placeholder="Enter phone code">
        <input type="text" name="email_code" id="email_code" placeholder="Enter email code">
        <div class="btns">
            <button type="submit" class="btn btn-success" id="verfiy_therapist">Verify</button>
            <button type="submit" class="btn btn-danger" id="cancel">Cancel</button>
        </div>
    </form>

    @include('site.includes.loader')

@endsection

@section('scripts')
    <script src="{{ asset('/js/doctor/register.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('/js/maps.js') }}?v={{ time() }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGhGk3DTCkjF1EUxpMm5ypFoQ-ecrS2gY&callback=initMap&libraries=places&v=weekly"
        defer></script>

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    fullval: 1,
                    partval: 1,
                }
            }
        }).mount('#therapy')
    </script>

    <script>
        $(function() {
            $('#therapy .btns-extra button:first-child').on('click', function(e) {
                e.preventDefault();
                $('.part-time').fadeOut();
                setTimeout(() => {
                    $('.full-time').fadeIn().css('display', 'flex');
                }, 100);
                $(this).addClass('active');
                $(this).siblings().removeClass('active');
            })
            $('#therapy .btns-extra button:last-child').on('click', function(e) {
                e.preventDefault();
                $('.full-time').fadeOut();
                setTimeout(() => {
                    $('.part-time').fadeIn().css('display', 'flex');
                }, 100);
                $(this).addClass('active');
                $(this).siblings().removeClass('active');
            })
        })
    </script>

@endsection
