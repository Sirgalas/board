@extends('admin.layouts.main')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Создать </h6>
        </div>
        <div class="card-body">
            {{ Form::open([
                'route'=>([
                    'admin.regions.store',
                    'parent' => $parent ? $parent->id : null])
                ])
            }}
            @csrf

            <div class="form-group">
                <label for="name" class="col-form-label">Name</label>
                {{Form::text('name', old('name'),['class'=>$errors->has('name')?"form-control is_invalid":"form-control", 'placeholder'=>"Название*", "id"=>"title",'required'=>true])}}
                @if ($errors->has('name'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="slug" class="col-form-label">Slug</label>
                {{Form::text('slug', old('name'),['class'=>$errors->has('slug')?"form-control is_invalid":"form-control", 'placeholder'=>"Ярлыки*", "id"=>"title",'required'=>true])}}
                @if ($errors->has('slug'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('slug') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                {{Form::submit('Сохранить',["class"=>"btn btn-primary"])}}
            </div>
            {{Form::close()}}
        </div>
    </div>
@endsection 