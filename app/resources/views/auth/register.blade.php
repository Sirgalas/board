@extends('layouts.app')

@section('breadcrumbs')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home')  }}">Home</a></li>
        <li class="breadcrumb-item active">Register</li>
    </ul>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    {{Form::open(['route'=>('register')])}}
                        {{Form::token()}}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Имя</label>

                            <div class="col-md-6">
                                {{
                                    Form::text(
                                        'name',
                                        old('name'),
                                        [
                                            'class'=>$errors->has('name')?"form-control is_invalid":"form-control",
                                            'placeholder'=>"Имя*",
                                            "id"=>"name",
                                            'required'=>true
                                        ]
                                    )
                                }}
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                {{
                                    Form::text(
                                        'email',
                                        old('email'),
                                        [
                                            'class'=>$errors->has('email')?"form-control is_invalid":"form-control",
                                            'placeholder'=>"email*",
                                            "id"=>"email",
                                            'required'=>true
                                        ]
                                    )
                                }}
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                {{
                                    Form::password(
                                        'password',
                                        [
                                            'class'=>$errors->has('password')?"form-control is_invalid":"form-control",
                                            'placeholder'=>"Пароль*",
                                            "id"=>"password",
                                            'required'=>true
                                        ]
                                    )
                                }}

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                {{
                                    Form::password(
                                        'password_confirmation',
                                        [
                                            'class'=>$errors->has('password_confirmation')?"form-control is_invalid":"form-control",
                                            'placeholder'=>"Повторите пароль*",
                                            "id"=>"password_confirm",
                                            'required'=>true
                                        ]
                                    )
                                }}
                                <input id="password-confirm" type="password" class="form-control" name="" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
