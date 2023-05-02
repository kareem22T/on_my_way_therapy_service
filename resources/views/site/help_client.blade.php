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
                        <img src="{{ asset('/imgs/site/client-help-2.png') }}" alt="">
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
                <a href="/client/register">Let’s start!</a>
                <p>Join us today and get the care you deserve.</p>
            </section>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $(window).on('scroll', function () {
                enterAnimation()
            })

            setTimeout(() => {
                enterAnimation()
            }, 400);

            function enterAnimation() {
                if ($(window).scrollTop() >= ($('section:first-child').offset().top - $(window).height() / 2)) {
                    $('section:first-child').find('.img').addClass('animate__animated animate__fadeInUp').css('visibility', 'visible');
                    setTimeout(() => {
                        $('section:first-child').find('.text').addClass('animate__animated animate__fadeInUp').css('visibility', 'visible');
                    }, 250);
                }
                if ($(window).scrollTop() >= ($('section:nth-child(2)').offset().top - $(window).height() / 1.2)) {
                    $('section:nth-child(2)').find('.img').addClass('animate__animated animate__fadeInUp').css('visibility', 'visible');
                    setTimeout(() => {
                    $('section:nth-child(2)').find('.text').addClass('animate__animated animate__fadeInUp').css('visibility', 'visible');
                    }, 250);
                }
                if ($(window).scrollTop() >= ($('section:nth-child(4)').offset().top - $(window).height() / 1.2)) {
                    $('section:nth-child(4)').find('.img').addClass('animate__animated animate__fadeInUp').css('visibility', 'visible');
                    setTimeout(() => {
                    $('section:nth-child(4)').find('.text').addClass('animate__animated animate__fadeInUp').css('visibility', 'visible');
                    }, 250);
                }
                if ($(window).scrollTop() >= ($('section:nth-child(3)').offset().top - $(window).height() / 1.2)) {
                    $('section:nth-child(3)').find('.img').addClass('animate__animated animate__fadeInUp').css('visibility', 'visible');
                    setTimeout(() => {
                    $('section:nth-child(3)').find('.text').addClass('animate__animated animate__fadeInUp').css('visibility', 'visible');
                    }, 250);
                }
            }
        })
    </script>
@endsection
