@extends('doctor.layouts.register-layout')

@section("title", "Verfy | phone & email")

@section("content")
    @include('site.includes.loader')
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 20px;
        }
    </style>
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
                Now your account has been registered, Set your password now!
            </h6>
            <form action="POST" class="verfy_form" id="step-1-v2">
                @csrf
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
<script src="{{ asset('/js/doctor/set_pass.js') }}?v={{time()}}"></script>
@endsection