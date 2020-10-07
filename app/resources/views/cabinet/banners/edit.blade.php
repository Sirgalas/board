@extends('layouts.app')

@section('content')
    @include('cabinet.banners._nav')


    {{Form::open(['route'=>['cabinet.banners.edit', $banner],'method'=>'POST'])}}
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            {{Form::text('name',old('name', $banner->name),['class'=>$errors->has('name') ? 'form-control is-invalid' : 'form-control','required'=>'true','id'=>'name'])}}
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="limit" class="col-form-label">Views</label>
            {{Form::number('limit',old('limit', $banner->limit),['class'=>$errors->has('limit') ? 'form-control is-invalid' : 'form-control','required'=>'true','id'=>'limit'])}}
            @if ($errors->has('limit'))
                <span class="invalid-feedback"><strong>{{ $errors->first('limit') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label for="url" class="col-form-label">URL</label>
            {{Form::url('url',old('url', $banner->url),['class'=>$errors->has('url') ? 'form-control is-invalid' : 'form-control','required'=>'true','id'=>'url'])}}
            @if ($errors->has('url'))
                <span class="invalid-feedback"><strong>{{ $errors->first('url') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            {{Form::submit('Сохранить',["class"=>"btn btn-primary"])}}
        </div>
    {{Form::close()}}

@endsection 