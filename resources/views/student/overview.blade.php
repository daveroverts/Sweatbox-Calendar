@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::check())
            <h2>Students Overview</h2>
            <a href="/student/create" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add new Student</a>
            <br><br>
            <table class="table table-hover">
                <thead><tr>
                    <th>Vatsim ID</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Mentor</th>
                    <th>Rating</th>
                    <th colspan="3">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($students as $student)
                        <tr>
                            <td><a href="https://stats.vatsim.net/search_id.php?id={{ $student->vatsim_id }}">{{ $student->vatsim_id }}</a></td>
                            <td>{{ $student->name }}</td>
                            <td><a href="{{ $student->email }}">{{ $student->email }}</a></td>
                            <td>@if(isset($student->currentMentor->name))
                                    {{ $student->currentMentor->name }}
                                @else
                                    -
                                @endif</td>
                            <td>{{ $student->rating->longName }} [{{ $student->rating->shortName }}]</td>

                            <td><form action="/student/{{$student->id}}/edit">
                                    <button class="btn btn-primary"><i class="fa fa-edit"></i> Edit Student</button>
                                    @csrf
                                </form></td>
                        </tr>
                        @empty
                            <p>No students are in the system, consider adding one, using the button above</p>
                        @endforelse
                </tbody>
            </table>
        @endif
    </div>
@endsection
