@extends('layouts.app')

@section('content')
    <h2>Students mentored by {{ $mentor->user->name }}</h2>
    <table class="table table-hover">
        <thead><tr>
            <th>Vatsim ID</th>
            <th>Name</th>
            <th>E-Mail</th>
            <th>Rating</th>
        </tr>
        </thead>
        <tbody>
    @forelse($students as $student)
        <td><a href="https://stats.vatsim.net/search_id.php?id={{ $student->user->vatsim_id }}">{{ $student->user->vatsim_id }}</a></td>
        <td>{{ $student->user->name }}</td>
        <td><a href="mailto:{{ $student->user->email }}">{{ $student->user->email }}</a></td>
        <td>{{ $student->user->rating->longName }} [{{ $student->user->rating->shortName }}]</td>
    @empty
    @endforelse
        </tbody>
    </table>
@endsection