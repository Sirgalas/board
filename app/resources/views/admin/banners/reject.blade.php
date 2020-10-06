@extends('admin.layouts.main')

@section('content')
    @include('admin.banners._nav')

    <form method="POST" action="?">
        @csrf
    {{Form::open(['url'=>'?','method'=>'POST'])}}
        <div class="form-group">
            <label for="reason" class="col-form-label">Reason</label>
            {{Form::textarea('reason',old('reason', $banner->reject_reason),['class'=>$errors->has('reason') ? 'form-control is-invalid' : 'form-control'," rows"=>"10" ])}}
            @if ($errors->has('reason'))
                <span class="invalid-feedback"><strong>{{ $errors->first('reason') }}</strong></span>
            @endif
        </div>
        <div class="form-group">
            {{Form::submit('Отклонить',['class'=>'btn btn-primary'])}}
        </div>
    {{Form::close()}}

@endsection 