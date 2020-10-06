@extends('layouts.app')

@section('content')
    @include('includes._nav',['page'=>'banner'])

    <p>Choose category:</p>

    @include('cabinet.banners.create._categories', ['categories' => $categories])

@endsection 