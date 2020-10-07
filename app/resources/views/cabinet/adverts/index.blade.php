@php
{{
    /**
    * @var $adverts \App\Entity\Adverts\Advert\Advert[]
    */
}}
@endphp

@extends('layouts.app')

@section('content')
    @include('includes._nav',['page'=>'adverts'])

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Updated</th>
            <th>Title</th>
            <th>Region</th>
            <th>Category</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($adverts as $advert)
            <tr>
                <td>{{ $advert->id }}</td>
                <td>{{ $advert->updated_at }}</td>
                <td><a href="{{ route('adverts.show', $advert) }}" target="_blank">{{ $advert->title }}</a></td>
                <td>
                    @if ($advert->region)
                        {{ $advert->region->name }}
                    @endif
                </td>
                <td>{{ $advert->category->name }}</td>
                <td><span class="badge badge-{{$advert->classes}}">{{$advert->statuses}}</span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $adverts->links() }}
@endsection 