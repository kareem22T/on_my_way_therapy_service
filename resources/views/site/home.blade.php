@extends('site.layouts.mainLayout')

@section('title', 'On My Way | Therapy Services')

@section('content')
    <main>
        <section class="hero">
            <div class="container lg-grid">
                <div class="g-6 flex-center">
                    <img src="{{ asset('/imgs/site/hero.png') }}" alt="hero-img">
                </div>
                <div class="g-6 flex-center">
                    <h4>
                        No more Wait-List, no more Travelling. Just Therapy in the comfort of your own home Anywhere - Anytime
                    </h4>
                    <a href="#how">How it works?</a>
                </div>
            </div>
            <div class="container">
                <div>
                    <a href="">Find Therapist</a>
                    <span>NDIS & Medicare</span>
                </div>
                <div>
                    <a href="">Join the team</a>
                    <span>as a therapist</span>
                </div>
            </div>
            <div class="container">
                <p>
                    If you're an NDIS Participant, NDIS Plan Manager, NDIS Support Coordinator, in Aged Care, have Medicare, or a Work-cover injury, Then On My Way Therapy Service is for you!
                </p>
            </div>
        </section>

        <section class="how">
            <h1 class="head"><div id="how"></div>How it works?</h1>
            <div class="container lg-grid">
                <div class="g-8 flex-center">
                    <p>
                        On My Way finds you the right therapist in your area based on your desired location, you then book an appointment with them at a time that suits you both. The therapist will then come to your home or make a telehealth call with you wherever you are. Simple!
                    </p>
                </div>
                <div class="g-4 flex-center">
                    <img src="{{ asset('/imgs/site/how.png') }}" alt="How-it-work">
                </div>
            </div>
            <div class="container">
                <div>
                    <a href="{{ route('help.client') }}" target="_blanck">More details</a>
                    <span>As Client/Referrer</span>
                </div>
                <div>
                    <a href="{{ route('help.therapy') }}" target="_blanck">More details</a>
                    <span>as a therapist</span>
                </div>
            </div>
        </section>

        <section class="contact">
            <h1 class="head">contact us or leave  a feedback</h1>
            <div class="container lg-grid">
                <div class="g-4 flex-center">
                    <img src="{{ asset('/imgs/site/map.png') }}" alt="">
                    <p>On My Way is Australia Wide Anwhere & Anytime</p>
                </div>
                <form action="" class="g-8 lg-grid">
                    <input type="text" name="name" id="name" placeholder="Name" class="g-6">
                    <input type="email" name="email" id="email" placeholder="Email" class="g-6">
                    <textarea name="msg" id="msg" cols="30" rows="7" placeholder="Message" class="g-12"></textarea>
                    <button type="submit"><i class='bx bxs-send'></i></button>
                </form>
            </div>
        </section>
    </main>
@endsection