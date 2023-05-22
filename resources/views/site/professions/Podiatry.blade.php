@extends('site.layouts.mainLayout')

@section('title', 'Podiatry')

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
        <h1 class="head mb-4"><br>Podiatry</h1>

        <article>
            Are you looking for a Podiatrist near you?
            <br>
            <br>
            Discover the best in NDIS and medicare-approved podiatry services at On My Way Therapy. Our team of skilled and
            certified podiatrists specialize in providing comprehensive foot and ankle care, using the latest techniques and
            evidence-based approaches. We offer personalized treatment plans for a range of conditions, including foot and
            ankle pain, foot injuries, and foot conditions related to disabilities. Our commitment to quality care make On
            My Way Therapy the top choice for NDIS podiatry Medicare Podiatry or private Health P iatry. Book an appointment
            with one of our expert podiatrists today and take the first step towards the improved foot and ankle health
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
                <li>Child Podiatry services</li>
                <li>Adult Podiatry services</li>
            </ul>
            <br>
            <br>
            When it comes to looking after your health, it’s easy to forget about your feet. But given you could walk about
            128,000 km in your lifetime, healthy feet are an important part of your overall well-being. Foot problems can
            have a huge impact on your quality of life. If they occur, podiatrists can help.
            What does a podiatrist do?
            <br>
            Podiatrists are experts in the foot, ankle and lower limb health. They can help to prevent, diagnose and treat a
            wide range of conditions including:
            <br>
            <br>
            <ul style="list-style: inside">
                <li>Ingrown toenails</li>
                <li>Biomechanical assessment</li>
                <li>Heel and arch pain</li>
                <li>Skin problems</li>
                <li>General foot care treatment, (skin and nails)</li>
                <li>Balance issues</li>
                <li>Sprains</li>
                <li>Hip Problems</li>
                <li>Nail Surgery</li>
            </ul>
            <br>
            <br>
            They can also treat foot problems that arise from underlying medical conditions such as diabetes and arthritis.
            <br>
            Your podiatrist’s recommendations might include specific exercises, the use of custom-made inserts for your
            shoes, or medications to treat skin conditions.
            <br>
            <br>
            Give us a call or send us an email to make a booking/Referral or to find out more ​​
            1800 ONMYWAY
            <br>
            info@onmywaytherapy.com.au
        </article>

        <div class="btns lg-grid">
            <div class="g-6">
                <a href="/client/register">Find a therapist - Book/Refer</a>
            </div>
            <div class="g-6">
                <a href="/therapist/register">Join the team </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
@endsection
