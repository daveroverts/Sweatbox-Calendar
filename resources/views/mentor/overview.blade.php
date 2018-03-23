@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::check())
            <h2>Mentors Overview</h2>
            <a href="/mentor/create" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add new Mentor</a>
            <br><br>
            <table class="table table-hover">
                <thead><tr>
                    <th>Vatsim ID</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Rating</th>
                    <th colspan="3">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($mentors as $mentor)
                        <tr>
                            <td><a href="https://stats.vatsim.net/search_id.php?id={{ $mentor->vatsim_id }}">{{ $mentor->vatsim_id }}</a></td>
                            <td>{{ $mentor->name }}</td>
                            <td><a href="mailto:{{ $mentor->email }}">{{ $mentor->email }}</a></td>
                            <td>{{ $mentor->rating->longName }} [{{ $mentor->rating->shortName }}]</td>
                            <td>
                            @if(Auth::user()->isAdmin())
                                <form action="/mentor/{{$mentor->id}}/edit">
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
