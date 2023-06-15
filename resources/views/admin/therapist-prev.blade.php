@extends('admin.layout.admin-layout')

@section('title', 'Therapist@' . $therapist_data->first_name . '_' . $therapist_data->id)

@section('users-active', 'active')

@section('content')
    <main>
        @php
            $clients_active = null;
            $therapists_active = 'active';
            $doctors = App\Models\Doctor::where('approved', 0)->paginate(5);
        @endphp

        @include('admin.includes.header-users')

        <div id="errors"></div>

        <div class="head">
            <a href="/admin/therapists">account requests</a>
            <a href="/admin/therapists-preview" class="active">current therapists</a>
        </div>

        <div class="container preview_wrapper lg-grid">
            <div class="profile g-12">
                <div class="img">
                    <img src="{{ asset('/imgs/doctor/uploads/therapist_profile/' . $therapist_data->photo) }}" alt="">
                </div>
                <h1>{{ $therapist_data->first_name . ' ' . $therapist_data->last_name }}</h1>
                <h4>{{ $therapist_data->profession->title . ' | ' . $therapist_data->experience . ' Years experience' }}
                </h4>
                <p>
                    {{ $therapist_data->about_me }}
                </p>
            </div>

            <div class="form-group g-6">
                <input type="text" disabled name="email" id="email" class="input form-control"
                    value="{{ 'Email: ' . $therapist_data->email }}">
            </div>
            <div class="form-group g-6">
                <input type="text" disabled name="email" id="email" class="input form-control"
                    value="{{ 'Phone: +' . $therapist_data->phone_key . ' ' . $therapist_data->phone }}">
            </div>
            <div class="form-group g-12">
                <input type="text" disabled name="address" id="address" class="input form-control"
                    value="{{ 'Address: ' . $therapist_data->address }}">
            </div>
            <div class="form-group g-6">
                <input type="text" disabled name="dob" id="dob" class="input form-control"
                    value="{{ 'Date of birth: ' . date('Y-m-d', strtotime($therapist_data->dob)) }}">
            </div>
            <div class="form-group g-6">
                <input type="text" disabled name="gender" id="gender" class="input form-control"
                    value="{{ 'Gender: ' . $therapist_data->gender }}">
            </div>
            <div class="form-group g-4">
                <input type="text" disabled name="WWCC" id="WWCC" class="input form-control"
                    value="{{ 'WWCC: ' . $therapist_data->WWCC_number }}">
            </div>
            <div class="g-4">
                @if ($therapist_data->AHPRA_number)
                    <input type="text" disabled name="AHPRA" id="AHPRA" class="input form-control"
                        value="{{ 'AHPRA: ' . $therapist_data->AHPRA_number }}">
                @elseif ($therapist_data->SPA_number)
                    <input type="text" disabled name="SPA" id="SPA" class="input form-control"
                        value="{{ 'SPA: ' . $therapist_data->SPA_number }}">
                @elseif ($therapist_data->practitioner_number)
                    <input type="text" disabled name="practitioner_number" id="practitioner_number"
                        class="input form-control" value="{{ 'Practitioner: ' . $therapist_data->practitioner_number }}">
                @endif
            </div>
            <div class="g-4">
                <input type="text" disabled name="NDIS" id="NDIS" class="input form-control"
                    value="{{ 'NDIS: ' . $therapist_data->NDIS_number }}">
            </div>
            <div class="btns g-12">
                <a href="/admin/therapists" class="btn btn-secondary" id="{{ $therapist_data->id }}"><i
                        class="fa-solid fa-arrow-left"></i> Back</a>
                <span></span>
            </div>
        </div>


        <div class="hide-content"></div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('/js/admin/therapists.js') }}?v={{ time() }}"></script>
@endsection
