@php
    {{
        /**
            * @var $category App\Entity\Adverts\Category
        **/
    }}
@endphp
@extends('admin.layouts.main')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route() }}" class="btn btn-primary mr-1">Edit</a>
            {{Form::open(['route'=>['admin.adverts.categories.attributes.edit', [$category, $attribute]],'class'=>"mr-1",'method'=>'post'])}}
                @method('DELETE')
                {{Form::submit('Удалить',['class'=>"btn btn-danger"])}}
            {{Form::close()}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>ID</th><td>{{ $category->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th><td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th><td>{{ $category->slug }}</td>
                    </tr>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection