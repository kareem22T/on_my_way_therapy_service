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
                    <div>
                        Select holidays
                        <div class="form-group">
                            <select name="holidays[]" id="holidays" class="form-control">
                                <option value="">Day ---</option>
                                <option value="1">Sun</option>
                                <option value="2">Mon</option>
                                <option value="3">Tue</option>
                                <option value="4">Wed</option>
                                <option value="5">Thu</option>
                                <option value="6">Fri</option>
                                <option value="7">Sat</option>
                            </select>
                        </div>
                        <ul class="holidays">
                        </ul>
                    </div>

                    <div class="form-group">
                        <button class="btn-info">Set</button>
                    </div>
                </div>
            </form>
            @else
                <h1>Your working hours 
                    <span>
                        {{$therapist_times['working_hours_from'] <= 12 ? $therapist_times['working_hours_from'] . ' am' : $therapist_times['working_hours_from'] - 12 . ' pm'}}
                    </span> - 
                    <span>
                        {{$therapist_times['working_hours_to'] <= 12 ? $therapist_times['working_hours_to'] . ' am' : $therapist_times['working_hours_to'] - 12 . ' pm'}}
                    </span>
                    <button id="edit-hours"><i class="fa fa-edit"></i></button>
                </h1>
                <h1>Your max traviling distance
                    <span>
                        {{$therapist_times['travel_range'] * 10 . ' km'}}
                    </span> 
                    <button id="edit-distance"><i class="fa fa-edit"></i></button>
                </h1>
                <h1>Your holidays
                    @php
                        $daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                    @endphp
                    @foreach ($therapist_times['holidays'] as $holiday)
                        <span>
                            {{ $holiday->name}}
                        </span>
                    @endforeach
                    <button id="edit-holidays"><i class="fa fa-edit"></i></button>
                </h1>

                <div class="pop-up edit_hours_pop_up">
                    Set working hours
                    <div class="form-group">
                        <label for="form_new">From: </label>
                        <select name="from_new" id="from_new" class="form-control">
                            <option value="">From ---</option>
                            @for ($i = 0; $i < 25; $i++)
                                @php
                                    $hour = null;
                                    if ($i > 12)
                                        $hour = ($i - 12) . ' pm';
                                    elseif ($i == 12)
                                        $hour = $i  . ' pm';
                                    elseif ($i == 0)
                                        $hour = '12 am';
                                    else
                                        $hour = $i . ' am';
                                @endphp
                                <option value="{{$i}}" {{ $therapist_times['working_hours_from'] == $i ? 'selected' : '' }}>{{ $hour }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="to_new">To: </label>
                        <select name="to_new" id="to_new" class="form-control">
                            <option value="">To ---</option>
                            @for ($i = 0; $i < 25; $i++)
                                @php
                                    $hour = null;
                                    if ($i > 12)
                                        $hour = ($i - 12) . ' pm';
                                    elseif ($i == 12)
                                        $hour = $i  . ' pm';
                                    elseif ($i == 0)
                                        $hour = '12 am';
                                    else
                                        $hour = $i . ' am';
                                @endphp
                                <option value="{{$i}}" {{ $therapist_times['working_hours_to'] == $i ? 'selected' : '' }}>{{ $hour }}</option>
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
                                <option value="1" {{ $therapist_times['travel_range'] = 1 ? 'selected' : ''}}>10</option>
                                <option value="2" {{ $therapist_times['travel_range'] = 2 ? 'selected' : ''}}>20</option>
                                <option value="3" {{ $therapist_times['travel_range'] = 3 ? 'selected' : ''}}>30 +</option>
                            </select>
                        </div>
                    </div>

                    <div class="btns">
                        <button class="btn btn-danger cancel">Cancel</button>
                        <button class="btn btn-success set-hours">Set</button>
                    </div>
                </div>
                <div class="pop-up edit_holidays_pop_up">
                    Set your holidays
                    <div class="form-group">
                        <label for="form_new">Select holidays: </label>
                        <div>
                        <div class="form-group">
                            <select name="holidays[]" id="holidays" class="form-control">
                                <option value="">Day ---</option>
                                <option value="1">Sun</option>
                                <option value="2">Mon</option>
                                <option value="3">Tue</option>
                                <option value="4">Wed</option>
                                <option value="5">Thu</option>
                                <option value="6">Fri</option>
                                <option value="7">Sat</option>
                            </select>
                        </div>
                        <ul class="holidays mt-3">
                            @foreach ($therapist_times['holidays'] as $holiday)
                                <li val="{{$holiday->id}}">
                                    {{ $holiday->name}}
                                    <i class="fa-regular fa-circle-xmark"></i>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    </div>

                    <div class="btns">
                        <button class="btn btn-danger cancel">Cancel</button>
                        <button class="btn btn-success set-hours">Set</button>
                    </div>
                </div>
                <div class="hide-content"></div>
            @endif
        </div>
        
        <div class="preview" style="display: none;">
            <div class="left">
                <div class="calendar">
                <div class="month">
                    <i class="fas fa-angle-left prev"></i>
                    <div class="date">december 2015</div>
                    <i class="fas fa-angle-right next"></i>
                </div>

                <div class="weekdays">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>

                <div class="days"></div>

                {{-- <div class="goto-today">
                    <button class="today-btn">Today</button>
                </div> --}}
                </div>

            </div>

            <div class="right">
                <div class="today-date">
                    <div class="event-day">wed</div>
                    <div class="event-date">12th december 2022</div>
                </div>
            </div>
        </div>

        @php
            $appoinments_sessions = App\Models\Appointment::where('status', 1)->where('doctor_id', Auth::guard('doctor')->user()->id)->where('journey', 1)->paginate(10)
        @endphp
        <div class="appointments">
            <h3>Up coming sessions</h3>
            @if ($appoinments_sessions->count() > 0)
            @foreach ($appoinments_sessions as $appointment)
                <tr>
                    <a href="/therapist/appointment/{{ $appointment->id }}" target="_blank">
                        <span>{{date("F j", strtotime($appointment->date))}}</span>
                        <span>{{date('h:i A', strtotime($appointment->date))}}</span>
                        <span>{{$appointment->client->address}}</span>
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
                This week
            </h1>
            <div class="this-week">
                <table>
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Appointments</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach (range(0, 6) as $i)
                        <tr>
                            <td>{{ \Carbon\Carbon::today()->addDays($i)->format('M j, D') }}</td>
                            <td>

                                @if (\App\Models\Appointment::where('status', 1)->where('journey', '!', 1)->whereDate('date', '=', \Carbon\Carbon::today()->addDays($i)->format('Y-m-d'))->get()->count() == 0)
                                    <p>There is no appointment yet!</p>
                                @endif

                                @foreach (\App\Models\Appointment::where('journey', 1)->whereDate('date', '=', \Carbon\Carbon::today()->addDays($i)->format('Y-m-d'))->where('status', 1)->get() as $appointment)
                                    <p>
                                        <span>{{date("F j", strtotime($appointment->date))}}</span>
                                        <span>{{date('h:i A', strtotime($appointment->date))}}</span>
                                        <span>{{$appointment->client->address}}</span>
                                        <span>15 km in 10 min</span>
                                        <span>{{ $appointment->client->gender }}</span>
                                        <span>{{ Carbon\Carbon::parse($appointment->client->dob)->age }} yo</span>
                                    </p>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
@endSection

@section('scripts')
<script src="{{ asset('/js/doctor/calendar.js') }}"></script>
@endsection
