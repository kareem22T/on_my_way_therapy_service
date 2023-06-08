@extends('doctor.layouts.dashboard-layout')

@section('title', 'Calendar ')

@section('calendar_link', 'active')

@section('extra-stylesheets')
    <link rel="stylesheet" href="{{ asset('/css/doctor_calendar.css') }}">
@endSection

@section('content')
    <div id="errors">
        {{-- validation errors will appear here. --}}
    </div>
    <main class="calendar_wrapper">
        <div class="container">
            <div class="work-time">
                @if (!isset($therapist_times))
                    <form action="" id="working_hours" class="g-2">
                        <div class="row-1">
                            <div>
                                Working hours
                                <div class="form-group">
                                    <select name="from" id="from" class="form-control">
                                        <option value="">From ---</option>
                                        <option value="0">12 am</option>
                                        <option value="1">1 am</option>
                                        <option value="2">2 am</option>
                                        <option value="3">3 am</option>
                                        <option value="4">4 am</option>
                                        <option value="5">5 am</option>
                                        <option value="6">6 am</option>
                                        <option value="7">7 am</option>
                                        <option value="8">8 am</option>
                                        <option value="9">9 am</option>
                                        <option value="10">10 am</option>
                                        <option value="11">11 am</option>
                                        <option value="12">12 pm</option>
                                        <option value="13">1 pm</option>
                                        <option value="14">2 pm</option>
                                        <option value="15">3 pm</option>
                                        <option value="16">4 pm</option>
                                        <option value="17">5 pm</option>
                                        <option value="18">6 pm</option>
                                        <option value="19">7 pm</option>
                                        <option value="20">8 pm</option>
                                        <option value="21">9 pm</option>
                                        <option value="22">10 pm</option>
                                        <option value="23">11 pm</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="to" id="to" class="form-control">
                                        <option value="">To ---</option>
                                        <option value="0">12 am</option>
                                        <option value="1">1 am</option>
                                        <option value="2">2 am</option>
                                        <option value="3">3 am</option>
                                        <option value="4">4 am</option>
                                        <option value="5">5 am</option>
                                        <option value="6">6 am</option>
                                        <option value="7">7 am</option>
                                        <option value="8">8 am</option>
                                        <option value="9">9 am</option>
                                        <option value="10">10 am</option>
                                        <option value="11">11 am</option>
                                        <option value="12">12 pm</option>
                                        <option value="13">1 pm</option>
                                        <option value="14">2 pm</option>
                                        <option value="15">3 pm</option>
                                        <option value="16">4 pm</option>
                                        <option value="17">5 pm</option>
                                        <option value="18">6 pm</option>
                                        <option value="19">7 pm</option>
                                        <option value="20">8 pm</option>
                                        <option value="21">9 pm</option>
                                        <option value="22">10 pm</option>
                                        <option value="23">11 pm</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                Max travelling distance
                                <div class="form-group">
                                    <select name="distance" id="distance" class="form-control">
                                        <option value="">Distance in KM</option>
                                        <option value="1">10</option>
                                        <option value="2">20</option>
                                        <option value="3">30 +</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <button class="btn-info">Set</button>
                            </div>
                        </div>
                    </form>
                @else
                    <h1>Your working hours
                        <input type="hidden" name="start_table" value="{{ $therapist_times['working_hours_from'] }}">
                        <input type="hidden" name="end_table" value="{{ $therapist_times['working_hours_to'] }}">
                        <span>
                            {{ $therapist_times['working_hours_from'] <= 12 ? $therapist_times['working_hours_from'] . ' am' : $therapist_times['working_hours_from'] - 12 . ' pm' }}
                        </span> -
                        <span>
                            {{ $therapist_times['working_hours_to'] <= 12 ? $therapist_times['working_hours_to'] . ' am' : $therapist_times['working_hours_to'] - 12 . ' pm' }}
                        </span>
                        <button id="edit-hours"><i class="fa fa-edit"></i></button>
                    </h1>
                    <h1>Your max traviling distance
                        <span>
                            {{ $therapist_times['travel_range'] * 10 . ' km' }}
                        </span>
                        <button id="edit-distance"><i class="fa fa-edit"></i></button>
                    </h1>

                    <div class="pop-up edit_hours_pop_up">
                        Set working hours
                        <div class="form-group">
                            <label for="form">From: </label>
                            <select name="from" id="from" class="form-control">
                                <option value="">From ---</option>
                                @for ($i = 0; $i < 25; $i++)
                                    @php
                                        $hour = null;
                                        if ($i > 12) {
                                            $hour = $i - 12 . ' pm';
                                        } elseif ($i == 12) {
                                            $hour = $i . ' pm';
                                        } elseif ($i == 0) {
                                            $hour = '12 am';
                                        } else {
                                            $hour = $i . ' am';
                                        }
                                    @endphp
                                    <option value="{{ $i }}"
                                        {{ $therapist_times['working_hours_from'] == $i ? 'selected' : '' }}>
                                        {{ $hour }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="to">To: </label>
                            <select name="to" id="to" class="form-control">
                                <option value="">To ---</option>
                                @for ($i = 0; $i < 25; $i++)
                                    @php
                                        $hour = null;
                                        if ($i > 12) {
                                            $hour = $i - 12 . ' pm';
                                        } elseif ($i == 12) {
                                            $hour = $i . ' pm';
                                        } elseif ($i == 0) {
                                            $hour = '12 am';
                                        } else {
                                            $hour = $i . ' am';
                                        }
                                    @endphp
                                    <option value="{{ $i }}"
                                        {{ $therapist_times['working_hours_to'] == $i ? 'selected' : '' }}>
                                        {{ $hour }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="btns">
                            <button class="btn btn-danger cancel">Cancel</button>
                            <button class="btn btn-success set-hours">Set</button>
                        </div>
                    </div>
                    <div class="pop-up edit_distance_pop_up">
                        Set your traviling distance
                        <div class="form-group">
                            <label for="form_new">Distance in KM: </label>
                            <div class="form-group">
                                <select name="distance" id="distance" class="form-control">
                                    <option value="1" {{ $therapist_times['travel_range'] == 1 ? 'selected' : '' }}>
                                        10
                                    </option>
                                    <option value="2" {{ $therapist_times['travel_range'] == 2 ? 'selected' : '' }}>
                                        20
                                    </option>
                                    <option value="3" {{ $therapist_times['travel_range'] == 3 ? 'selected' : '' }}>
                                        30
                                        +</option>
                                </select>
                            </div>
                        </div>

                        <div class="btns">
                            <button class="btn btn-danger cancel">Cancel</button>
                            <button class="btn btn-success set-distance">Set</button>
                        </div>
                    </div>
                    <div class="hide-content"></div>
                @endif
            </div>

            @php
                $appoinments_sessions = App\Models\Appointment::where('status', 1)
                    ->where('doctor_id', Auth::guard('doctor')->user()->id)
                    ->where('journey', '!=', 4)
                    ->paginate(10);
            @endphp
            <div class="appointments">
                <h3>Up coming sessions</h3>
                @if ($appoinments_sessions->count() > 0)
                    @foreach ($appoinments_sessions as $appointment)
                        <tr>
                            <a href="/therapist/appointment/{{ $appointment->id }}" target="_blank">
                                <span>{{ date('F j', strtotime($appointment->date)) }}</span>
                                <span>{{ date('h:i A', strtotime($appointment->date)) }}</span>
                                <span>{{ $appointment->client->address }}</span>
                                <span>15 km in 10 min</span>
                                <span>{{ $appointment->client->gender }}</span>
                                <span>{{ Carbon\Carbon::parse($appointment->client->dob)->age }} yo</span>
                            </a>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <p>There are no sessions yet!</p>
                    </tr>
                @endif
            </div>

            <div class="this_week_wrapper">
                <h1>
                    My schedule
                </h1>
                <div id="calendar"></div>
            </div>

        </div>
    </main>
@endSection

@section('scripts')
    <script src="{{ asset('/js/doctor/calendar.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                slotMinTime: $('input[name="start_table"]').val() + ':00:00',
                slotMaxTime: $('input[name="end_table"]').val() + ':00:00',
                events: @json($events),
            });
            calendar.render();
        });
    </script>
@endsection
