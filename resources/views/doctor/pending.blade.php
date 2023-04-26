@extends('doctor.layouts.register-layout')
@section("title", "Pending")
@section('content')
<style>
    h1 {
        font-weight: 600 !important;
        font-size: 40px !important;
        line-height: 50px !important;
        text-align: center !important;
        color: #132F75;
        max-width: 68%;
    }
    #register_root a {
        background-color: #FFC400;
        color: #132F75;
        border: 3px solid #FFC400;
        font-size: clamp(1.3125rem, calc(1.0446rem + 1.0989vw), 1.9375rem);
        font-weight: 600;
        letter-spacing: 2px;
        transition: all .2s ease-out;
        cursor: pointer;
        text-decoration: none;
        border-radius: 20px;
        padding:10px 30px;
    }
    #register_root a:hover {
        background-color: transparent;
        color: #132F75;
    }

</style>
    <main class="login_wrapper">
        <div id="register_root">
            <p class="h2 text-center">
                Get access to thousands of clients in your local area create your account as a therapist
            </p>
            <div class="img">
                <img src="{{asset('/imgs/doctor/pendding.jpg')}}" alt="pendding-image">
            </div>
            <h1>
                thank you for submitting one of our staff will verify your documents and contact you soon
            </h1>
            <a href="">Take a a look !</a>
        </div>
    </main>
@endsection
