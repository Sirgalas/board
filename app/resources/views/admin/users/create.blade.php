@extends('admin.layouts.main')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Создать </h6>
        </div>
        <div class="card-body">
            <?= Form::open(['route'=>'admin.users.store'])?>
                {{Form::token()}}
                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    {{Form::text('name', old('name'),['class'=>$errors->has('name')?"form-control is_invalid":"form-control", 'placeholder'=>"name", "id"=>"title"])}}
                    @if ($errors->has('name'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email" class="col-form-label">E-Mail Address</label>
                    <?= Form::email('email',$value=old('email'),["id"=>"email",'class'=>$errors->has('email')?"form-control is_invalid":"form-control" ]); ?>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            <?= Form::close(); ?>
        </div>
    </div>
@endsection