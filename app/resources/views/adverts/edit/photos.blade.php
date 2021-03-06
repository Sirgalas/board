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
    {{Form::open(['url'=>'?','files'=>true])}}
        {{Form::token()}}

        <div class="form-group">
            <label for="photos" class="col-form-label">Title</label>
            {{Form::file('files[]',['id'=>"photos",'class'=>$errors->has('files[]')?"form-control is_invalid":"form-control","multiple"=>true, "required"=>true])}}
        </div>

        <div class="form-group">
            {{Form::submit('Загрузить',["class"=>"btn btn-primary"])}}
        </div>
    {{Form::close()}}

@endsection 