@extends('doctor.layouts.register-layout')

@section("title", "Recive payment")

@section("content")
    <main class="login_wrapper">
        <div id="register_root">
            <p class="h2 text-center">
                Get access to thousands of clients in your local area create your account as a therapist
            </p>
            <ul class="steps">
                <li class="finished">1</li>
                <li class="finished">2</li>
                <li class="active">3</li>
            </ul>
            <h1>
                Receive payment
            </h1>
            <form action="POST" class="payment_form" id="step-1-v2" autocomplete="off">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="BSB " id="BSB " placeholder="BSB" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="Account" id="Account" placeholder="Account" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="ABN number" id="ABN number" placeholder="ABN number" class="form-control">
                </div>
                <div class="form-group choice">
                    <input type="checkbox" name="agree" id="agree" style="width: auto;">
                    <label class="agree" for="agree">agree on our <a href="">terms and policy</a></label>
                </div>

                <div class="form-group g-12 not-step-1">
                    <button>Back</button>
                    <button type="submit">Finish</button>
                </div>
            </form>
        </div>
    </main>
@endsection