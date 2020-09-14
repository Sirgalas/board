@extends('admin.layouts.main')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Редактировать {{$region->name}} </h6>
        </div>
        <div class="card-body">
            {{Form::open(['route'=>['admin.users.update', $region]])}}
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    {{Form::text('name',old('name', $user->name),["class"=> $errors->has('name')?"form-control is-invalid":"form-control", 'placeholder'=>"Название*", "id"=>"title"])}}
                    @if ($errors->has('name'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="slug" class="col-form-label">E-Mail Address</label>
                    {{Form::text('slug',old('name', $user->name),["class"=> $errors->has('slug')?"form-control is-invalid":"form-control", 'placeholder'=>"Ярлык*", "id"=>"title"])}}
                    @if ($errors->has('slug'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('slug') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            {{Form::close()}}
        </div>
    </div>
@endsection 