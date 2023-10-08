@extends('admin.layout.admin-layout')

@section('title', 'Users | therapists')

@section('users-active', 'active')

@section('content')
    <main>
        @php
            $clients_active = null;
            $therapists_active = 'active';
            $doctors = App\Models\Doctor::where('approved', 0)->paginate(10);
        @endphp

        @include('admin.includes.header-users')

        <div id="errors"></div>

        <div class="head">
            <a href="/admin/therapists" class="active">account requests</a>
            <a href="/admin/therapists-preview">current therapists</a>
        </div>

        <div class="table">
            @if ($doctors->count() > 0)
                @foreach ($doctors as $doctor)
                    <div class="request">
                        <div class="data">
                            <span>{{ $doctor->first_name . ' ' . $doctor->last_name }}</span>
                            <span>{{ $doctor->profession ? $doctor->profession->title : '' }}</span>
                            <span>{{ Carbon\Carbon::parse($doctor->dob)->age }} yo</span>
                            <span>{{ $doctor->gender }}</span>
                        </div>
                        <div class="btns">
                            <a href="/admin/therapists/request/{{ $doctor->id }}" class="tn btn-secondary"><i
                                    class="fa fa-eye"></i></a>
                            <a href="" class="approve-btn" id="{{ $doctor->id }}"><i
                                    class="fa-solid fa-check"></i></a>
                            <a href="" class="delete-btn" id="{{ $doctor->id }}"><i class="fa fa-trash"></i></a>
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

        <div class="pop-up delete-pop-up">
            Are you sure you want to delete this therapist account?
            <input type="hidden" name="therapist_id">
            <div class="btns">
                <button class="cancel btn btn-secondary">Cancel</button>
                <button class="delete btn btn-danger">delete</button>
            </div>
        </div>

        <div class="hide-content"></div>
        <div class="pagination_wrapper">
            {!! $doctors->links('pagination::bootstrap-4') !!}
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('/js/admin/therapists.js') }}?v={{ time() }}"></script>
@endsection
