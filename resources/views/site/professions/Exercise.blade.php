@extends('site.layouts.mainLayout')

@section('title', 'Exercise physiology ')

@section('content')
    <style>
        .container article {
            font-style: normal;
            font-weight: 400;
            font-size: clamp(0.8125rem, calc(0.3736rem + 1.8478vw), 1.875rem);
            line-height: clamp(1.125rem, calc(0.6087rem + 2.1739vw), 2.375rem);

            color: #000000;
            padding: 20px clamp(0rem, calc(-0.5163rem + 2.1739vw), 1.25rem);
            ;
        }

        .btns {
            margin: 20px 0;
        }

        @media (max-width: 599.98px) {
            .btns {
                display: flex;
                flex-direction: column
            }
        }

        .btns a {
            display: block;
            text-decoration: none;
            font-weight: 700;
            font-size: clamp(1.125rem, 0.8036rem + 1.3187vw, 1.875rem);
            line-height: clamp(1.125rem, 0.5893rem + 2.1978vw, 2.375rem);
            text-align: center;
            color: #132F75;
            border: clamp(0.125rem, 0.0446rem + 0.3297vw, 0.3125rem) solid #FFC400;
            border-radius: clamp(0.9375rem, 0.5357rem + 1.6484vw, 1.875rem);
            background: #FFC400;
            padding: clamp(0.6875rem, 0.5268rem + 0.6593vw, 1.0625rem) clamp(0.9375rem, 0.2679rem + 2.7473vw, 2.5rem);
        }

        .btns div:last-child a {
            background-color: rgba(255, 255, 255, 0.1960784314);
        }
    </style>
    <div class="container">
        <h1 class="head mb-4"><br>Exercise physiology </h1>

        <article>
            Looking for an Exercise Physiologist near you?
            <br>
            <br>
            <ul style="list-style: inside">
                <li>We provide Home - Anywhere | Anytime</li>
                <li>TeleHealth Services</li>
            </ul>
            <br>
            <br>
            We have a dedicated team of mobile therapists ready to come to you wherever you are! How good is that?!
            <br>
            <br>
            <ul style="list-style: inside">
                <li>Child Exercise Physiology</li>
                <li>Adult Exercise Physiology</li>
            </ul>
            <br>
            <br>
            Accredited exercise physiologists specialise in clinical exercise interventions for people with a broad range of
            health issues. Those people may be at risk of developing, or have existing, medical conditions and injuries. The
            aims of exercise physiology interventions are to prevent or manage acute, sub- acute or chronic disease or
            injury, and assist in restoring one’s optimal physical function, health or wellness. These interventions are
            exercise-based and include health and physical activity education, advice and support and lifestyle modification
            with a strong focus on achieving behavioural change.
            <br>
            <br>
            Should you see an Exercise Physiologist?
            <br>
            <br>
            There are a wide range of reasons why a person may benefit from consulting an accredited exercise physiologist.
            These include chronic disease management referrals after diagnosis of a range of conditions including:
            <br>
            <ul>
                <li>cardiovascular disease</li>
                <li>pulmonary disease</li>
                <li>metabolic disease</li>
                <li>neurological disease</li>
                <li>musculoskeletal disease (including arthritis, osteoporosis/osteopenia, acute and/or chronic
                    musculoskeletal issues)</li>
                <li>depression and other mental health conditions</li>
                <li>cancer</li>
            </ul>
            <br>
            Give us a call or send us an email to make a booking/Referral or to find out more ​​
            1800 ONMYWAY
            <br>
            info@onmywaytherapy.com.au
        </article>

        @if (!Auth::guard('client')->check() && !Auth::guard('doctor')->check())
            <div class="btns lg-grid">
                <div class="g-6">
                    <a href="/client/register">Find a therapist - Book/Refer</a>
                </div>
                <div class="g-6">
                    <a href="/therapist/register">Join the team </a>
                </div>
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
@endsection
