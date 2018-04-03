@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="calendar" class="btn btn-primary" role="button"><i class="fa fa-calendar"></i> Calendar Overview</a>
                        <a href="student" class="btn btn-primary" role="button"><i class="fa fa-users"></i> Students Overview</a>
                        <a href="mentors" class="btn btn-primary" role="button"><i class="fa fa-users"></i> Mentors Overview</a>
                    </div>
                </div>
            </div>
        </div>
@endsection
