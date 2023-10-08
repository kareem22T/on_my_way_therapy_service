@extends('doctor.layouts.register-layout')

@section('title', 'Change Password')

@section('content')
    @include('site.includes.loader')
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 20px;
        }
    </style>
    <div id="errors">
        {{-- validation errors will appear here. --}}
    </div>
    <main class="login_wrapper">
        <div id="register_root">
            <p class="h2 text-center">
                Write down your account email
            </p>
            <form action="POST" class="verfy_form" id="step-1-v2">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="Your Email">
                </div>
                <div class="form-group">
                    <button type="submit">Confirm</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('/js/doctor/change_pass.js') }}?v={{ time() }}"></script>
@endsection
