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
                    @elseif($session->date < date('Y-m-d',strtotime('now')) && $session->inProgress == 0)
                        <tr class="table-danger">
                    @else
                        <tr>
                    @endif
                        <td>{{ $session->student }}</td>
                        <td>{{ date('d-m-Y', strtotime($session->date)) }}</td>
                        <td>{{ $session->begin }}z</td>
                        <td>{{ $session->end }}z</td>

                            @if($session->inProgress == 1)
                                <td colspan="3"><form action="/calendar/stopSession/{{$session->id}}">
                                        <button class="btn btn-danger">Stop Session</button>
                                        @csrf
                                    </form></td>
                            @else
                                <td><form action="/calendar/startSession/{{$session->id}}">
                                        <button class="btn btn-success">Start Session</button>
                                        @csrf
                                    </form></td>

                                <td><form action="/calendar/{{$session->id}}/edit">
                                    <button class="btn btn-primary">Edit Session</button>
                                    @csrf
                                </form></td>

                                <td><form action="/calendar/{{$session->id}}" method="POST">
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete Session</button>
                                    @csrf
                                </form></td>
                            @endif
                    </tr>
                @empty
                    <p>No sessions have been planned...</p>
                @endforelse
                </tbody>
            </table>
            @endif
    </div>
@endsection
