@php
    {{
        /**
        * @var $banners \App\Entity\Banner\Banner[]
        **/
    }}
@endphp
@extends('layouts.app')

@section('content')
    @include('includes._nav',['page'=>'banner'])

    <p><a href="{{ route('cabinet.banners.create') }}" class="btn btn-success">Add Banner</a></p>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Region</th>
            <th>Category</th>
            <th>Published</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($banners as $banner)
            <tr>
                <td>{{ $banner->id }}</td>
                <td><a href="{{ route('cabinet.banners.show', $banner) }}" target="_blank">{{ $banner->name }}</a></td>
                <td>
                    @if ($banner->region)
                        {{ $banner->region->name }}
                    @endif
                </td>
                <td>{{ $banner->category->name }}</td>
                <td>{{ $banner->published_at }}</td>
                <td>
                    <span class="badge badge-{{$banner->classes}}">{{$banner->statuses}}</span>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $banners->links() }}
@endsection 