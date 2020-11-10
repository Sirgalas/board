@php
{{
    /**
     * @var $banner \App\Entity\Banner\Banner
    */
}}
@endphp

@extends('admin.layouts.main')

@section('content')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-primary mr-1">Edit</a>
        @if ($banner->isOnModeration())
            {{Form::open(["route"=>['admin.banners.moderate', $banner],'class'=>'mr-1'])}}
                {{Form::submit('Модерация',['class'=>'btn btn-success'])}}
            {{Form::close()}}
        @endif

        @if ($banner->isOrdered())
            {{Form::open(["route"=>['admin.banners.pay', $banner],'class'=>'mr-1'])}}
                {{Form::submit('Отметить как оплаченный',['class'=>'btn btn-success'])}}
            {{Form::close()}}
        @endif
        {{Form::open(['route'=>['admin.banners.destroy', $banner],'class'=>'mr-1'])}}
            @method('DELETE')
            {{Form::submit('Удалить',['class'=>'btn btn-success'])}}
        {{Form::close()}}
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $banner->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $banner->name }}</td>
        </tr>
        <tr>
            <th>Region</th>
            <td>
                @if ($banner->region)
                    {{ $banner->region->name }}
                @endif
            </td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $banner->category->name }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <span class="badge badge-{{$banner->classes}}">{{$banner->statuses}}</span>
            </td>
        </tr>
        <tr>
            <th>Publish Date</th>
            <td>{{ $banner->published_at }}</td>
        </tr>
        </tbody>
    </table>

    <div class="card">
        <div class="card-body">
            <img src="{{ Storage::url($banner->file) }}" />
        </div>
    </div>
@endsection 