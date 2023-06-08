@extends('site.layouts.mainLayout')

@section('title', 'Psychology')

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
        <h1 class="head mb-4"><br>Psychology</h1>

        <article>
            Looking for a Psychologist near you?
            <br>
            <br>
            Psychology is the scientific study of human behaviour, thought, and experience. It encompasses a wide range of
            topics, from mental health and personality to social behaviour and cognitive processes. Understanding psychology
            can help individuals improve their relationships, work lives, and overall well-being. Whether you're seeking
            information for personal growth, or as a professional in the field, there are many resources available to help
            you deepen your understanding of psychology.
            <br>
            <br>
            On My Way Therapy is dedicated to providing high-quality and comprehensive healthcare services, including
            psychology. With a team of experienced and knowledgeable psychologists, Cross Care Health offers a wide range of
            psychological services to help individuals improve their mental well-being. Whether you're seeking support for a
            specific mental health condition, or simply looking to enhance your overall emotional and psychological health,
            On My Way Therapy has the expertise to help.
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
                <li>Child Psychology</li>
                <li>Adult Psychology</li>
            </ul>
            <br>
            <br>
            Psychology is both a science and a profession, devoted to understanding how people think, feel, behave and
            learn. In essence, psychology studies individuals and groups to better understand how people, communities and
            societies function and ways to help them thrive.
            <br>
            What does a Psychologist do?
            <br>
            The goal of Psychology is not just to study humanthinking and behaviour, but to put that knowledgeinto practice,
            to help people, communities, andsociety in general, to solve day-to-day problems andimprove quality of life.
            <br>
            Psychologists seek to understand how the mind works and why people behave the way they do. At Cross Care, we aim
            to engage in an open and trusting environment to help the client by attending to the patient's needs and
            addressing issues.
            <br>
            <br>
            <ol style="padding-left: clamp(0.625rem, calc(0.1087rem + 2.1739vw), 1.875rem);">
                <li>Abnormal Psychology</li>
                <li>Child Psychology</li>
                <li>Clinical Psychology</li>
                <li>Cognitive Psychology</li>
                <li>Counseling Psychology</li>
                <li>Developmental Psychology</li>
                <li>Educational Psychology</li>
                <li>Forensic Psychology</li>
                <li>Health Psychology</li>
                <li>Mental Health</li>
                <li>Mental Illness</li>
                <li>Neuropsychology</li>
                <li>Organizational Psychology</li>
                <li>Personality Psychology</li>
                <li>Social Psychology</li>
                <li>Stress Management</li>
            </ol>
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
