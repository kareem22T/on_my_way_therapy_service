@extends('site.layouts.mainLayout')

@section('title', 'Occupational Therapy')

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
        <h1 class="head mb-4"><br>Occupational Therapy</h1>

        <article>
            Looking for an Occupational Therapist near you?
            <br>
            <br>
            Looking for the best occupational therapy services near you? At On My Way therapy, we offer personalized and
            professional OT services to help children and adults reach their full potential. Our experienced and qualified
            occupational therapists use a range of techniques to improve fine motor skills, hand therapy, and sensory
            processing. Whether you or your child is struggling with developmental disorders, neurological conditions,
            physical disabilities, or work-related injuries, we can help. We provide a comprehensive OT assessment to
            determine your needs and develop a tailored rehabilitation plan that fits your goals. With our adaptive
            equipment and specialized pain management techniques, we aim to increase your functional independence and
            enhance your quality of life. Contact us today to schedule an appointment and start your journey to a better
            tomorrow.
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
                <li>Child Occupational Therapy</li>
                <li>Adult Occupational Therapy</li>
            </ul>
            <br>
            <br>
            We have a dedicated team of mobile therapists ready to come to you wherever you are! How good is that?! -
            Children's Occupational Therapy available- Adult Occupational Therapy available Occupational therapy also known
            as OT, is a client-centered health profession concerned with promoting health and well-being through occupation.
            The primary goal of occupational therapy is to enable people to participate in the activities of everyday life.
            Occupational therapists achieve this outcome by working with people and communities to enhance their ability to
            engage in the occupations they want to, need to, or are expected to do, or by modifying the occupation or the
            environment to better support their occupational engagement Occupational therapists work with individuals of
            anyage to promote and enable effective participation in the occupations of everyday life. Occupational
            therapists work with people who experience difficulties in these areas for any reason, and represent in both
            physical disability and mental health services.
            <br>
            <br>
            Give us a call to make a booking or to find out more ​​
            <br>
            <br>
            <ol style="padding-left: clamp(0.625rem, calc(0.1087rem + 2.1739vw), 1.875rem);">
                <li>Rehabilitation</li>
                <li>Fine motor skills</li>
                <li>Hand therapy</li>
                <li>Pediatric occupational therapy</li>
                <li>Adult occupational therapy</li>
                <li>Developmental disorders</li>
                <li>Neurological disorders</li>
                <li>Physical disabilities</li>
                <li>Sensory processing</li>
                <li>Work injuries</li>
                <li>Pain management</li>
                <li>Adaptive equipment</li>
                <li>Occupational therapy services</li>
                <li>OT assessment</li>
                <li>Functional independence</li>
            </ol>
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
