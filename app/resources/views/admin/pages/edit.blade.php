@extends('admin.layouts.main')

@section('content')

    {{Form::open(['route'=>(['admin.pages.store']),'method'=>'POST'])}}
        {{Form::token()}}
        @method('PUT')

        <div class="form-group">
            <label for="title" class="col-form-label">Title</label>
            {{Form::text('title',old('title'),['class'=>$errors->has('title')?'form-control is-invalid':'form-control','required'=>true])}}
            @if ($errors->has('title'))
                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="menu_title" class="col-form-label">Title</label>
            {{Form::text('menu-title',old('menu-title'),['class'=>$errors->has('menu-title')?'form-control is-invalid':'form-control','required'=>true])}}
            @if ($errors->has('menu_title'))
                <span class="invalid-feedback"><strong>{{ $errors->first('menu_title') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="slug" class="col-form-label">Slug</label>
            {{Form::text('slug',old('slug'),['class'=>$errors->has('slug')?'form-control is-invalid':'form-control','required'=>true])}}
            @if ($errors->has('slug'))
                <span class="invalid-feedback"><strong>{{ $errors->first('slug') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="parent" class="col-form-label">Parent</label>
            <select id="parent" class="form-control{{ $errors->has('parent') ? ' is-invalid' : '' }}" name="parent">
                <option value=""></option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}"{{ $parent->id == old('parent', $page->parent_id) ? ' selected' : '' }}>
                        @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                        {{ $parent->title }}
                    </option>
                @endforeach;
            </select>
            @if ($errors->has('parent'))
                <span class="invalid-feedback"><strong>{{ $errors->first('parent') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="content" class="col-form-label">Content</label>
            {{Form::textarea('content',old('content') ,['class'=>$errors->has('content') ?"form-control is-invalid":"form-control",'required'=>true,'rows'=>10])}}            @if ($errors->has('content'))
                <span class="invalid-feedback"><strong>{{ $errors->first('content') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="description" class="col-form-label">Description</label>
            {{Form::textarea('description',old('description') ,['class'=>$errors->has('description') ?"form-control is-invalid":"form-control",'required'=>true,'rows'=>10])}}
            @if ($errors->has('description'))
                <span class="invalid-feedback"><strong>{{ $errors->first('description') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            {{Form::submit('Сохранить',["class"=>"btn btn-primary"])}}
        </div>
    {{Form::close()}}
@endsection 