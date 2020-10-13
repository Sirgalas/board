@php
    {{
        /**
        * @var $banner \App\Entity\Banner\Banner
        **/
        }}
@endphp
@extends('layouts.app')

@section('content')
    @include('includes._nav',['page'=>'banner'])


    <div class="d-flex flex-row mb-3">

        @if ($banner->canBeChanged())
            <a href="{{ route('cabinet.banners.edit', $banner) }}" class="btn btn-primary mr-1">Edit</a>
            <a href="{{ route('cabinet.banners.file', $banner) }}" class="btn btn-primary mr-1">Change File</a>
        @endif

        @if ($banner->isDraft())
            {{Form::open(['route'=>['cabinet.banners.send', $banner],'method'=>'POST','class'=>'mr-1'])}}
                {{Form::submit('Отправить на модерацию',["class"=>"btn btn-secondary"])}}
            {{Form::close()}}
        @endif

        @if ($banner->isOnModeration())
            {{Form::open(['route'=>['cabinet.banners.cancel', $banner],'method'=>'POST','class'=>'mr-1'])}}
                {{Form::submit('Отозвать с модерации',["class"=>"btn btn-secondary"])}}
            {{Form::close()}}
        @endif

        @if ($banner->isModerated())
            {{Form::open(['route'=>['cabinet.banners.order', $banner],'method'=>'POST','class'=>'mr-1'])}}
                {{Form::submit('Платежное поручение',["class"=>"btn btn-secondary"])}}
            {{Form::close()}}
        @endif

        @if ($banner->canBeRemoved())
            {{Form::open(['route'=>['cabinet.banners.destroy', $banner],'method'=>'POST','class'=>'mr-1'])}}
                @method('DELETE')
                {{Form::submit('Удалить',["class"=>"btn btn-secondary"])}}
            {{Form::close()}}
        @endif
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
            <th>Url</th>
            <td><a href="{{ $banner->url }}">{{ $banner->url }}</a></td>
        </tr>
        <tr>
            <th>Limit</th>
            <td>{{ $banner->limit }}</td>
        </tr>
        <tr>
            <th>Views</th>
            <td>{{ $banner->views }}</td>
        </tr>
        <tr>
            <th>Publish Date</th>
            <td>{{ $banner->published_at }}</td>
        </tr>
        </tbody>
    </table>

    <div class="card">
        <div class="card-body">
            <img src="{{ asset('storage/' . $banner->file) }}" />
        </div>
    </div>
@endsection 