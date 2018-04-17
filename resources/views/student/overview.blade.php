@extends('layouts.app')

@section('content')
            <h2>Students Overview</h2>
            @if (session('message'))
                @component('layouts.alert.success')
                    @slot('title')
                        Message
                    @endslot
                    {{ session('message') }}
                @endcomponent
            @endif
            @if(Auth::user()->isAdmin())
                <p><a href="/student/create" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add new Student</a> <a href="#" class="btn btn-primary"><i class="fa fa-user-plus"></i> Re-add inactive student</a></p>
            @endif
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
                    @if(isset($student->currentMentor->user_id) && $student->currentMentor->user_id == Auth::id())
                        <tr>
                    @else
                        <tr class="table-secondary">
                    @endif
                            <td><a href="https://stats.vatsim.net/search_id.php?id={{ $student->user->vatsim_id }}">{{ $student->user->vatsim_id }}</a></td>
                            <td>{{ $student->user->name }}</td>
                            <td><a href="mailto:{{ $student->user->email }}">{{ $student->user->email }}</a></td>
                            <td>{{ $student->currentMentor ? $student->currentMentor->user->name : "-" }}</td>
                            <td>{{ $student->user->rating->longName }} [{{ $student->user->rating->shortName }}]</td>

                            <td>
                                @if(Auth::user()->isAdmin())
                                    <form action="{{ route('student.edit', $student->id) }}">
                                        <button class="btn btn-primary"><i class="fa fa-edit"></i> Edit Student</button>
                                        @csrf
                                    </form>
                                @endif
                                @if(isset($student->currentMentor->user_id) && $student->currentMentor->user_id == Auth::id())
                                        <br>
                                            <form action="{{ route('calendar.create') }}">
                                                <button class="btn btn-primary"><i class="fa fa-calendar-plus-o"></i> Add new Session</button>
                                                @csrf
                                            </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                            @if(Auth::user()->isAdmin())
                                @component('layouts.alert.warning')
                                    @slot('title')
                                        No students found
                                    @endslot
                                    No students are in the system, consider adding one, using the button above
                                @endcomponent
                                @else
                                @component('layouts.alert.info')
                                    @slot('title')
                                        No students found
                                    @endslot
                                    No students are in the system, just wait till a admin adds one.
                                @endcomponent
                                @endif
                        @endforelse
                </tbody>
            </table>
@endsection
