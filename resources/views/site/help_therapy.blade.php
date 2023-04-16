@extends('site.layouts.mainLayout')

@section('title', 'Details as Therapy')

@section('content')
    <div class="container help-wrapper">
        <main>
            <section>
                <h1 class="head">Are you a therapist?</h1>
                <div>
                    <div class="img">
                        <img src="{{ asset('/imgs/site/therapy-help-1.png') }}" alt="">
                    </div>
                    <div class="text">
                        Work when you want, Wherever you want! Work independently with a full calendar at full capacity or simply see a few clients on the weekend. The choice is yours!
                    </div>
                </div>
            </section>

            <section>
                <div>
                    <div class="img">
                        <img src="{{ asset('/imgs/site/therapy-help-2.png') }}" alt="">
                    </div>
                    <div class="text">
                        Join our platform and have access to thousands of clients. Become part of a network of therapists who offer mobile visits or Telehealth consultations to clients.
                    </div>
                </div>
            </section>

            <section>
                <div>
                    <div class="img">
                        <img src="{{ asset('/imgs/site/therapy-help-3.png') }}" alt="">
                    </div>
                    <div class="text">
                        You can set your own schedule & client preferences, and we will match you with clients looking for your services.
                    </div>
                </div>
            </section>

            <section>
                <div>
                    <div class="img">
                        <img src="{{ asset('/imgs/site/therapy-help-4.png') }}" alt="">
                    </div>
                    <div class="text">
                        Whether you want to supplement your income, reduce your overhead costs or expand your client list, our platform can help you achieve your goals. We reducing administrative time by looking after invoicing, claims and pay you directly and confidently
                    </div>
                </div>
            </section>

            <section>
                <a href="">Let’s start!</a>
                <p>Sign up today and start making a difference in your clients’ lives.</p>
            </section>
        </main>
    </div>
@endsection
