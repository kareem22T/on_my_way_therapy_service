@extends('doctor.layouts.register-layout')

@section("title", "Register")

@section("content")
    <div id="errors">
        @if (Session('errorLogin'))
        <div class="alert alert-danger">{{ Session('errorLogin') }}</div>
        @endif
    </div>

    <div class="login_wrapper">
        <form action="{{ route('doctor.check.login') }}" method="POST" class="doctor_login_form" autocomplete="off">
            @csrf
            <h1>Login | Therapist</h1>
            <div class="img">
                <img src="{{ asset("/imgs/doctor/login.png") }}" alt="doctors">
            </div>
            <div class="form-group">
                <input type="text" name="emailorphone" id="emailorphone" class="form-control" placeholder="Email or phone number">
            </div>

            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            </div>

            <button type="submit" class="g-2 btn btn-primary form-control">Login</button>
        </form>
    </div>

@endsection