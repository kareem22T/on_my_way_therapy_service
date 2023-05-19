@extends('admin.layout.admin-layout')

@section('title', 'Users | therapists')

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
            <a href="" class="active">account requests</a>
            <a href="">current therapists</a>
        </div>

        <div class="table">
            @if ($doctors->count() > 0)
                @foreach ($doctors as $doctor)
                    <div class="request">
                        <div class="data">
                            <span>{{ $doctor->first_name . ' ' . $doctor->last_name }}</span>
                            <span>{{ $doctor->profession->title }}</span>
                            <span>{{ Carbon\Carbon::parse($doctor->dob)->age }} yo</span>
                            <span>{{ $doctor->gender }}</span>
                        </div>
                        <div class="btns">
                            <a href="" class="tn btn-secondary"><i class="fa fa-eye"></i></a>
                            <a href="" class=" approve-btn" id="{{ $doctor->id }}"><i
                                    class="fa-solid fa-check"></i></a>
                            <a href="" class=""><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="request">
                    There is no requests yet !
                </div>
            @endif
        </div>

        <div class="pop-up approve-pop-up">
            Are you sure you want to approve this therapist account?
            <input type="hidden" name="therapist_id">
            <div class="btns">
                <button class="approve btn btn-success">Approve</button>
                <button class="cancel btn btn-secondary">Cancel</button>
            </div>
        </div>

        <div class="hide-content"></div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('/js/admin/therapists.js') }}?v={{ time() }}"></script>
@endsection
