@extends('layouts.app')

@section('content')
        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create new session</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('calendar.store') }}">
                            @csrf

                            {{--Student--}}
                            <div class="form-group row">
                                <label for="student" class="col-md-4 col-form-label text-md-right"><i class="fa fa-user"></i> Student</label>

                                <div class="col-md-6">
                                    <select class="custom-select" name="student" autofocus title="Student">
                                        @foreach($students as $student)
                                            <option name="student" value="{{$student->id}}">{{ $student->user->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('student'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('student') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Date--}}
                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right"><i class="fa fa-calendar"></i> Date</label>

                                <div class="col-md-6">
                                    <input id="datepicker" type="text" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') }}" required>

                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Time begin--}}
                            <div class="form-group row">
                                <label for="timeBegin" class="col-md-4 col-form-label text-md-right"><i class="fa fa-clock-o fa-flip-horizontal"></i> Begin (UTC)</label>

                                <div class="col-md-6">
                                    <input id="timeBegin" type="time" class="form-control{{ $errors->has('timeEnd') ? ' is-invalid' : '' }}" name="timeBegin" value="{{ old('timeBegin') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('timeBegin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Time end--}}
                            <div class="form-group row">
                                <label for="timeEnd" class="col-md-4 col-form-label text-md-right"><i class="fa fa-clock-o"></i> End (UTC)</label>

                                <div class="col-md-6">
                                    <input id="timeEnd" type="time" class="form-control{{ $errors->has('timeEnd') ? ' is-invalid' : '' }}" name="timeEnd" value="{{ old('timeEnd') }}" required>

                                    @if ($errors->has('timeEnd'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('timeEnd') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Type session--}}
                            <div class="form-group row">
                                <label for="typeSession" class="col-md-4 col-form-label text-md-right"><i class="fa fa-list-ul"></i> Type session</label>

                                <div class="col-md-6">
                                    <select class="custom-select" name="typeSession" title="Type session">
                                        @foreach($sessionTypes as $type)
                                            <option name="typeSession" value="{{$type->id}}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('typeSession'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('typeSession') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Description--}}
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right"><i class="fa fa-bars"></i> Description</label>

                                <div class="col-md-6">
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                            </div>

                            {{--Create--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-calendar-plus-o"></i> Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
