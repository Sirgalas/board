@extends('admin.layouts.main')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Создать </h6>
        </div>
        <div class="card-body">
        {{Form::open(['route'=>(['admin.adverts.categories.store'])])}}
            {{Form::token()}}
            <div class="form-group">
                <label for="name" class="col-form-label">Name</label>
                {{Form::text('name', old('name'),['class'=>$errors->has('name')?"form-control is_invalid":"form-control", 'placeholder'=>"Название*", "id"=>"title",'required'=>true])}}
                @if ($errors->has('name'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="slug" class="col-form-label">Slug</label>
                {{Form::text('slug',  old('slug'),['class'=>$errors->has('slug')?"form-control is_invalid":"form-control", 'placeholder'=>"Ярлыки*", "id"=>"slug",'required'=>true])}}
            @if ($errors->has('slug'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('slug') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="parent" class="col-form-label">Parent</label>
                <select id="parent" class="form-control{{ $errors->has('parent') ? ' is-invalid' : '' }}" name="parent">
                    <option value=""></option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}"{{ $parent->id == old('parent')? ' selected' : '' }}>
                            @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                            {{ $parent->name }}
                        </option>
                    @endforeach;
                </select>
                @if ($errors->has('parent'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('parent') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                {{Form::submit('Сохранить',["class"=>"btn btn-primary"])}}
            </div>
        {{Form::close()}}
        </div>
    </div>
@endsection