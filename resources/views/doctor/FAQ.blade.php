@extends('doctor.layouts.register-layout')

@section('title', 'FAQ')

@section('content')
    <div id="errors">
        {{-- validation errors will appear here. --}}
    </div>
    <style>
        h1 {
            text-align: center;
            margin-top: 30px;
            font-weight: 700;
            color: rgba(19, 47, 117, 1);
            font-size: clamp(1.25rem, calc(0.9918rem + 1.087vw), 1.875rem);
        }

        .faq_wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .q_wrapper {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .q {
            font-size: clamp(1rem, calc(0.8967rem + 0.4348vw), 1.25rem);
            font-weight: 600;
            padding: 10px;
            background: #f1f1f1;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            cursor: pointer !important;
        }

        .a {
            padding: 10px;
            background: #fff;
            border-radius: 10px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            display: none;
        }
    </style>
    <h1>Frequently asked questions</h1>
    <main>
        <div class="faq_wrapper w-100">
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    A lot of therapists are doing home visits I want to be able to do the same
                    with confidence. So how is my
                    safety being considered?
                </div>
                <div class="a">
                    We take safety very seriously as the wellbeing of our therapists is our number one priority. Every
                    client that signs up to with us is screened and must complete a service agreement and a risk assessment
                    which is available for you to sight before agreeing to any visit. Additionally we have an emergency
                    button feature on the website/app that when clicked will automatically call 000 and our staff
                    immediately.
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    During sign up, is my address and travel radios which I select being used to connect me to clients near
                    me?
                </div>
                <div class="a">
                    Yes, we use the address provided and travel radios selected we connect you to clients near you. We also
                    calculate your travel pay based on your location and client location.
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    why do I need to provide my ABN number?
                </div>
                <div class="a">
                    You will be operating as an independent contractor, choosing your own working hours and time. Giving you
                    the flexibility to work when you want, wherever you want.

                    If you wish to be working as an employee of a fixed salary please contact us directly.
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    do I need to have my own insurances?
                </div>
                <div class="a">
                    On My Way therapy does have its own insurances to protect our therapist and staff, however we do
                    recommend you follow your governing body and require you to also have our own professional indemnity and
                    public liability cover.
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    how do I get paid?
                </div>
                <div class="a">
                    During sign up, you are asked to provide us with your banking details which will automatically pay you
                    on. Our platform will automatically create an invoice and generated and a receipt. So you don’t have to
                    worry about administrative tasks in crating invoices or claiming.
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    how frequently do I get paid?
                </div>
                <div class="a">
                    You will be paid within 7 days after a session has taken place
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    Am I required to maintain my own session notes?
                </div>
                <div class="a">
                    Just like you would in any other setting, you are required to maintain and keep all session notes on the
                    platform.
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    Can I travel further than my travel radios?
                </div>
                <div class="a">
                    You can always adjust your travel radios on your profile, giving you acess to more clients near you.
                    Clients outside your travel radios will be given an option to book TeleHealth with you if you have
                    selected this option on your profile
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    How much do I get paid?
                </div>
                <div class="a">
                    We pride ourselves on paying exceptional rates to our therapists. You will be paid $139 per hour of
                    service such as therapy time or reports. Additional you will be paid 80 Cents per kilometre of travel
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    Do I need to sign up with the NDIS to be on your platform or have access to NDIS clients?
                </div>
                <div class="a">
                    No, the beautiful thing about being on our platform is that you do not need to personally register to
                    the NDIS. On My Way Therapy is a registered NDIS provider.
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('.q').on('click', function() {
                $(this).parent().find('.a').fadeToggle();
            })
        })
    </script>
@endsection
