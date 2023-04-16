@extends('doctor.layouts.register-layout')

@section("title", "Register")

@section('content')
    <div id="register_root">
    </div>
@endsection

@section('scripts')
<script src="{{ asset('/js/doctor/register.js') }}"></script>
@endsection