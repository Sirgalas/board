@php
{{
    /**
    * @var $region \App\Entity\Region
    */
}}
@endphp
@extends('admin.layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Регионы</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.regions.edit', $region) }}" class="btn btn-primary mr-1">Редактировать </a>
            {{Form::open(['route'=>['admin.regions.update', $region],'class'=>"mr-1",'method'=>'post'])}}
            {{Form::token()}}
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            {{Form::close()}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>ID</th><td>{{ $region->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th><td>{{ $region->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th><td>{{ $region->slug }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <p><a href="{{ route('admin.regions.create', ['parent' => $region->id]) }}" class="btn btn-success">Добавить под регион</a></p>
        </div>
        <div class="card-body">
            @include('admin.regions._list', ['regions' => $regions])
        </div>
@endsection 