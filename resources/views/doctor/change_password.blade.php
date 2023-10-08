@extends('doctor.layouts.register-layout')

@section('title', 'Set Password')

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
                We have sent you a verification code on you email
            </p>
            <h6 id="send_msg">
                Write down the code and your new password
            </h6>
            <form action="POST" class="verfy_form" id="step-1-v2">
                @csrf
                <div class="form-group">
                    <input type="code" name="code" id="code" placeholder="Code">
                </div>
                <div class="form-group pass-group">
                    <input type="password" name="new_password" id="new_password" placeholder="New Password">
                    <i class="fa fa-eye togglePassVisabilaty"></i>
                </div>
                <div class="form-group pass-group">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirm New Password">
                    <i class="fa fa-eye togglePassVisabilaty"></i>
                </div>
                <div class="form-group">
                    <button type="submit">Change</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('/js/doctor/change_pass.js') }}?v={{ time() }}"></script>
@endsection
