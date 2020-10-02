<div class="search-bar pt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                {{Form::open(['url'=>$route])}}
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                {{Form::text('text',request('text'),["class"=>"form-control","placeholder"=>"Search for..."])}}
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                {{Form::submit('<span class="fa fa-search"></span>',['class'=>"btn btn-light border"])}}
                            </div>
                        </div>
                    </div>
                    @if ($category)
                        <div class="row">
                            @foreach ($category->allAttributes() as $attribute)
                                @if ($attribute->isSelect() || $attribute->isNumber())
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label">{{ $attribute->name }}</label>

                                            @if ($attribute->isSelect())

                                                <select class="form-control" name="attrs[{{ $attribute->id }}][equals]">
                                                    <option value=""></option>
                                                    @foreach ($attribute->variants as $variant)
                                                        <option value="{{ $variant }}"{{ $variant === request()->input('attrs.' . $attribute->id . '.equals') ? ' selected' : '' }}>
                                                            {{ $variant }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            @elseif ($attribute->isNumber())
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        {{Form::text("attrs[".$attribute->id ."][from]",request()->input('attrs.' . $attribute->id . '.from'),["class"=>"form-control","placeholder"=>"To"] )}}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{Form::text("attrs[".$attribute->id ."][to]",request()->input('attrs.' . $attribute->id . '.to'),["class"=>"form-control","placeholder"=>"From"] )}}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                {{Form::close()}}
            </div>
            <div class="col-md-3" style="text-align: right">
                <p><a href="{{ route('cabinet.adverts.create') }}" class="btn btn-success"><span class="fa fa-plus"></span> Add New Advertisement</a></p>
            </div>
        </div>
    </div>
</div> 