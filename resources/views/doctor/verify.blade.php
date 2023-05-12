@extends('doctor.layouts.register-layout')

@section("title", "Verfy | phone & email")

@section("content")
    @include('site.includes.loader')
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
            <h6 id="send_msg">
                We have sent you verification code to your provided number
                and another one to your email if it still not sent please wait it may take some moments
                <br>
                Please provide verification codes before they expire
            </h6>
            <form action="POST" class="verfy_form" id="step-1-v2">
                @csrf
                <div class="form-group">
                    <input type="text" name="email_code" id="email_code" class="form-control" placeholder="Eamil code">
                </div>
                <div class="form-group">
                    <input type="text" name="phone_code" id="phone_code" class="form-control" placeholder="Phone code">
                </div>
                <hr>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password">
                </div>
                <div class="form-group">
                    <button type="submit">Next</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
<script src="{{ asset('/js/doctor/verify.js') }}?v={{time()}}"></script>
@endsection