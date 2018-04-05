@extends('layouts.app')

@section('content')
    <h2>Overview for {{ $mentor->user->name }}</h2>
    <table class="table table-hover">
        <thead><tr>
            <th>Vatsim ID</th>
            <th>E-Mail</th>
            <th>Rating</th>
            <th>Type</th>
        </tr>
        </thead>
        <tbody>
            <td><a href="https://stats.vatsim.net/search_id.php?id={{ $mentor->user->vatsim_id }}">{{ $mentor->user->vatsim_id }}</a></td>
            <td><a href="mailto:{{ $mentor->user->email }}">{{ $mentor->user->email }}</a></td>
            <td>{{ $mentor->user->rating->longName }} [{{ $mentor->user->rating->shortName }}]</td>
            <td><p data-toggle="tooltip" data-placement="top" title="{{ $mentor->action->description }}">{{ $mentor->action->name }}</p></td>
        </tbody>
    </table>
    
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