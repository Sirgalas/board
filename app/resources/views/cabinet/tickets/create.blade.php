@extends('layouts.app')

@section('content')
    @include('includes._nav',['page'=>'ticked'])

    {{Form::open(['route'=>['cabinet.tickets.store']])}}
        @csrf

        <div class="form-group">
            <label for="subject" class="col-form-label">Subject</label>
            {{Form::text('subject',old('subject'),['class'=>$errors->has('subject')?'form-control is-invalid':'form-control','required'=>true])}}
            @if ($errors->has('subject'))
                <span class="invalid-feedback"><strong>{{ $errors->first('subject') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="content" class="col-form-label">Content</label>
            {{Form::textarea('content',old('content'),['class'=>$errors->has('content') ?'form-control is-invalid':'form-control',"rows"=>"10", "required"=>true])}}
            @if ($errors->has('content'))
                <span class="invalid-feedback"><strong>{{ $errors->first('content') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            {{Form::submit('Сохранить',['class'=>'btn btn-primary'])}}
        </div>
    {{Form::close()}}

@endsection 