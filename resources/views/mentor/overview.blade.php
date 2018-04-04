@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('students'))
            @php
            $students = session('students');
            @endphp
            <div class="alert alert-success">
                Mentor rights have been removed
            </div>
            @if(!$students->isEmpty())
                <div class="alert alert-danger">
                    Warning, the following student(s) now have no mentor
                    <ul>
                        @foreach($students as $student)
                            <li>{{ $student->user->name }} [{{ $student->user->vatsim_id }}] - <a href="{{route('student.edit', $student->id)}}" target="_blank">Assign new mentor</a></li>
                        @endforeach
                </ul>
            </div>
            @endif
        @endif
        @if(Auth::check())
            <h2>Mentors Overview</h2>
            @if(Auth::user()->isAdmin())
                <a href="/mentor/create" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add new Mentor</a>
            @endif
            <br><br>
            <table class="table table-hover">
                <thead><tr>
                    <th>Vatsim ID</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Rating</th>
                    <th>Type</th>
                    <th colspan="3">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($mentors as $mentor)
                        <tr>
                            <td><a href="https://stats.vatsim.net/search_id.php?id={{ $mentor->user->vatsim_id }}">{{ $mentor->user->vatsim_id }}</a></td>
                            <td>{{ $mentor->user->name }}</td>
                            <td><a href="mailto:{{ $mentor->user->email }}">{{ $mentor->user->email }}</a></td>
                            <td>{{ $mentor->user->rating->longName }} [{{ $mentor->user->rating->shortName }}]</td>
                            <td><p data-toggle="tooltip" data-placement="top" title="{{ $mentor->action->description }}">{{ $mentor->action->name }}</p></td>
                            <td>
                            @if(Auth::user()->isAdmin())
                                <form action="{{ route('mentor.edit',$mentor->id) }}">
                                        <button class="btn btn-primary"><i class="fa fa-edit"></i> Edit Mentor</button>
                                </form>
                                        @csrf
                            @endif
                            </td>
                        </tr>
                        @empty
                            <p>No Mentors are in the system, consider adding one, using the button above</p>
                        @endforelse
                </tbody>
            </table>
        @endif
    </div>
@endsection
