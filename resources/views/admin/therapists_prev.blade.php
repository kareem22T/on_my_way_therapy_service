@extends('admin.layout.admin-layout')

@section('title', 'Users | therapists')

@section('users-active', 'active')

@section('content')
    <main>
        @php
            $clients_active = null;
            $therapists_active = 'active';
            $therapists = App\Models\Doctor::where('approved', 1)
                ->orderBy('id', 'DESC')
                ->paginate(10);
        @endphp

        @include('admin.includes.header-users')

        <div id="errors"></div>

        <div class="head">
            <a href="/admin/therapists">account requests</a>
            <a href="/admin/therapists-preview" class="active">current therapists</a>
        </div>

        <div class="table_clients">
            <table>
                <thead>
                    <tr>
                        <th>#id</th>
                        <th>Name</th>
                        <th>Profession</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Age</th>
                        <th>controls</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($therapists->count() > 0)
                        @foreach ($therapists as $therapist)
                            <tr>
                                <td># {{ $therapist->id }}</td>
                                <td>{{ $therapist->first_name . ' ' . $therapist->last_name }}</td>
                                <td>{{ $therapist->profession->title }}</td>
                                <td>{{ $therapist->email }}</td>
                                <td>{{ $therapist->phone }}</td>
                                <td>{{ Carbon\Carbon::parse($therapist->dob)->age }} yo</td>
                                <td><a href="/admin/therapist/{{ $therapist->id }}" class="btn btn-success"><i
                                            class="fa fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">There is no therapsits yet!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="pagination_wrapper">
            {!! $therapists->links('pagination::bootstrap-4') !!}
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('/js/admin/therapists.js') }}?v={{ time() }}"></script>
@endsection
