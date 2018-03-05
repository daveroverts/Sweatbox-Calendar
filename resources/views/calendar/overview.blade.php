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
                        <td>
                            @if($session->inProgress == 1)
                                <a href="/calendar/stopSession" class="btn btn-danger">Stop Session</a>
                            @else
                                <a href="/calendar/startSession" class="btn btn-success">Start Session</a>

                                <form action="/calendar/{{$session->id}}/edit">
                                    <button class="btn btn-primary">Edit Session</button>
                                    @csrf
                                </form>

                                <form action="/calendar/{{$session->id}}" method="POST">

                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete Session</button>
                                    @csrf
                                </form>

                            @endif
                        </td>
                    </tr>
                @empty
                    <p>No sessions have been planned...</p>
                @endforelse
                </tbody>
            </table>
            @endif
    </div>
@endsection
