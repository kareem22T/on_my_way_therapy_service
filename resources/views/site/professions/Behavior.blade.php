@extends('site.layouts.mainLayout')

@section('title', 'Behavior Therapy ')

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
        <h1 class="head mb-4"><br>Behavior Therapy </h1>

        <article>
            Looking for a Behaviour Therapist near you?
            <br>
            <br>
            Discover the best behaviour therapy services at On My Way Therapy. Our experienced therapists use positive and
            evidence-based approaches to help children and adults overcome behavioural challenges and improve their mental
            health. With personalized treatment plans and a focus on the quality of life, we strive to provide the support
            and care our clients need to achieve mental wellness. Contact us today to schedule a consultation and start your
            journey to better behavioural health.
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
                <li>Child Behaviour Therapy</li>
                <li>Adult Behaviour Therapy</li>
            </ul>
            <br>
            <br>
            What is Positive Behaviour Support:
            <br>
            Positive Behavior Support (PBS) is a proactive, evidence-based approach to promoting positive behaviors and
            reducing challenging behaviors. It involves identifying the reasons or functions of a challenging behavior and
            then implementing strategies to teach and encourage more appropriate and desirable behaviors. The focus is on
            understanding the individual's needs, preferences, and strengths, and creating an environment that supports
            positive behavior while addressing the underlying causes of challenging behavior. PBS aims to enhance quality of
            life for individuals, and can be used in a variety of settings, including homes, schools, and workplaces.
            <br>
            <br>
            What does PBS involve?
            <br>
            Positive Behavior Support (PBS) involves several components, including:
            <br>
            <br>
            <ol style="padding-left: clamp(0.625rem, calc(0.1087rem + 2.1739vw), 1.875rem);">
                <li>
                    Functional Behavioral Assessment (FBA): A process used to identify the reason(s) behind a challenging
                    behavior. This involves gathering information about the individual's environment, behavior, and the
                    consequences that follow the behavior.
                </li>
                <li>
                    Person-centered planning: A collaborative process between the individual, their family, and
                    professionals to develop a plan that addresses the individual's needs, preferences, and strengths.
                </li>
                <li>
                    Teaching alternative skills: This involves teaching the individual new skills that can replace the
                    challenging behavior. For example, teaching communication skills, self-regulation skills, and social
                    skills.
                </li>
                <li>
                    Environmental modifications: This involves modifying the environment to prevent or reduce the likelihood
                    of challenging behavior from occurring. For example, creating visual schedules or providing sensory
                    support.
                </li>
                <li>
                    Positive reinforcement: This involves using positive consequences to increase the likelihood of
                    desirable behavior occurring. For example, providing praise, rewards, or access to preferred activities.
                </li>
                <li>
                    Monitoring and data collection: Regularly monitoring and collecting data to evaluate the effectiveness
                    of the interventions and make adjustments as needed.
                </li>
            </ol>
            <br>
            <br>
            Overall, PBS is a collaborative and evidence-based approach that focuses on preventing and reducing challenging
            behavior while promoting positive behavior and enhancing the individual's quality of life.
            <br>
            What is a restricted practice?
            <br>
            A restricted practice is a type of intervention or action that restricts the rights or freedom of movement of a
            person with a disability, and is used to manage their behavior. Examples of restricted practices include
            physical restraints, seclusion, and chemical restraints (i.e. medications used to control behavior). These
            practices can only be used in very specific circumstances and are subject to strict regulations and oversight to
            ensure that they are only used as a last resort when all other interventions have failed and the person's safety
            or the safety of others is at risk.
            <br>
            <br>
            How can my therapist work with me to reduce restricted practices?
            <br>
            Your therapist can work with you to develop a positive behavior support plan that identifies the function of the
            behaviors and provides alternative behaviors that meet the same function. The plan may also include teaching
            replacement skills, modifying the environment, and reinforcing positive behaviors. By addressing the underlying
            reasons for the behaviors and providing alternatives, the need for restrictive practices can be reduced.
            Additionally, your therapist can work with you to create a crisis plan that outlines steps to take in the event
            that a behavior of concern does occur, with the goal of reducing the need for restrictive practices.
            <br>
            <br>
            Who can PBS Practitioners work with?
            <br>
            PBS practitioners can work with individuals of all ages and abilities who display behaviors of concern, such as
            challenging behaviors or mental health conditions. This includes individuals with developmental disabilities,
            mental health disorders, traumatic brain injuries, and other conditions that affect behavior. PBS practitioners
            can also work with families, caregivers, and support staff to help them understand and implement positive
            behavior support strategies in daily life. They may work in a variety of settings, including schools, homes,
            group homes, and residential facilities.
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
