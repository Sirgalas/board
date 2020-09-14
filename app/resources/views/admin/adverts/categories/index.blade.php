@extends('admin.layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Регионы</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Регионы</h6>
            <p><a href="{{ route('admin.adverts.categories.create') }}" class="btn btn-success">Add Category</a></p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                @for ($i = 0; $i < $category->depth; $i++) &mdash; @endfor
                                <a href="{{ route('admin.adverts.categories.show', $category) }}">{{ $category->name }}</a>
                            </td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <div class="d-flex flex-row">

                                    {{Form::open(['route'=>['admin.adverts.categories.first', $category],'class'=>"mr-1",'method'=>'post'])}}
                                        @csrf
                                        <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-double-up"></span></button>
                                    {{Form::close()}}
                                    {{Form::open(['route'=>['admin.adverts.categories.up', $category],'class'=>"mr-1",'method'=>'post'])}}
                                        @csrf
                                        <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-up"></span></button>
                                    {{Form::close()}}
                                    {{Form::open(['route'=>['admin.adverts.categories.down', $category],'class'=>"mr-1",'method'=>'post'])}}
                                        @csrf
                                        <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-down"></span></button>
                                    {{Form::close()}}
                                    {{Form::open(['route'=>['admin.adverts.categories.last', $category],'class'=>"mr-1",'method'=>'post'])}}
                                        @csrf
                                    <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-double-down"></span></button>
                                    {{Form::close()}}
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection