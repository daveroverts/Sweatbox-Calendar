@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::check())
            <h2>Calendar Overview</h2>
            <a href="/calendar/create" class="btn btn-primary">Add new Session</a>
            <table class="table">
                <thead><tr>
                    <th>Student</th>
                    <th>Date</th>
                    <th>Begin</th>
                    <th>End</th>
                    <th colspan="3">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($user->sessions as $session)
                    @if($session->inProgress == 1)
                        <tr class="table-info">
                    @elseif($session->begin < date(strtotime('now')) && $session->inProgress == 0)
                        <tr class="table-danger">
                    @else
                        <tr>
                    @endif
                        <td>{{ $session->student }}</td>
                        <td>{{ date('d-m-Y', strtotime($session->date)) }}</td>
                        <td>{{ $session->begin }}z</td>
                        <td>{{ $session->end }}z</td>
                    </tr>
                @empty
                    <p>No sessions have been planned...</p>
                @endforelse
                </tbody>
            </table>
            @endif
    </div>
@endsection
