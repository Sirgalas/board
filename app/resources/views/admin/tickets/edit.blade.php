@extends('admin.layouts.main')

@section('content')

    {{Form::open(['route'=>['admin.tickets.update', $ticket]])}}
        @method('PUT')
        <div class="form-group">
            <label for="subject" class="col-form-label">Subject</label>
            {{
                Form::text(
                    'subject',
                    old('subject', $ticket->subject),
                    [
                        'class'=>$errors->has('subject') ?'form-control is-invalid':'form-control',
                        'required'=>true
                    ]
                )
            }}
            @if ($errors->has('subject'))
                <span class="invalid-feedback"><strong>{{ $errors->first('subject') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label for="content" class="col-form-label">Content</label>
            {{
                Form::textarea(
                    'content',
                    old('content', $ticket->content),
                    [
                        'class'=>$errors->has('content') ?"form-control is-invalid":"form-control",
                        "name"=>"content",
                        "rows"=>"10",
                        "required"=>true
                    ]
                )
            }}
            @if ($errors->has('content'))
                <span class="invalid-feedback"><strong>{{ $errors->first('content') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            {{Form::submit('Сохранить',['class'=>"btn btn-primary"])}}
        </div>
    {{Form::close()}}
@endsection 