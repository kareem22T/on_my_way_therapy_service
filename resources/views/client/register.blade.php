@extends('client.layouts.register-layout')

@section('title', 'Register')

@section('content')
    <div id="errors">
        {{-- validation errors will appear here. --}}
    </div>
    <main class="login_wrapper">
        <div id="register_root">
            <p class="h2 text-center">
                Find Hundreds of therapists in your local area Book/Refer your next appointment in seconds!
                <br><br>
                Create your account as a Client or as a Referrer
            </p>
            <form action="POST" class="lg-grid register_form client_register" id="client_register">
                @csrf
                <div class="form-group g-12 choice radio mt-3">
                    <div>
                        <div class="form-group">
                            <input type="radio" name="account_type" id="account_type_1" value="0" checked>
                            <label for="account_type_1">For Myself</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="account_type" id="account_type_2" value="1">
                            <label for="account_type_2"
                                style="font-size: clamp(1.0625rem, calc(0.9334rem + 0.5435vw), 1.375rem)">For someone else –
                                As referrer</label>
                        </div>
                    </div>
                </div>

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

                <div class="form-group g-12 lg-grid services_inputs">
                    @php
                        $services = App\Models\Profession::all();
                    @endphp
                    <p class="g-12">please select required services (you can select more than one)</p>
                    @foreach ($services as $service)
                        <div class="form-group g-6">
                            <input type="checkbox" name="services[]" id="services_{{ $service->id }}"
                                value="{{ $service->id }}">
                            <label for="services_{{ $service->id }}">{{ $service->title }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group g-6">
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name *">
                </div>
                <div class="form-group g-6">
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name *">
                </div>
                <div class="form-group g-6">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email *">
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
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password *">
                </div>
                <div class="form-group g-6">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        placeholder="Confirm password *">
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

                <div class="lg-grid g-12 for_some_one" style="display: none">
                    <div class="form-group g-6">
                        <input type="text" name="company_name" id="company_name" class="form-control"
                            placeholder="Company name">
                    </div>

                    <div class="form-group g-6">
                        <input type="email" name="company_email" id="company_email" class="form-control"
                            placeholder="Company email">
                    </div>
                    <div class="form-group g-6">
                        <input type="text" name="company_phone_number" id="company_phone_number"
                            placeholder="Company phone number" class="form-control">
                    </div>
                    <div class="form-group g-6">
                        <input type="text" name="company_address" id="company_address" placeholder="Company address"
                            class="form-control">
                    </div>

                    <div class="form-group g-12">
                        @php
                            $relations = App\Models\Relation_to_else_client::all();
                        @endphp
                        <select name="relation_to_patient" id="relation_to_patient" class="form-control">
                            <option value="">What best describes you ...</option>
                            @foreach ($relations as $relation)
                                <option value="{{ $relation->id }}">{{ $relation->relation }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group g-12 diagnosis_wrapper">
                    <input type="text" name="diagnosis" id="diagnosis" placeholder="Basic diagnosis"
                        class="form-control">
                    <ul class="diagnosis">
                        {{-- <li>example <i class="fa-regular fa-circle-xmark"></i></li> --}}
                        {{-- selecte diagnosis will appear here --}}
                    </ul>
                    <a href="" class="add_diagnosis">Add <i class="fa fa-plus"></i></a>
                </div>

                <div class="g-12 flex-center">
                    <hr>
                </div>
                <div class="form-group g-12 choice mt-3">
                    <h1>What do you prefer? (session type)</h1>
                    <div style="flex-direction: column;">
                        <div class="form-group">
                            <input type="checkbox" name="session_type[]" id="session_type_1" value="1">
                            <label for="session_type_1">
                                Mobile therapy includes:
                                <ul>
                                    <li>Home-Visits</li>
                                    <li>School-Visits</li>
                                    <li>Aged-Care Visits</li>
                                </ul>
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="session_type[]" id="session_type_2" value="2">
                            <label for="session_type_2">telehealth online sessions</label>
                        </div>
                    </div>
                </div>

                <div class="g-12 flex-center">
                    <hr>
                </div>

                <div class="form-group g-12 choice radio">
                    <h1>Client type</h1>
                    <div>
                        <div class="form-group client_type_2">
                            <input type="radio" name="client_type" id="client_type_2" value="1" checked>
                            <label for="client_type_2" style="padding: 10px 20px;">
                                <img style="height: 55px;" src="{{ asset('imgs/client/ndis-logo.png') }}">
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="client_type" id="client_type_1" value="0">
                            <label for="client_type_1">Private</label>
                        </div>
                        <div class="form-group">
                            <label class="coming-soon-2" style="padding: 10px 20px;">
                                <img style="height: 55px;" src="{{ asset('imgs/client/medicare.png') }}">
                            </label>
                        </div>

                    </div>
                </div>

                <div class="g-12 flex-center">
                    <hr>
                </div>
                <div class="ndis-form lg-grid g-12">
                    <div class="form-group g-12">
                        <input type="text" name="NDIS_number" id="NDIS_number" placeholder="NDIS number"
                            class="form-control">
                    </div>
                    <div class="form-group g-12">
                        <input type="text" name="NDIS_end_date" id="NDIS_end_date" placeholder="Plan end date"
                            onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control">
                    </div>
                </div>
                <div class="form-group g-12 choice radio lg-grid plan-managed-btns">
                    <div class="lg-grid g-12">
                        <div class="form-group g-6 lg-grid plan_managment_1">
                            <input type="radio" name="managment_type" id="plan_managment_1" value="0">
                            <label for="plan_managment_1" class="g-12">Agency managed</label>
                        </div>
                        <div class="form-group g-6 lg-grid plan_managment_1">
                            <input type="radio" name="managment_type" id="plan_managment_2" value="1" checked>
                            <label for="plan_managment_2" class="g-12">Plan-managed?</label>
                        </div>
                        <div class="form-group g-6 lg-grid">
                            <input type="radio" name="managment_type" id="plan_managment_3" value="2">
                            <label for="plan_managment_3" class="g-12">Self-managed?</label>
                        </div>
                    </div>
                </div>
                <div class="g-12 plan-managed-form lg-grid">
                    <div class="form-group g-12">
                        <input type="email" name="manager_email" id="Plan_manager_email"
                            placeholder="Plan manager email" class="form-control">
                    </div>
                </div>

                <div class="g-12 agency-managed-form"
                    style="
                        font-size: clamp(1.25rem, 0.8886rem + 1.5217vw, 2.125rem);
                        text-align: center;
                        font-weight: 500;
                        color: #132F75;
                        display: none
                    ">
                    you’re all set to go!
                </div>

                <div class="g-12 self-managed-form private-form lg-grid">
                    <div class="form-group g-12">
                        <input type="text" name="card_number" id="card_number" placeholder="Card number "
                            class="form-control">
                    </div>
                    <div class="form-group g-12">
                        <input type="text" name="name_on_card" id="name_on_card" placeholder="Name on card"
                            class="form-control">
                    </div>
                    <div class="form-group g-6">
                        <input type="text" name="expiration_date" id="expiration_date"
                            placeholder="Expiration date (MM/YY)" class="form-control">
                    </div>
                    <div class="form-group g-6">
                        <input type="text" name="security_code" id="security_code" placeholder="Security code"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group g-12 choice radio lg-grid paying-form" style="display: none">
                    <div class="lg-grid g-12">
                        <div class="form-group g-6 lg-grid ">
                            <input type="radio" name="private_paying_method" id="private_paying_method_1"
                                value="0" checked>
                            <label for="private_paying_method_1" class="g-12">Private paying</label>
                        </div>
                        <div class="form-group g-6 lg-grid ">
                            <input type="radio" name="private_paying_method" id="private_paying_method_2"
                                value="1">
                            <label for="private_paying_method_2" class="g-12">Private health</label>
                        </div>
                    </div>
                </div>

                <div class="Private-health g-12">
                    <p>Private health coming soon</p>
                    <img src="{{ asset('/imgs/site/private-health.png') }}" alt="">
                </div>

                <div class="g-12 flex-center plan-managed-hr">
                    <hr>
                </div>
                <div class="form-group g-12">
                    <button type="submit" class="btn btn-primary from-control" id="client_submit">finish</button>
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

    <form action="" class="pop-up verify-pop-up">
        We have sent you verification codes on your enterd phone and email
        <input type="text" name="phone_code" id="phone_code" placeholder="Enter phone code">
        <input type="text" name="email_code" id="email_code" placeholder="Enter email code">
        <div class="btns">
            <button type="submit" class="btn btn-success" id="verfiy_client">Verify</button>
            <button type="submit" class="btn btn-danger" id="cancel">Cancel</button>
        </div>
    </form>

    <div class="pop-up coming-soon-pop-up-2">
        Coming soon !
        <p style="font-size: 16px;font-weight: 500;">
            You will be able to use your medicare rebates with us – stay Tuned
        </p>
        <button type="submit" class="btn btn-secondary mt-3" id="cancel">Cancel</button>
    </div>
    <div class="pop-up coming-soon-pop-up-1">
        Coming soon !
        <p style="font-size: 16px;font-weight: 500;">
            you will be able to use your private health fund and/or pay privately for your session
        </p>
        <button type="submit" class="btn btn-secondary mt-3" id="cancel">Cancel</button>
    </div>

    @include('site.includes.loader')
@endsection

@section('scripts')
    <script src="{{ asset('/js/maps.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('/js/client/register.js') }}?v={{ time() }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGhGk3DTCkjF1EUxpMm5ypFoQ-ecrS2gY&callback=initMap&libraries=places&v=weekly"
        defer></script>
@endsection
