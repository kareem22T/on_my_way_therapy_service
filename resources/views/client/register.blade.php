@extends('client.layouts.register-layout')

@section("title", "Register")

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
                            <label for="account_type_1">For my self</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="account_type" id="account_type_2" value="1">
                            <label for="account_type_2">For someone else</label>
                        </div>
                    </div>
                </div>

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
                    <input type="text" name="phone" id="phone" class="form-control g-7" placeholder="Phone number *">
                </div>
                <div class="form-group g-12">
                    <input type="text" name="address" id="address" disabled class="form-control" placeholder="Address *">
                </div>
                <div class="form-group g-6">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password *">
                </div>
                <div class="form-group g-6">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm password *">
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

                <div class="form-group g-6">
                    <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company name">
                </div>

                <div class="form-group g-6">
                    <input type="email" name="company_email" id="company_email" class="form-control" placeholder="Company email">
                </div>

                <div class="form-group g-12 diagnosis_wrapper">
                    <input type="text" name="diagnosis" id="diagnosis" placeholder="Basic diagnosis" class="form-control">
                    <ul class="diagnosis">
                        {{-- <li>example <i class="fa-regular fa-circle-xmark"></i></li> --}}
                        {{-- selecte diagnosis will appear here --}}
                    </ul>
                    <a href="" class="add_diagnosis">Add <i class="fa fa-plus"></i></a>
                </div>

                <div class="form-group g-12 choice radio mt-3">
                    <h1>Do you prefer a male or a female therapist</h1>
                    <div>
                        <div class="form-group">
                            <input type="radio" name="therapist_gender" id="therapist_gender_1" value="0">
                            <label for="therapist_gender_1">Male</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="therapist_gender" id="therapist_gender_2" value="1">
                            <label for="therapist_gender_2">Female</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="therapist_gender" id="therapist_gender_3" value="2">
                            <label for="therapist_gender_3">Either</label>
                        </div>
                    </div>
                </div>
                <div class="g-12 flex-center">
                    <hr>
                </div>
                <div class="form-group g-12 choice mt-3">
                    <h1>What do you prefer? (session type)</h1>
                    <div>
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
                        <div class="form-group">
                            <input type="radio" name="client_type" id="client_type_1" value="0" checked>
                            <label for="client_type_1">Private</label>
                        </div>
                        <div class="form-group client_type_2">
                            <input type="radio"  name="client_type" id="client_type_2" value="1">
                            <label for="client_type_2">NDIS</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="client_type" id="client_type_3" value="2">
                            <label for="client_type_3">Medicare</label>
                        </div>
                    </div>
                </div>
                <div class="g-12 flex-center">
                    <hr>
                </div>
                <div class="ndis-form lg-grid g-12">
                    <div class="form-group g-12">
                        <input type="text" name="NDIS_number" id="NDIS_number" placeholder="NDIS number" class="form-control">
                    </div>
                    <div class="form-group g-12">
                        <input type="text" name="NDIS_end_date" id="NDIS_end_date" placeholder="Plan end date"
                            onfocus="(this.type='date')"
                            onblur="(this.type='text')" class="form-control">
                    </div>
                </div>
                <div class="form-group g-12 choice radio lg-grid">
                    <div class="lg-grid g-12">
                        <div class="form-group g-6 lg-grid plan_managment_1">
                            <input type="radio" name="plan_managment" id="plan_managment_1" value="0" checked>
                            <label for="plan_managment_1" class="g-12">Plan-managed?</label>
                        </div>
                        <div class="form-group g-6 lg-grid">
                            <input type="radio" name="plan_managment" id="plan_managment_2" value="1">
                            <label for="plan_managment_2" class="g-12">Self-managed?</label>
                        </div>
                    </div>
                </div>
                <div class="g-12 plan-managed-form lg-grid">
                    <div class="form-group g-12">
                        <input type="email" name="Plan_manager_email" id="Plan_manager_email" placeholder="Plan manager email" class="form-control">
                    </div>
                    <div class="form-group g-12">
                        <input type="text" name="card_number" id="card_number" placeholder="Credit card number " class="form-control">
                    </div>
                </div>

                <div class="g-12 flex-center">
                    <hr>
                </div>
                <div class="form-group g-12">
                    <button type="submit" class="btn btn-primary from-control" id="client_submit">finish</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
<script src="{{ asset('/js/client/register.js') }}"></script>
@endsection