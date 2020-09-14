@extends('layouts.app')

@section('content')
    @include('cabinet.profile._nav')
    {{Form::open(['route'=>(['cabinet.profile.update'])])}}
        {{Form::token()}}
        @method('PUT')

        <div class="form-group">
            <label for="name" class="col-form-label">First Name</label>
            {{
                Form::text(
                    'name',
                    old('name', $user->name),
                    [
                        'class'=>$errors->has('name')?"form-control is_invalid":"form-control",
                        'placeholder'=>"Название*",
                        "id"=>"name",
                        'required'=>true
                    ]
                )
            }}
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="last_name" class="col-form-label">Last Name</label>
            {{
                Form::text(
                    'last_name',
                    old('last_name', $user->last_name),
                    [
                        'class'=>$errors->has('last_name')?"form-control is_invalid":"form-control",
                        'placeholder'=>"Название*",
                        "id"=>"last_name",
                        'required'=>true
                    ]
                )
            }}
            @if ($errors->has('last_name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('last_name') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label for="phone" class="col-form-label">Phone</label>
            {{
                Form::text(
                    'phone',
                    old('phone', $user->phone),
                    [
                        'class'=>$errors->has('phone')?"form-control is_invalid":"form-control",
                        'placeholder'=>"Телефон",
                        "id"=>"phone",
                    ]
                )
            }} @if ($errors->has('phone'))
                <span class="invalid-feedback"><strong>{{ $errors->first('phone') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    {{Form::close()}}
@endsection 