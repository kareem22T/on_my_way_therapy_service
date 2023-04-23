@extends('doctor.layouts.register-layout')

@section("title", "step 2 | information")

@section("content")
    <main class="login_wrapper">
        <div id="register_root">
            <p class="h2 text-center">
                Get access to thousands of clients in your local area create your account as a therapist
            </p>
            <ul class="steps">
                <li class="finished">1</li>
                <li class="active">2</li>
                <li>3</li>
            </ul>
            <form action="POST" class="lg-grid" id="step-1-v2" autocomplete="off">
                @csrf
                <div class="form-group g-4">
                    <input type="text" name="profession" id="profession" placeholder="profession">
                </div>
                <div class="form-group g-4">
                    <select name="client_gender" id="client_gender"  class="form-control">
                        <option value="">Preferred client gender</option>
                    </select>
                </div>
                <div class="form-group g-4">
                    <input type="number" name="experience" id="experience" placeholder="Years of experience " class="form-control">
                </div>
                <div class="form-group g-12">
                    <input type="text" name="diagnosis" id="diagnosis" placeholder="Preferred client diagnosis" class="form-control">
                </div>
                <div class="form-group g-4 file">
                    <input type="file" name="WWCC" id="WWCC" placeholder="WWCC check" class="form-control">
                    <label for="WWCC">WWCC check <i class="fa-solid fa-camera"></i></label>
                    <a href="">don’t have one?</a>
                </div>
                <div class="form-group g-4 file">
                    <input type="file" name="AHPRA" id="AHPRA" placeholder="AHPRA No.\ SPA" class="form-control">
                    <label for="WWCC">AHPRA No.\ SPA <i class="fa-solid fa-camera"></i></label>
                    <a href="">don’t have one?</a>
                </div>
                <div class="form-group g-4 file">
                    <input type="file" name="NDIS" id="NDIS" placeholder="NDIS worker screening" class="form-control">
                    <label for="WWCC">NDIS worker screening <i class="fa-solid fa-camera"></i></label>
                    <a href="">don’t have one?</a>
                </div>
                <div class="form-group g-12">
                    <textarea name="about" id="about" cols="30" rows="3" placeholder="About you" class="form-control"></textarea>
                </div>
                <div class="form-group g-12 choice mt-5">
                    <h1>Preferred age range for your clients?</h1>
                    <div>
                        <div class="form-group">
                            <input type="checkbox" name="p_age_range" id="p_age_range_1">
                            <label for="p_age_range_1">0 - 5</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="p_age_range" id="p_age_range_2">
                            <label for="p_age_range_2">5 - 10</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="p_age_range" id="p_age_range_3">
                            <label for="p_age_range_3">10 - 20</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="p_age_range" id="p_age_range_4">
                            <label for="p_age_range_4">+20</label>
                        </div>
                    </div>
                </div>
                <div class="g-12 flex-center">
                    <hr>
                </div>
                <div class="form-group g-12 choice">
                    <h1>How far are you willing to travel in Kilo meter for mobile visits?</h1>
                    <div>
                        <div class="form-group">
                            <input type="radio" name="travel_rang" id="travel_rang_1">
                            <label for="travel_rang_1">0-10</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="travel_rang" id="travel_rang_2">
                            <label for="travel_rang_2">10-20</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="travel_rang" id="travel_rang_3">
                            <label for="travel_rang_3">20 - 30</label>
                        </div>
                    </div>
                </div>
                <div class="g-12 flex-center">
                    <hr>
                </div>
                <div class="form-group g-12 choice">
                    <h1>How do you prefer to provide therapy?</h1>
                    <div>
                        <div class="form-group">
                            <input type="checkbox" name="p_visit" id="p_visit_1">
                            <label for="p_visit_1">Mobile visits</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="travel_rang" id="p_visit_2">
                            <label for="p_visit_2">Telehealth sessions</label>
                        </div>
                    </div>
                </div>
                <div class="form-group g-12 not-step-1">
                    <button>Back</button>
                    <button type="submit">Next</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
<script src="{{ asset('/js/doctor/get-information.js') }}"></script>
@endsection