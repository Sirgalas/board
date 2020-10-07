@php
    {{
        /**
            * @var $category App\Entity\Adverts\Category
            * @var $parentAttributes \App\Entity\Adverts\Attribute[]
            * @var $attributes \App\Entity\Adverts\Attribute[]
        **/
    }}
@endphp
@extends('admin.layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Категории</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.adverts.categories.edit', $category) }}" class="btn btn-primary mr-1">Редактировать</a>
            {{Form::open(["route"=>['admin.adverts.categories.destroy', $category],'method'=>'POST',"class"=>"mr-1"])}}
                @csrf
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
    <h1 class="h3 mb-2 text-gray-800">Аттрибуты</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <p><a href="{{ route('admin.adverts.categories.attributes.create', $category) }}" class="btn btn-success">Добавить аттрибут</a></p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Sort</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Required</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr><th colspan="4">Parent attributes</th></tr>
                        @forelse ($parentAttributes as $attribute)
                            <tr>
                                <td>{{ $attribute->sort }}</td>
                                <td>{{ $attribute->name }}</td>
                                <td>{{ $attribute->type }}</td>
                                <td>{{ $attribute->required ? 'Yes' : '' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4">None</td></tr>
                        @endforelse
                        <tr><th colspan="4">Own attributes</th></tr>
                        @forelse ($attributes as $attribute)
                            <tr>
                                <td>{{ $attribute->sort }}</td>
                                <td>
                                    <a href="{{ route('admin.adverts.categories.attributes.show', [$category, $attribute]) }}">{{ $attribute->name }}</a>
                                </td>
                                <td>{{ $attribute->type }}</td>
                                <td>{{ $attribute->required ? 'Yes' : '' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4">None</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection 