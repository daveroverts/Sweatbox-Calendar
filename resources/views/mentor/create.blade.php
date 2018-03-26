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
                            {{--Name--}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--Email--}}
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address <i class="fa fa-envelope"></i></label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--Vatsim ID--}}
                            <div class="form-group row">
                                <label for="vatsim_id" class="col-md-4 col-form-label text-md-right">Vatsim ID</label>

                                <div class="col-md-6">
                                    <input id="vatsim_id" type="text" class="form-control{{ $errors->has('vatsim_id') ? ' is-invalid' : '' }}" name="vatsim_id" value="{{ old('vatsim_id') }}" required>

                                    @if ($errors->has('vatsim_id'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('vatsim_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--Rating--}}
                            <div class="form-group row">
                                <label for="rating" class="col-md-4 col-form-label text-md-right"><i class="fa fa-list-ul"></i> Rating</label>

                                <div class="col-md-6">
                                    <select class="custom-select" name="rating">
                                        @foreach($ratings as $rating)
                                            <option name="rating" value="{{$rating->id}}">{{ $rating->longName }} [{{ $rating->shortName }}]</option>
                                        @endforeach
                                    </select>



                                    @if ($errors->has('rating'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('rating') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--Submit--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
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
