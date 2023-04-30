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
                    <input type="text" name="first_name" id="name" class="form-control" placeholder="First name">
                </div>
                <div class="form-group g-6">
                    <input type="text" name="last_name" id="name" class="form-control" placeholder="Last name">
                </div>
                <div class="form-group g-6">
                    <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                </div>
                <div class="form-group g-6 lg-grid">
                    @include('doctor.includes.phonekeys')
                    <input type="text" name="phone" id="phone" class="form-control g-7" placeholder="Phone number">
                </div>
                <div class="form-group g-6">
                    <input type="date" name="dob" id="dob" class="form-control">
                </div>
                <div class="form-group g-6">
                    <select name="gender" id="gender" class="form-control">
                        <option value="">Gender</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
                </div>
                <div class="form-group g-12">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" autocomplete="off">
                </div>
                <div class="form-group g-12">
                    <button type="submit" class="btn btn-primary from-control" id="step1_submit">Next</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
<script src="{{ asset('/js/doctor/register.js') }}"></script>
@endsection