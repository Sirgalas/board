@extends('admin.layouts.main')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Редактировать {{$user->name}} </h6>
        </div>
        <div class="card-body">
        {{Form::open(['route'=>['admin.users.update', $user]])}}
            {{Form::token()}}
            @method('PUT')

            <div class="form-group">
                <label for="name" class="col-form-label">Имя</label>
                {{Form::text('name',old('name', $user->name),["class"=> $errors->has('name')?"form-control is-invalid":"form-control", 'placeholder'=>"name*", "id"=>"title"])}}
                @if ($errors->has('name'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="email" class="col-form-label">E-Mail</label>
                {{Form::email('email',$value=old('email', $user->email),["id"=>"email","class"=>
                $errors->has('email')?"form-control is-invalid":"form-control"])}}
                @if ($errors->has('email'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="role" class="col-form-label">Роли</label>
                {{Form::select('role',$roles, old('role', $user->role),["id"=>"role","class"=>
                $errors->has('role')?"form-control is-invalid":"form-control"])}}
                @if ($errors->has('role'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('role') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="permissions" class="col-form-label">Разрешения</label>
                {{Form::select('permission',$permissions, old('permission', $user->permission),["id"=>"permissions","class"=>
                $errors->has('permission')?"form-control is-invalid":"form-control"])}}
                @if ($errors->has('permission'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('permission') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        {{Form::close()}}
        </div>
    </div>
@endsection 