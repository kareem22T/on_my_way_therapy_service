@extends('doctor.layouts.dashboard-layout')

@section('title', 'Client | ' . $client->first_name)

@section('content')
    <main>
        <div class="container preview_wrapper lg-grid">
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
            <div class='g-12' id="answers">
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
                            <h4>{{ $answer['text'] }}</h4>
                            <h4>{{ $answer['name'] }}</h4>
                            <p>
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
        </div>
    </main>
@endSection
@section('scripts')
@endsection
