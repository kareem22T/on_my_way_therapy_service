@extends('site.layouts.mainLayout')

@section('title', 'On My Way | Therapy Services')

@section('content')
    <main style="max-width: 100vw; overflow: hidden">
        <section class="hero" >
            <div class="container lg-grid">
                <div class="g-6 flex-center">
                    <img src="{{ asset('/imgs/site/hero-1.png') }}" alt="hero-img">
                </div>
                <div class="g-6 flex-center">
                    <h4>
                        No more Wait-List, no more Travelling.
                        Just therapy in the comfort of your own home.
                        Anywhere - Anytime
                    </h4>
                    <a href="#how">How it works?</a>
                </div>
            </div>
            <div class="container">
                <div>
                    <a href="/client/register">Find Therapist</a>
                    <span>NDIS & Medicare</span>
                </div>
                <div>
                    <a href="/therapist/register">Join the team</a>
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
            <div class="container lg-grid" style="padding-bottom: 10px">
                <div class="g-4 flex-center">
                    <img src="{{ asset('/imgs/site/map.png') }}" alt="" style="padding: 10px;">
                    <p>On My Way is Australia Wide Anwhere & Anytime</p>
                </div>
                <form action="" class="g-8 lg-grid">
                    <input type="text" name="name" id="name" placeholder="Name" class="g-6">
                    <input type="email" name="email" id="email" placeholder="Email" class="g-6">
                    <textarea name="msg" id="msg" cols="30" rows="7" placeholder="Message" class="g-12"></textarea>
                    <button type="submit"><i class='bx bxs-send'></i></button>
                </form>
                <section>
                    <a href="mailto:Info@onmywaytherapy.com.au"><i class="fa-solid fa-envelope"></i> Info@onmywaytherapy.com.au</a>
                    <a href="tel:1800666992"><i class="fa fa-phone"></i> 1800 ON MY WAY</a>
                </section>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $(window).on('scroll', function () {
                enterAnimation()
            })

            setTimeout(() => {
                enterAnimation()
            }, 550);

            function enterAnimation() {
                if ($(window).scrollTop() >= ($('.hero').offset().top - $(window).height())
                ) {
                    $('.hero >div h4').addClass('animate__animated animate__fadeInUp').css('visibility', 'visible');

                    setTimeout(() => {
                        $('.hero .container:first-child >div a').addClass('animate__animated animate__fadeInUp').css('visibility', 'visible');
                    }, 100);

                    setTimeout(() => {
                        $('.hero img').addClass('animate__animated animate__slideInLeft').css('visibility', 'visible');
                    }, 300);

                    setTimeout(() => {
                        $('.hero .container:nth-child(2) div:first-child a').addClass('animate__animated animate__bounceInLeft').css('visibility', 'visible');
                        $('.hero .container:nth-child(2) div:last-child a').addClass('animate__animated animate__bounceInRight').css('visibility', 'visible');
                    }, 500);

                    setTimeout(() => {
                        $('.hero .container:nth-child(2) div:first-child span').addClass('animate__animated animate__bounceInLeft').css('visibility', 'visible');
                        $('.hero .container:nth-child(2) div:last-child span').addClass('animate__animated animate__bounceInRight').css('visibility', 'visible');
                    }, 700);
                    setTimeout(() => {
                        $('.hero .container:last-child p').addClass('animate__animated animate__fadeInUp').css('visibility', 'visible');
                    }, 900);

                    // if ($(window).scrollTop() <= ($('.how').offset().top - $(window).height())) {
                    //     $('.hero').next().find("*").removeClass('animate__animated animate__fadeInUp animate__bounceInLeft animate__bounceInRight').css('visibility', 'hidden');
                    // }
                } 
                if ($(window).scrollTop() >= ($('.how').offset().top - $(window).height() / 2)) {
                   $('.how .head').addClass('animate__animated animate__fadeInUp').css('visibility', 'visible');
                   setTimeout(() => {
                        $('.how p').addClass('animate__animated animate__bounceInLeft').css('visibility', 'visible');
                        $('.how img').addClass('animate__animated animate__bounceInRight').css('visibility', 'visible');
                   }, 250);
                    setTimeout(() => {
                        $('.how .container div:first-child a').addClass('animate__animated animate__bounceInLeft').css('visibility', 'visible');
                        $('.how .container div:last-child a').addClass('animate__animated animate__bounceInRight').css('visibility', 'visible');
                    }, 400);

                    setTimeout(() => {
                        $('.how .container div:first-child span').addClass('animate__animated animate__bounceInLeft').css('visibility', 'visible');
                        $('.how .container div:last-child span').addClass('animate__animated animate__bounceInRight').css('visibility', 'visible');
                    }, 600);

                    // if ($(window).scrollTop() <= ($('.contact').offset().top - $(window).height())) {
                    //     $('.contact').find("*:not(button)").removeClass('animate__animated animate__fadeInUp animate__bounceInLeft animate__bounceInUp animate__bounceInDown animate__bounceInRight').css('visibility', 'hidden');
                    // }

                }
                if ($(window).scrollTop() >= ($('.contact').offset().top - $(window).height()/ 2))  {
                   $('.contact .head').addClass('animate__animated animate__fadeInUp').css('visibility', 'visible');
                   setTimeout(() => {
                        $('.contact input:first-child').addClass('animate__animated animate__bounceInDown').css('visibility', 'visible');
                   }, 250);
                   setTimeout(() => {
                        $('.contact input').addClass('animate__animated animate__bounceInDown').css('visibility', 'visible');
                        $('.contact button').addClass('animate__animated animate__bounceInDown').css('visibility', 'visible');
                   }, 350);
                   setTimeout(() => {
                        $('.contact textarea').addClass('animate__animated animate__bounceInRight').css('visibility', 'visible');
                   }, 450);
                   setTimeout(() => {
                        $('.contact img').addClass('animate__animated animate__bounceInLeft').css('visibility', 'visible');
                   }, 450);
                   setTimeout(() => {
                        $('.contact p').addClass('animate__animated animate__bounceInLeft').css('visibility', 'visible');
                   }, 550);

                    // $('.hero').find("*").removeClass('animate__animated animate__fadeInUp animate__bounceInLeft animate__bounceInUp animate__bounceInDown animate__bounceInRight').css('visibility', 'hidden');

                }
            }
        })
    </script>

@endsection