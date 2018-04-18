@extends('layouts.app')

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Restore student</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('student.restore') }}">
                            @csrf
                            {{--Student--}}
                            <div class="form-group row">
                                <label for="student" class="col-md-4 col-form-label text-md-right"><i class="fa fa-user"></i> Student</label>

                                <div class="col-md-6">
                                    <select class="custom-select" name="student" title="Student">
                                        @foreach($students as $student)
                                            <option name="student" value="{{$student->id}}">{{ $student->name }} [{{ $student->rating->shortName }}]</option>
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
                                        Restore
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
