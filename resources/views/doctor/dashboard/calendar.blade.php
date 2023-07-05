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
                        <h1>Customize your week</h1>
                        @php
                            $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                        @endphp
                        <table>
                            <thead>
                                <tr>
                                    <td></td>
                                    @foreach ($days as $day)
                                        <th>{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span>Start</span>
                                        <span>End</span>
                                    </td>
                                    @foreach ($days as $day)
                                        <td>
                                            <input type="hidden" class="day_name" value="{{ $day }}">

                                            <input type="text" class="start form-control"
                                                name="{{ $day }}_start" placeholder="Start work"
                                                onfocus="(this.type='time')" onblur="(this.type='text')"
                                                value="{{ App\Models\WorkingHour::where('day_of_week', $day)->where('doctor_id', Auth::guard('doctor')->user()->id)->first()->start_time }}">

                                            <input type="text" class="end form-control" name="{{ $day }}_end"
                                                placeholder="End work" onfocus="(this.type='time')"
                                                onblur="(this.type='text')"
                                                value="{{ App\Models\WorkingHour::where('day_of_week', $day)->where('doctor_id', Auth::guard('doctor')->user()->id)->first()->end_time }}">
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <div class="form-group">
                                <button class="btn-info" id="set_week">Set this week</button>
                                <button class="btn-info" id="set_all_weeks">Set all weeks</button>
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
                    ->whereDate('date', '>=', now())
                    ->paginate(10);
                
                $wait_list = App\Models\Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)
                    ->where('wait', 1)
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


            <div class="appointments">
                <h3>Wait list</h3>
                @if ($wait_list->count() > 0)
                    @foreach ($wait_list as $appointment)
                        <tr>
                            <div class="waiting_wrapper">
                                <div class="details">
                                    <span>{{ $appointment->client->first_name . ' ' . $appointment->client->last_name }}</span>
                                    <span>{{ date('F j', strtotime($appointment->date)) }}</span>
                                    <span>{{ date('h:i A', strtotime($appointment->date)) }}</span>
                                    <span>{{ $appointment->client->gender }}</span>
                                    <span>{{ Carbon\Carbon::parse($appointment->client->dob)->age }} yo</span>
                                </div>
                                <div class="btns controls">
                                    <button class="edit-date btn btn-secondary" appointment_date="{{ $appointment->date }}"
                                        client_id="{{ $appointment->client->id }}"
                                        doctor_id="{{ $appointment->doctor->id }}">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </button>
                                    <div class="set-date">
                                        <input type="datetime-local" name="new_date" id="new_date">
                                        <input type="submit" name="submit_new_date"
                                            appointment_id="{{ $appointment->id }}" value="Set date">
                                    </div>

                                    <a href="/therapist/chats/{{ $appointment->client->id }}" target="_blank"
                                        class="btn btn-primary">Contact</a>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <p>There are no waiting!</p>
                    </tr>
                @endif
            </div>

            <style>
                .working-hours {
                    background: black;
                }
            </style>
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
                events: @json($events),
                editable: true,
                dayRender: function(dayEl) {
                    if (dayEl.data('workingHours')) {
                        dayEl.addClass('working-hours');
                    }
                }
            });

            calendar.render();
        });
    </script>
@endsection
