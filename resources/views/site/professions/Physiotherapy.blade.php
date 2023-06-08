@extends('site.layouts.mainLayout')

@section('title', 'Physiotherapy')

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
        <h1 class="head mb-4"><br>Physiotherapy</h1>

        <article>
            Are you looking for a Physio near you?
            <br>
            <br>
            Find the best physiotherapy services at On My Way Therapy. Our dedicated team of physiotherapists specialize in
            rehabilitation, injury recovery, and pain management, using the latest techniques and evidence-based approaches.
            We offer personalized treatment plans for a range of conditions, including neck and back pain, joint pain,
            sports injuries, and post-surgery rehabilitation. Our commitment to quality care make On My Way Therapy the top
            choice for physiotherapy. Book an appointment with one of our expert physiotherapists today.
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
                <li>Child Physiotherapy services</li>
                <li>Adult Physiotherapy services</li>
            </ul>
            <br>
            <br>
            Our physiotherapists specialise in a variety of conditionsIncluding but not limited to:
            <br>
            <br>
            <ul style="list-style: inside">
                <li>Musculoskeletal injuries</li>
                <li>Overuse injuries</li>
                <li>Neck and back pain</li>
                <li>knee and hip injuries</li>
                <li>Migraines and headaches</li>
                <li>Balance and vestibular inefficiencies</li>
                <li>Cardio-respiratory conditions</li>
                <li>Joint mobilisation</li>
                <li>General mobility and wellbeing</li>
                <li>Exercise-based movements for muscle strengthening</li>
                <li>Rehabilitation</li>
                <li>Pain management</li>
                <li>Injury recovery</li>
                <li>Physical therapy</li>
                <li>Musculoskeletal</li>
                <li>Exercise therapy</li>
                <li>Sports injuries</li>
                <li>Manual therapy</li>
                <li>Neck and back pain</li>
                <li>Joint pain</li>
                <li>Post-surgery rehabilitation</li>
                <li>Geriatric physiotherapy</li>
                <li>Movement therapy</li>
            </ul>
            <br>
            <br>
            Our physiotherapists are hands-on and provide a range of services that include but not limited to; education,
            individualised and group exercise classes and patient-centered dynamic therapeutic techniques (providing acute
            treatment for injuries and maintenance treatment to ensure patient’s muscles can endure the heavy load of
            training)
            <br>
            <br>
            ​Cross Care in Smithfield, Sydney, offers top-notch physiotherapy services for individuals with disabilities,
            including those covered by the NDIS. Our team of experienced and certified physiotherapists specialize in
            rehabilitation, injury recovery, and pain management, using evidence-based approaches and personalized treatment
            plans. We understand the unique needs of individuals with disabilities and offer services to help them improve
            their
            physical health and quality of life. From neck and back pain, to joint pain, sports injuries, and post-surgery
            rehabilitation, we are equipped to handle a range of conditions. Book an appointment with one of our
            NDIS-approved
            physiotherapists today and take the first step towards improved physical wellness
            <br>
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
