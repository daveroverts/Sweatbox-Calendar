@extends('layouts.app')

@section('content')
        @if (session('students'))
            @component('layouts.alert.info')
                @slot('title')
                    Mentor removed
                @endslot
                {{ session('message') }}
            @endcomponent
            @php($students = session('students'))
            @if(!$students->isEmpty())
            @component('layouts.alert.warning')
                @slot('title')
                    Student(s) lost mentor
                @endslot
                Warning, the mentor that was just removed, still had one or more students! The following student(s) lost their mentor:
                <ul>
                    @foreach($students as $student)
                        <li>{{ $student->user->name }} [{{ $student->user->vatsim_id }}] - <a href="{{route('student.edit', $student->id)}}" target="_blank" class="alert-link">Assign new mentor</a></li>
                    @endforeach
                </ul>
                Clicking <strong class="alert-link">Assign new mentor</strong> opens student edit page in a new tab.
            @endcomponent
            @endif
        @endif
        @if(Auth::check())
            <h2>Mentors Overview</h2>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('mentor.create') }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add new Mentor</a>
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
@endsection
