@extends('client.layouts.register-layout')

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
                    Is On My Way Therapy Australia a registered NDIS provider?
                </div>
                <div class="a">
                    Yes, we are a registered NDIS provider of Therapeutic supports providing HealthCare services.
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    Do you provide services to NDIS Clients?
                </div>
                <div class="a">
                    Yes absolutely! with On My Way Therapy we provide Therapeutic support services to all NDIS clients
                    weather NDIS managed, Self-managed or Plan-managed.
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    During the sign up process, is my address used to calculate travel charges?
                </div>
                <div class="a">
                    That’s right, we use your address and the therapist address to automatically calculate travel charges so
                    you know right away how much a session will cost.
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    I am NDIS self managed, is this why you collect my Card Details?
                </div>
                <div class="a">
                    We safely collect and store your card details if you are self managed and only process payment once a
                    session has been completed. The same way you would at a physical clinic. Furthermore you will receive a
                    receipt directly to your email address provided
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    Can I change therapist if I’m not happy with the service?
                </div>
                <div class="a">
                    Based on your sign up information provided, our platform matches you to the most appropriate therapist
                    both in your local area or nationwide allowing you to connect with the most suitable therapist. You of
                    course always have the option to change therapists anytime.
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    I’m on Medicare, am I able to use your services and how?
                </div>
                <div class="a">
                    Soon you will be able to use your Medicare funding on our platform. You will need to see your doctor who
                    will issue you an EPS plan allowing you to have 5 sessions covered by Medicare during a the calendar
                    year.
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    I have private health cover, am I able to use your services and how?
                </div>
                <div class="a">
                    Soon you will be able to use your private health cover on our platform! You will need to provide us with
                    your private health cover information the same way you would inside a clinic. Allowing you to book with
                    any therapist a home visit or telehealth appointment anywhere in Australia
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    How much do you charge NDIS Clients?
                </div>
                <div class="a">
                    On my way therapy follows the NDIS Price Guide and reduces it by an additional 5% allowing you to make
                    the most out of your plan with us!
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    How much do you charge Private paying clients?
                </div>
                <div class="a">
                    We try and keep our prices as low as possible allowing Australians to have access to healthcare wherever
                    they are. We therefore charge $92.5 for a 30 minute session plus a fixed travel charge depending on
                    location.
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    How much do you charge Private health clients?
                </div>
                <div class="a">
                    Based on a $92.5 for a 30 minute session we automatically calculate your cover and charge the gap if
                    there is one.
                </div>
            </div>
            <div class="q_wrapper">
                <div class="q">
                    <i class="fa fa-plus"></i>
                    How much do you charge Medicare clients?
                </div>
                <div class="a">
                    Based on a for a 30 minute session we automatically calculate the gap payment and advise you of the cost
                    difference.
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
