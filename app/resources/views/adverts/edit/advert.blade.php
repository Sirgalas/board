@extends('layouts.app')

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{Form::open(['url'=>'?','method'=>'put'])}}
        {{Form::token()}}
        <div class="card mb-3">
            <div class="card-header">
                Common
            </div>
            <div class="card-body pb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title</label>
                            {{Form::text('title', old('title', $advert->title),['class'=>$errors->has('title')?"form-control is_invalid":"form-control",'required'=>true])}}
                            @if ($errors->has('title'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price" class="col-form-label">Price</label>
                            {{Form::number('price', old('price', $advert->title),['class'=>$errors->has('price')?"form-control is_invalid":"form-control",'required'=>true])}}
                            @if ($errors->has('price'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('price') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-form-label">Address</label>
                    {{Form::text('address', old('address', $advert->title),['class'=>$errors->has('address')?"form-control is_invalid":"form-control",'required'=>true])}}
                    @if ($errors->has('address'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('address') }}</strong></span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="content" class="col-form-label">Content</label>
                    {{Form::textarea('content', old('content', $advert->title),['class'=>$errors->has('content')?"form-control is_invalid":"form-control",'required'=>true,"rows"=>"10])}}
                    @if ($errors->has('content'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('content') }}</strong></span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            {{Form::submit('Сохранить',["class"=>"btn btn-primary"])}}
        </div>
    {{Form::close()}}

@endsection 