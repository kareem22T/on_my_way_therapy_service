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

            
            <section class="extra_section" id="therapy">
                <h1 class="head">The expected earnings from your work with us</h1>
                <div class="btns">
                    <button class="active">Full-time</button>
                    <button>Part time</button>
                </div>
                <div class="full-time">
                    <input class="custom-range" type="range" value="50" min="50" max="100" v-model="fullval">
                    <div class="value">
                        <output>@{{ fullval }} hours per week</output>
                        <span class="max">100</span>
                    </div>
                    <a href="">= @{{ fullval * 50 }}$</a>
                </div>
                <div class="part-time">
                    <input class="custom-range" type="range" value="35" min="35" max="50" v-model="partval">
                    <div class="value">
                        <output>@{{ partval }} hours per week</output>
                        <span class="max">50</span>
                    </div>
                    <a href="">= @{{ partval * 50 }}$</a>
                </div>
            </section>

            <section>
                <a href="">Let’s start!</a>
                <p>Sign up today and start making a difference in your clients’ lives.</p>
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

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <script>
    const { createApp } = Vue

    createApp({
        data() {
        return {
            fullval: 50,
            partval: 35,
        }
        }
    }).mount('#therapy')
    </script>

    <script>
        $(function () {
            $('.btns button:first-child').on('click', function () {
                $('.part-time').fadeOut();
                setTimeout(() => {
                    $('.full-time').fadeIn().css('display', 'flex');
                }, 100);
                $(this).addClass('active');
                $(this).siblings().removeClass('active');
            })
            $('.btns button:last-child').on('click', function () {
                $('.full-time').fadeOut();
                setTimeout(() => {
                    $('.part-time').fadeIn().css('display', 'flex');
                }, 100);
                $(this).addClass('active');
                $(this).siblings().removeClass('active');
            })
        })
    </script>

@endsection
