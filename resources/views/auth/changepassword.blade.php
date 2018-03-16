@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Change password</div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('changePassword') }}">
                            @csrf

                            {{--Old password--}}
                            <div class="form-group row">
                                <label for="oldPassword" class="col-sm-4 col-form-label text-md-right">Old password</label>

                                <div class="col-md-6">
                                    <input id="oldPassword" type="password" class="form-control{{ $errors->has('oldPassword') ? ' is-invalid' : '' }}" name="oldPassword" value="" required autofocus>

                                    @if ($errors->has('oldPassword'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('oldPassword') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--New password--}}
                            <div class="form-group row">
                                <label for="newPassword" class="col-sm-4 col-form-label text-md-right">New password</label>

                                <div class="col-md-6">
                                    <input id="newPassword" type="password" class="form-control{{ $errors->has('newPassword') ? ' is-invalid' : '' }}" name="newPassword" value="" required>

                                    @if ($errors->has('newPassword'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('newPassword') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Confirm New password--}}
                            <div class="form-group row">
                                <label for="newPassword_confirmation" class="col-sm-4 col-form-label text-md-right">Confirm New password</label>

                                <div class="col-md-6">
                                    <input id="newPassword_confirmation" type="password" class="form-control{{ $errors->has('newPassword_confirmation') ? ' is-invalid' : '' }}" name="newPassword_confirmation" value="" required>

                                    @if ($errors->has('newPassword_confirmation'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('newPassword_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--Submit--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Change Password
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
