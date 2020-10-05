@extends('layouts.app')

@section('content')
    @include('includes._nav',['page'=>'adverts'])

    <p>Choose category:</p>

    @include('cabinet.adverts.create._category', ['categories' => $categories])

@endsection 