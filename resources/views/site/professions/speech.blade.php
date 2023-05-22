@extends('site.layouts.mainLayout')

@section('title', 'Speech Pathology')

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
        <h1 class="head mb-4"><br>Speech Pathology</h1>

        <article>
            ​Are you looking for a Speech Pathologist near you?
            <br>
            <br>
            Discover exceptional speech therapy services. Speech pathology services are essential for individuals struggling
            with communication difficulties. With the support of the National Disability Insurance Scheme (NDIS), people
            with disabilities can access top-quality speech therapy services. At On My Way Therapy, we provide certified
            NDIS speech pathologists who are experienced in helping children and adults overcome a range of speech
            difficulties, from stuttering to language delay. Our speech therapists offer personalized speech therapy
            services to improve communication skills and enhance the quality of life. With our dedicated and compassionate
            approach, we strive to make speech therapy accessible and affordable for everyone who needs it. So, take the
            first step to better communication today and contact us to schedule a speech and language assessment.
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
                <li>Child Speech Pathology </li>
                <li>Adult Speech Pathology</li>
            </ul>
            <br>
            <br>
            Speech Pathologists study, diagnose and treat communication disorders, including:
            <br>
            <br>
            <ul style="list-style: inside">
                <li>Difficulties with speaking,</li>
                <li>Listening,</li>
                <li>Understanding language,</li>
                <li>Reading,</li>
                <li>Writing,</li>
                <li>Social skills,</li>
                <li>Stuttering and using voice</li>
                <li>Difficulty communicating because of developmental delays,</li>
                <li>Stroke,</li>
                <li>Brain injuries,</li>
                <li>Learning disability,</li>
                <li>Intellectual disability,</li>
                <li>Cerebral palsy,</li>
                <li>Dementia and hearing loss,</li>
                <li>Problems that can affect speech and language</li>
                <li>Difficulties swallowing food and drinking safely</li>
                <li>Communication disorders</li>
                <li>Speech difficulties</li>
                <li>Language delay</li>
                <li>Pediatric speech therapy</li>
                <li>Adult speech therapy</li>
                <li>Speech and language assessment</li>
                <li>Speech therapy services</li>
                <li>Stuttering</li>
                <li>Articulation disorder</li>
                <li>Fluency disorder</li>
                <li>Voice disorder</li>
                <li>Speech therapy for disabilities</li>
            </ul>
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
