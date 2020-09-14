@extends('admin.layouts.main')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Создать атрибут {{$attribute->name}} для категории {{$category->name}} </h6>
        </div>
        <div class="card-body">
            {{Form::open([
                'route'=>[
                    'admin.adverts.categories.attributes.update',
                    [$category, $attribute]
                ]
            ])}}
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    {{Form::text('name', old('name',$attribute->name),['class'=>$errors->has('name')?"form-control is_invalid":"form-control", 'placeholder'=>"Название*", "id"=>"name",'required'=>true])}}
                     @if ($errors->has('name'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="sort" class="col-form-label">Sort</label>
                    {{Form::text('sort', old('sort',$attribute->sort),['class'=>$errors->has('sort')?"form-control is_invalid":"form-control", 'placeholder'=>"Название*", "id"=>"sort",'required'=>true])}}
                    @if ($errors->has('sort'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('sort') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="type" class="col-form-label">Type</label>
                    {{Form::select('type',$types, old('type',$attribute->name),["id"=>"type","class"=>$errors->has('type')?"form-control is-invalid":"form-control"])}}
                    @if ($errors->has('type'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('type') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="variants" class="col-form-label">Variants</label>
                    {{Form::textarea('variants', old('variants',$attribute->name),['class'=>$errors->has('sort')?"form-control is_invalid":"form-control",  "id"=>"variants"])}}
                    @if ($errors->has('variants'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('variants') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    {{Form::hidden('required', 0,['class'=>$errors->has('sort')?"form-control is_invalid":"form-control"])}}
                    <div class="checkbox">
                        <label>
                            {{Form::checkbox('required',null, old('required'))}}Rquired
                        </label>
                    </div>
                    @if ($errors->has('required'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('required') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            {{Form::close()}}
        </div>
    </div>
@endsection 