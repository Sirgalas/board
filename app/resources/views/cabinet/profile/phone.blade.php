@php
{{
    /**
    * @var $user \App\Entity\User
    */
}}
@endphp

@extends('layouts.app')

@section('content')
    @include('includes._nav',['page'=>'profile'])
    {{Form::open(['route'=>('cabinet.profile.phone.verify')])}}
        @method('PUT')

        <div class="form-group">
            <label for="token" class="col-form-label">SMS Code</label>
            {{
                Form::text(
                    'token',
                    old('token', $user->token),
                    [
                        'class'=>$errors->has('token')?"form-control is_invalid":"form-control",
                        'placeholder'=>"Название*",
                        "id"=>"token",
                        'required'=>true
                    ]
                )
            }}
            @if ($errors->has('token'))
                <span class="invalid-feedback"><strong>{{ $errors->first('token') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            {{Form::submit('Подтвердит',['class'=>'btn btn-primary'])}}
        </div>
    {{Form::close()}}
@endsection 