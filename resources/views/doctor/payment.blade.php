@extends('doctor.layouts.register-layout')

@section("title", "Recive payment")

@section("content")
    <div id="errors">
        {{-- validation errors will appear here. --}}
    </div>
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
            <form action="POST" class="payment_form" id="step-3" >
                @csrf
                <div class="form-group">
                    <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="BSB" id="BSB " placeholder="BSB" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="bank_account" id="Account" placeholder="Account" class="form-control">
                </div>
                <div class="form-group have_one">
                    <input type="text" name="ABN" id="ABN" placeholder="ABN number" class="form-control">
                    <a href="">don’t have one?</a>
                </div>
                <div class="form-group choice">
                    <input type="checkbox" name="agree" id="agree" style="width: auto;" value="1">
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

@section('scripts')
<script src="{{ asset('/js/doctor/get-payment.js') }}"></script>
@endsection