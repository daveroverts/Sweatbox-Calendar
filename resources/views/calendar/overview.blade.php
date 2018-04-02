@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::check())
            <h2>Calendar Overview</h2>
            <a href="/calendar/create" class="btn btn-primary"><i class="fa fa-calendar-plus-o"></i> Add new Session</a>
            <br><br>
            <table class="table table-hover">
                <thead><tr>
                    <th>Booked By</th>
                    <th>Student</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>From/Till</th>
                    <th colspan="3">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($sessions as $session)
                    @if($session->inProgress == 1)
                        <tr class="table-info">
                    @elseif(isset($session->actualEnd))
                        <tr class="table-secondary">
                    @elseif($session->date < date('Y-m-d',strtotime('now')) && $session->inProgress == 0)
                        <tr class="table-danger">
                    @else
                        <tr>
                            @endif
                            <td>{{ $session->mentor->user->name }}</td>
                            <td><a href="https://stats.vatsim.net/search_id.php?id={{ $session->student->user->vatsim_id }}">{{ $session->student->user->name }}</a></td>
                            <td>{{ $session->type->name }}</td>
                            <td>{{ date('d-m-Y', strtotime($session->date)) }}</td>
                            <td>{{ date('Hi', strtotime($session->begin)) }}z - {{ date('Hi', strtotime($session->end)) }}z</td>

                            @if($session->inProgress == 1)
                                <td colspan="3"><form action="{{ route('calendar.stop',$session->id) }}">
                                        <button class="btn btn-danger"><i class="fa fa-stop"></i> Stop Session</button>
                                        @csrf
                                    </form></td>
                            @else
                                <td><form action="{{ route('calendar.start',$session->id) }}">
                                        @if(isset($session->actualEnd))
                                            <button class="btn btn-success"><i class="fa fa-play"></i> Restart Session</button>
                                        @else
                                            <button class="btn btn-success"><i class="fa fa-play"></i> Start Session</button>
                                        @endif
                                        @csrf
                                    </form></td>

                                <td><form action="/calendar/{{$session->id}}/edit">
                                        <button class="btn btn-primary"><i class="fa fa-edit"></i> Edit Session</button>
                                        @csrf
                                    </form></td>

                                <td><form action="{{ route('calendar.destroy', $session->id) }}" method="POST">
                                        @method('DELETE')
                                        <button class="btn btn-danger"><i class="fa fa-calendar-minus-o"></i> Delete Session</button>
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
