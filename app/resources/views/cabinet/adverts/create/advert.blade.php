@extends('layouts.app')

@section('content')
    @include('includes._nav',['page'=>'adverts'])

    {{Form::open(['route'=>(['cabinet.adverts.create.advert.store', 'category'=>$category, 'region'=>$region])])}}
        @csrf

        <div class="card mb-3">
            <div class="card-header">
                Common
            </div>
            <div class="card-body pb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title</label>
                            {{Form::text('title',old('title'),['class'=>$errors->has('title')?"form-control is_invalid":"form-control","required"=>true])}}
                            @if ($errors->has('title'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price" class="col-form-label">Price</label>
                            {{Form::text('price',old('price'),['class'=>$errors->has('price')?"form-control is_invalid":"form-control","required"=>true])}}
                            @if ($errors->has('price'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('price') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-form-label">Address</label>
                    {{Form::text('address',old('address',$region->address),['class'=>$errors->has('address')?"form-control is_invalid":"form-control","required"=>true])}}
                    @if ($errors->has('address'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('address') }}</strong></span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="content" class="col-form-label">Content</label>
                    {{Form::textarea('content',old('content'),['class'=>$errors->has('content')?"form-control is_invalid":"form-control","required"=>true])}}
                   @if ($errors->has('content'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('content') }}</strong></span>
                    @endif
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Characteristics
            </div>
            <div class="card-body pb-2">
                @foreach ($category->allAttributes() as $attribute)

                    <div class="form-group">
                        <label for=attribute_{{ $attribute->id }}" class="col-form-label">{{ $attribute->name }}</label>

                        @if ($attribute->isSelect())

                            <select id="attribute_{{ $attribute->id }}" class="form-control{{ $errors->has('attributes.' . $attribute->id) ? ' is-invalid' : '' }}" name="attributes[{{ $attribute->id }}]">
                                <option value=""></option>
                                @foreach ($attribute->variants as $variant)
                                    <option value="{{ $variant }}"{{ $variant == old('attributes.' . $attribute->id) ? ' selected' : '' }}>
                                        {{ $variant }}
                                    </option>
                                @endforeach
                            </select>

                        @elseif ($attribute->isNumber())

                            <input id="attribute_{{ $attribute->id }}" type="number" class="form-control{{ $errors->has('attributes.' . $attribute->id) ? ' is-invalid' : '' }}" name="attributes[{{ $attribute->id }}]" value="{{ old('attributes.' . $attribute->id) }}">

                        @else

                            <input id="attribute_{{ $attribute->id }}" type="text" class="form-control{{ $errors->has('attributes.' . $attribute->id) ? ' is-invalid' : '' }}" name="attributes[{{ $attribute->id }}]" value="{{ old('attributes.' . $attribute->id) }}">

                        @endif

                        @if ($errors->has('parent'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('attributes.' . $attribute->id) }}</strong></span>
                        @endif
                    </div>

                @endforeach
            </div>
        </div>

        <div class="form-group">
            {{Form::submit('Сохранить',["class"=>"btn btn-primary"])}}
        </div>
    {{Form::close()}}

@endsection 