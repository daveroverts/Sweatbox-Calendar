@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create new session</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('calendar.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="student" class="col-md-4 col-form-label text-md-right">Student</label>

                                <div class="col-md-6">
                                    <input id="student" type="text" class="form-control{{ $errors->has('student') ? ' is-invalid' : '' }}" name="student" value="{{ old('student') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">Date</label>

                                <div class="col-md-6">
                                    <input id="date" type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') }}" required autofocus>

                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="timeBegin" class="col-md-4 col-form-label text-md-right">Begin</label>

                                <div class="col-md-6">
                                    <input id="timeBegin" type="time" class="form-control{{ $errors->has('timeEnd') ? ' is-invalid' : '' }}" name="timeBegin" value="{{ old('timeBegin') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('timeBegin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="timeEnd" class="col-md-4 col-form-label text-md-right">End</label>

                                <div class="col-md-6">
                                    <input id="timeBegin" type="time" class="form-control{{ $errors->has('timeEnd') ? ' is-invalid' : '' }}" name="timeEnd" value="{{ old('timeEnd') }}" required autofocus>

                                    @if ($errors->has('timeEnd'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('timeEnd') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                                <div class="col-md-6">
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                            </div>

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
