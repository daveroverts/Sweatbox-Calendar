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
                    <div class="card-header">Edit mentor</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('mentor.update', $id) }}" id="editMentor">
                            @csrf
                            @method('PATCH')
                            {{--Vatsim ID--}}
                            <div class="form-group row">
                                <label for="vatsim_id" class="col-md-4 col-form-label text-md-right"><i class="fa fa-user"></i> Vatsim ID</label>

                                <div class="col-md-6">
                                    <input id="vatsim_id" type="text" class="form-control{{ $errors->has('vatsim_id') ? ' is-invalid' : '' }}" name="vatsim_id" value="{{ $mentor->user->vatsim_id }}" disabled>

                                    @if ($errors->has('vatsim_id'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('vatsim_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Name--}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><i class="fa fa-user"></i> Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $mentor->user->name }}" required autofocus disabled>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Email--}}
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"><i class="fa fa-envelope"></i> E-mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $mentor->user->email }}" disabled>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Rating--}}
                            <div class="form-group row">
                                <label for="rating" class="col-md-4 col-form-label text-md-right"><i class="fa fa-list-ul"></i> Rating</label>

                                <div class="col-md-6">
                                    <input id="rating" type="text" class="form-control{{ $errors->has('rating') ? ' is-invalid' : '' }}" name="rating" value="{{ $mentor->user->rating->longName }} [{{ $mentor->user->rating->shortName }}]" disabled>

                                    @if ($errors->has('rating'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('rating') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Type mentor--}}
                            <div class="form-group row">
                                <label for="typeMentor" class="col-md-4 col-form-label text-md-right"><i class="fa fa-list-ul"></i> Type</label>

                                <div class="col-md-6">
                                    <select class="custom-select" name="typeMentor" title="Type">
                                        @foreach($actions as $action)
                                            <option name="typeMentor" value="{{$action->id}}" {{ $mentor->action->id == $action->id ? 'selected="selected"' : '' }}>{{ $action->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{--Admin--}}
                            <div class="form-group row">
                                <label for="admin" class="col-md-4 col-form-label text-md-right">Admin</label>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="admin" id="admin" {{ $mentor->user->isAdmin == true ? 'checked' : '' }}>
                                        <label class="form-check-label" for="admin">
                                            Admin
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                            <form action="{{ route('mentor.destroy', $id) }}" method="POST" id="deleteMentor">
                                @csrf
                                @method('DELETE')
                            </form>

                            {{--Edit / Delete--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" form="editMentor">
                                        <i class="fa fa-user"></i> Edit
                                    </button>
                                    <button type="submit" class="btn btn-danger" form="deleteMentor">
                                        <i class="fa fa-user-times"></i> Delete
                                    </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
