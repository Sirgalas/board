@extends('layouts.app')

@section('content')
    @include('cabinet.banners._nav')

    {{Form::open(['route'=>['cabinet.banners.file', $banner],'method'=>'POST','files' => true])}}
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="format" class="col-form-label">Format</label>
            <select id="format" class="form-control{{ $errors->has('format') ? ' is-invalid' : '' }}" name="format">
                @foreach ($formats as $value)
                    <option value="{{ $value }}"{{ $value === old('format', $banner->format) ? ' selected' : '' }}>{{ $value }}</option>
                @endforeach;
            </select>
            @if ($errors->has('format'))
                <span class="invalid-feedback"><strong>{{ $errors->first('format') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="file" class="col-form-label">Banner</label>
            {{Form::file('file',["class"=>$errors->has('file') ? 'form-control is-invalid' : 'form-control','required'=>true])}}
            @if ($errors->has('file'))
                <span class="invalid-feedback"><strong>{{ $errors->first('file') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            {{Form::submit('Сохранить',['class'=>'btn btn-primary'])}}
        </div>
    {{Form::close()}}

@endsection 