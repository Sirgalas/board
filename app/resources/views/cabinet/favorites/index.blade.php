@php
{{
    /**
    * @var $adverts \App\Entity\Adverts\Advert\Advert[]
    */
}}
@endphp
@extends('layouts.app')

@section('content')
    @include('includes._nav',['page'=>'favorites'])

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Updated</th>
            <th>Title</th>
            <th>Region</th>
            <th>Category</th>
            <th></th>
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
                <td>
                    {{Form::open(['route'=>['cabinet.favorites.remove', $advert],'method'=>'Post','class'=>'mr-1'])}}
                        @method('DELETE')
                        {{Form::submit('<span class="fa fa-remove"></span> Удалить',['class'=>'btn btn-sm btn-danger'])}}
                    {{Form::close()}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $adverts->links() }}
@endsection 