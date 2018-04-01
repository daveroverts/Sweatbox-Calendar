@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create new mentor</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('mentor.store') }}">
                            @csrf
                            {{--Student--}}
                            <div class="form-group row">
                                <label for="student" class="col-md-4 col-form-label text-md-right"><i class="fa fa-user"></i> Student</label>

                                <div class="col-md-6">
                                    <select class="custom-select" name="student">
                                        @foreach($students as $student)
                                            @if($student->user->rating_id >= 2)
                                            <option name="student" value="{{$student->user->id}}">{{ $student->user->name }} [{{ $student->user->rating->shortName }}]</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('students'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('student') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--Submit--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
