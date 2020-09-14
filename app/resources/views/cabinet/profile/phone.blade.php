@extends('layouts.app')

@section('content')
    @include('cabinet.profile._nav')

    <form method="POST" action="{{ route('cabinet.profile.phone.verify') }}">
    {{Form::open(['route'=>('cabinet.profile.phone.verify')])}}
    {{Form::token()}}
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
            <button type="submit" class="btn btn-primary">Verify</button>
        </div>
    {{Form::close()}}
@endsection 