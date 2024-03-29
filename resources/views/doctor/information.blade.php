@extends('doctor.layouts.register-layout')

@section('title', 'step 2 | information')

@section('content')
    <div id="errors">
        {{-- validation errors will appear here. --}}
    </div>
    <style>
        @media (max-width: 599.98px) {
            form {
                display: flex !important;
                flex-direction: column;
            }
        }
    </style>
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
            <form action="POST" class="lg-grid" id="step-2" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="form-group g-4">
                    <select name="profession" id="profession" class="form-control">
                        <option value="" selected>Profession ...</option>
                        @if ($professions)
                            @foreach ($professions as $profession)
                                <option value="{{ $profession->id }}">{{ $profession->title }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group g-4">
                    <select name="client_gender" id="client_gender" class="form-control">
                        <option value="">Preferred client gender ...</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                        <option value="2">Both</option>
                    </select>
                </div>
                <div class="form-group g-4">
                    <input type="number" name="experience" id="experience" placeholder="Years of experience "
                        class="form-control">
                </div>
                <div class="form-group g-12 diagnosis_wrapper">
                    <input type="text" name="diagnosis" id="diagnosis" placeholder="Preferred client diagnosis"
                        class="form-control">
                    <ul class="diagnosis">
                        {{-- <li>example <i class="fa-regular fa-circle-xmark"></i></li> --}}
                        {{-- selecte diagnosis will appear here --}}
                    </ul>
                    <a href="" class="add_diagnosis">Add <i class="fa fa-plus"></i></a>
                </div>
                <div class="form-group g-4 file">
                    <input type="text" name="WWCC" id="WWCC" placeholder="WWCC Number" class="form-control">
                    <a href="https://wwccheck.ocg.nsw.gov.au/FindMyNumber" target="_blanck">don’t have one?</a>
                </div>
                <div class="form-group g-4 file changable-cer">
                    <input type="text" name="AHPRA" id="AHPRA Number" placeholder="AHPRA Registration"
                        class="form-control">
                    <a href="https://www.ahpra.gov.au/Registration/Registers-of-Practitioners.aspx" target="_blanck">don’t have one?</a>
                </div>
                <div class="form-group g-4 file">
                    <input type="text" name="NDIS" id="NDIS" placeholder="NDIS worker screening Number"
                        class="form-control">
                    <a href="https://www.service.nsw.gov.au/transaction/ndiswc-apply" target="_blanck">don’t have one?</a>
                </div>
                <div class="form-group g-12">
                    <textarea name="about_me" id="about" cols="30" rows="3" placeholder="About you" class="form-control"></textarea>
                </div>
                <div class="form-group g-12 choice mt-5 client_age_range_div">
                    <h1>Preferred age range for your clients?</h1>
                    <div>
                        @if ($Client_age_range)
                            @foreach ($Client_age_range as $range)
                                <div class="form-group">
                                    <input type="checkbox" name="client_age_range[]" id="{{ 'p_age_range_' . $range->id }}"
                                        value="{{ $range->id }}">
                                    <label for="{{ 'p_age_range_' . $range->id }}">{{ $range->range }}</label>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <input type="checkbox" name="client_age_range_all" id="client_age_range_all"
                                    value="">
                                <label for="client_age_range_all">All</label>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="g-12 flex-center">
                    <hr>
                </div>
                <div class="form-group g-12 choice">
                    <h1>How far are you willing to travel in Kilo meter for mobile visits?</h1>
                    <div>
                        <div class="form-group">
                            <input type="radio" name="travel_rang" id="travel_rang_1" value="1">
                            <label for="travel_rang_1">0-10</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="travel_rang" id="travel_rang_2" value="2">
                            <label for="travel_rang_2">10-20</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="travel_rang" id="travel_rang_3" value="3">
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
                            <input type="checkbox" name="visits_type[]" id="p_visit_1" value="0">
                            <label for="p_visit_1">Mobile visits</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="visits_type[]" id="p_visit_2" value="1">
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
    <script src="{{ asset('/js/doctor/get-information.js') }}?v={{ time() }}"></script>
    <script>
        const selectAllButton = document.getElementById('client_age_range_all');
        const checkboxes = document.querySelectorAll('.client_age_range_div input');

        selectAllButton.addEventListener('click', () => {
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
        });

        checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', (event) => {
            if (!event.target.checked) {
                selectAllButton.checked = false;
            }
        });
        });

    </script>
@endsection
