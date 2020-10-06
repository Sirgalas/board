@php
    {{
        /**
        * @var $advert \App\Entity\Adverts\Advert\Advert        **/
        }}
@endphp

@extends('admin.layouts.main')

@section('content')


    {{
        Form::open([
            'route'=>(['admin.adverts.adverts.reject'])
        ])
    }}
        {{Form::token()}}

        <div class="form-group">
            <label for="reason" class="col-form-label">Reason</label>
            {{Form::textarea('reason',old('reason', $advert->reject_reason),['class'=>$errors->has('reason')?"form-control is_invalid":"form-control",'rows'=>'10','required'=>true])}}
            @if ($errors->has('reason'))
                <span class="invalid-feedback"><strong>{{ $errors->first('reason') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Reject</button>
        </div>
    {{Form::close()}}

@endsection