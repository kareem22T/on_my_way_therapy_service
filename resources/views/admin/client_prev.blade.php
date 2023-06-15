@extends('admin.layout.admin-layout')

@section('title', 'Client@' . $client->first_name . '_' . $client->id)

@section('users-active', 'active')

@section('content')
    <main>
        @php
            $clients_active = 'active';
            $therapists_active = null;
        @endphp

        @include('admin.includes.header-users')
        <div class="container preview_wrapper lg-grid mt-4">
            <div class="profile g-12">
                <div class="img">
                    <img
                        src="/imgs/client/uploads/client_profile/{{ $client->photo ? $client->photo : 'default_client_profile.jpg' }}">
                </div>
                <h1>{{ $client->first_name . ' ' . $client->last_name }}</h1>
                </h4>
            </div>

            <div class="form-group g-12">
                <input type="text" disabled name="address" id="address" class="input form-control"
                    value="{{ 'Address: ' . $client->address }}">
            </div>
            <div class="form-group g-6">
                <input type="text" disabled name="dob" id="dob" class="input form-control"
                    value="{{ 'Date of birth: ' . date('Y-m-d', strtotime($client->dob)) }}">
            </div>
            <div class="form-group g-6">
                <input type="text" disabled name="gender" id="gender" class="input form-control"
                    value="{{ 'Gender: ' . $client->gender }}">
            </div>
            <div class='g-12 mt-3' id="answers">
                <h2 class="mb-3">Risk assessment answers:</h2>
                @if (isset($answers))
                    @foreach ($answers as $answer)
                        @if (isset($answer['answer']) &&
                                $answer['name'] !== 'client_id' &&
                                $answer['name'] !== 'first_name' &&
                                $answer['name'] !== 'email' &&
                                $answer['name'] !== 'phone' &&
                                $answer['name'] !== 'dob' &&
                                $answer['name'] !== 'typeA105' &&
                                $answer['name'] !== 'date' &&
                                $answer['name'] !== 'signature' &&
                                $answer['name'] !== 'last_name')
                            
                            <h4 class="ml-3">{{ $answer['text'] }}</h4>
                            {{-- <h4>{{ $answer['name'] }}</h4> --}}
                            <p class="ml-3">
                                @if (is_array($answer['answer']))
                                    @foreach ($answer['answer'] as $ans)
                                        <span>{{ $ans }}</span>
                                    @endforeach
                                @else
                                    {{ $answer['answer'] }}
                                @endif
                            </p>
                            <br>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="btns g-12">
                <a href="/admin/therapists" class="btn btn-secondary" id="{{ $client->id }}"><i
                        class="fa-solid fa-arrow-left"></i> Back</a>
                <span></span>
            </div>
        </div>
    </main>
@endSection
@section('scripts')
@endsection
