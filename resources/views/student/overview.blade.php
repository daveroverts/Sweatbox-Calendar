@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::check())
            <h2>Students Overview</h2>
            <a href="/student/create" class="btn btn-primary"><i class="fa fa-user"></i> Add new Student</a>
            <br><br>
            <table class="table">
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
                            <td><a href="https://stats.vatsim.net/search_id.php?id={{ $student->studentVatsim_id }}">{{ $student->studentVatsim_id }}</a></td>
                            <td>{{ $student->studentName }}</td>
                            <td><a href="{{ $student->studentEmail }}">{{ $student->studentEmail }}</a></td>
                            <td>{{ $student->mentorName }}</td>
                            <td>{{ $student->ratingLongName }} [{{ $student->ratingShortName }}]</td>

                        </tr>
                        @empty
                            <p>No students are in the system, consider adding one, using the button above</p>
                        @endforelse
                </tbody>
            </table>
        @endif
    </div>
@endsection
