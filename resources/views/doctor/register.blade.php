@extends('doctor.layouts.register-layout')

@section("title", "Register")

@section('content')
    <div id="errors">
        {{-- validation errors will appear here. --}}
    </div>
    <div id="register_root">
        <p class="h2 text-center mt-4 mb-4">
            Get access to thousands of clients in your local area create your account as a therapist
        </p>
        <form action="POST" class="lg-grid" id="step-1" autocomplete="off">
            @csrf
            <div class="form-group g-12">
                <input type="file" name="photo" id="photo" class="form-control">
            </div>
            <div class="form-group g-6">
                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group g-6 lg-grid">
                @include('doctor.includes.phonekeys')
                <input type="text" name="phone" id="phone" class="form-control g-8" placeholder="Phone number">
            </div>
            <div class="form-group g-6">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" autocomplete="off">
            </div>
            <div class="form-group g-6">
                <input type="text" name="address" id="address" class="form-control" placeholder="Address">
            </div>
            <div class="form-group g-6">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
            </div>
            <div class="form-group g-6">
                <input type="password" name="password_confirmation" id="confirm_password" class="form-control" placeholder="Confirm password">
            </div>
            <div class="form-group g-12">
                <textarea name="about" id="about" cols="30" rows="10" class="form-control" placeholder="About you"></textarea>
            </div>
            <button type="submit" class="btn btn-primary from-control" id="step1_submit">Next</button>
        </form>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('/js/doctor/register.js') }}"></script>
@endsection