@extends('site.layouts.mainLayout')

@section('title', 'Details as client')

@section('content')
    <div class="container help-wrapper">
        <main>
            <section>
                <h1 class="head">Looking for therapist?</h1>
                <div>
                    <div class="img">
                        <img src="{{ asset('/imgs/site/client-help-1.png') }}" alt="">
                    </div>
                    <div class="text">
                        Do you need to see a therapist but don’t have time to go to a clinic, look for parking and fight the traffic? Are you tired of long Wait-Lists?
                    </div>
                </div>
            </section>

            <section>
                <div>
                    <div class="img">
                        <img src="{{ asset('/imgs/site/client-help-2.png') }}" style="width: 80%;" alt="">
                    </div>
                    <div class="text">
                        Or perhaps you live in a remote location and cant get the therapy you need. Simply get medical attention in the comfort of your own home or through Telehealth?
                    </div>
                </div>
            </section>

            <section>
                <div>
                    <div class="img">
                        <img src="{{ asset('/imgs/site/client-help-3.png') }}" alt="">
                    </div>
                    <div class="text">
                        If so, our platform is for you. We connect you with qualified and experienced therapists who can provide you with home visits or telehealth consultations wherever you are Nationwide.
                    </div>
                </div>
            </section>

            <section>
                <div>
                    <div class="img">
                        <img src="{{ asset('/imgs/site/client-help-4.png') }}" alt="">
                    </div>
                    <div class="text">
                        You can choose the therapist that best suits your needs, book an appointment online. Our platform will look after the rest.
                    </div>
                </div>
            </section>

            <section>
                <a href="">Let’s start!</a>
                <p>Join us today and get the care you deserve.</p>
            </section>
        </main>
    </div>
@endsection
