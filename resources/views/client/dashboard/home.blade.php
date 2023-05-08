
@extends('client.layouts.dashboard-layout')

@section('title', 'Home')

@section('home_link', 'active')

@section('content')
<div id="errors">
    {{-- validation errors will appear here. --}}
</div>
<main class="home">
    @if (!isset($therapist) && !isset($search_results))
        <div class="container">
            <h1>
                Hello, {{ Auth::guard('client')->user()->first_name}}
                <br>
                hope you get better soon
                <br>
                what specialist you need?
            </h1>
            <form class="form-group">
                <input type="text" name="search" id="search" placeholder="specialist you need" class="form-control">
                <i class="fa-solid fa-stethoscope"></i>
                <div class="results">
                </div>
            </form>
            <p>
                Feel tired and do not know which medical specialty you need?
                <br>
                <a href="">ask us!</a> Customer service is at your command
            </p>
            <div class="professions_wrapper">
                <h1>Please select your service</h1>
                <div class="professions">
                    @foreach (App\Models\Profession::all() as $profession)
                        <a href="/client/search:{{$profession->title}}" class="profession">
                            <div class="img">
                                <img src="{{ asset('/imgs/professions/' . $profession->id . '.png') }}" alt="">
                            </div>
                            <h4>{{ $profession->title }}</h4>
                            <div class="bg"></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @elseif (isset($therapist))
        <div class="container lg-grid">
            <div class="booking g-7">
                <div class="preview">
                    <div class="left">
                        <div class="calendar">
                        <div class="month">
                            <i class="fas fa-angle-left prev"></i>
                            <div class="date">december 2015</div>
                            <i class="fas fa-angle-right next"></i>
                        </div>

                        <div class="weekdays">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>

                        <div class="days"></div>

                        {{-- <div class="goto-today">
                            <button class="today-btn">Today</button>
                        </div> --}}
                        </div>

                    </div>

                    <div class="right">
                        <h1>Avilable slots</h1>
                        <div class="today-date">
                            <div class="event-day">wed</div>
                            <div class="event-date">12th december 2022</div>
                        </div>

                        <div class="slots">
                            <div start="{{$therapist->working_hours_from}}" to="{{$therapist->working_hours_to}}">
                                <ul>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="visit_type_wraper">
                        <h1>visits type</h1>
                        <div class="form-group">
                            <input type="radio" name="visit_type" id="visit_type_1" value="0">
                            <label for="visit_type_1">Mobile therapy includes</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="visit_type" id="visit_type_2" value="1">
                            <label for="visit_type_2">telehealth online sessions</label>
                        </div>
                    </div>
                </div>
                <button id="confirm_appointment" doctor_id="{{$therapist->id}}">Confirm</button>
            </div>

            <div class="profile_wrapper g-5">
                <div class="profile">
                    <div class="img">
                        <img src="{{ asset('/imgs/doctor/uploads/therapist_profile/'. $therapist->photo) }}" alt="">
                    </div>
                    <h1 class="name">Dr.{{ $therapist->first_name . ' ' . $therapist->last_name }}</h1>
                    <span class="rate">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </span>
                    <h3 class="profession">{{ $therapist->profession->title }}</h3>
                    <p class="distance">10Km away from you</p>
                    <p class="about">
                        {{ $therapist->about_me }}
                    </p>
                    <div class="bg-border"></div>
                </div>
                <a href="">find another one</a>
            </div>
        </div>
        @section('scripts')
            <script src="{{ asset('/js/doctor/calendar.js') }}"></script>
            <script src="{{ asset('/js/client/calendar.js') }}"></script>
        @endsection
    @elseif (isset($search_results))
        @if (count($search_results) > 0)
        <div class="container search_wrapper">
        <div class="form-group g-3 mt-0 mb-2">
            <input type="text" name="search" id="search" placeholder="specialist you need" class="form-control">
            <i class="fa-solid fa-stethoscope"></i>
            <div class="results">
            </div>
        </div>
        <h2 class="g-3 text-center mb-2">
            {{ $search }} therapists
        </h2>

        @foreach ($search_results as $therapist)
            <a href="/client/therapist{{'@' . $therapist->first_name . '_' . $therapist->id}}" class="therapist_overview" target="_blanck">
                <div class="img">
                    <img 
                    src="{{asset('imgs/doctor/uploads/therapist_profile/' . $therapist->photo)}}" 
                    alt="{{$therapist->first_name}}">
                </div>
                <h3>{{ $therapist->first_name . ' ' . $therapist->last_name }}</h3>
                <span class="rate">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                </span>
                <p class="distance">10Km away from you</p>
                <h4>
                    {{$therapist->experience}} years of experience
                </h4>
                <div class="bg"></div>
            </a>
        @endforeach
        @else
            <div class="container" 
                style="
                display: flex;
                flex-direction: column;
                gap: 0;">
                <h1 class="mb-3">Try again</h1>
                <div class="form-group g-2 mt-0 mb-5">
                    <input type="text" name="search" id="search" placeholder="specialist you need" class="form-control">
                    <i class="fa-solid fa-stethoscope"></i>
                    <div class="results">
                    </div>
                </div>
                <img src="{{ asset('/imgs/search_not_found.png') }}" alt="" style="margin: auto;width: 400px;">
                <h1>No results found !</h1>
                <h3 class="text-center">Records doesn't match, there is no therapists unfortunately</h3>
            </div>
        @endif
        </div>
    @else
    sajdj
    @endif
</main>
@endSection

@section('scripts')
    <script src="{{ asset('/js/client/search.js') }}"></script>
@endsection

