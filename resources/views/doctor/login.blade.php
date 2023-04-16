@extends('doctor.layouts.register-layout')

@section("title", "Register")

@section("content")
    <div id="errors">
        @if (Session('errorLogin'))
        <div class="alert alert-danger">{{ Session('errorLogin') }}</div>
        @endif
    </div>

    <form action="{{ route('doctor.check.login') }}" method="POST" class="lg-grid mt-5 mb-5" autocomplete="off">
        @csrf
        <div class="form-group g-5">
            <input type="text" name="emailorphone" id="emailorphone" class="form-control" placeholder="email or phone number">
        </div>

        <div class="form-group g-5">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        </div>

        <button type="submit" class="g-2 btn btn-primary form-control">Login</button>
    </form>
@endsection