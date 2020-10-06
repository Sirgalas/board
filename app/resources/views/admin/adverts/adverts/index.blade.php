@php
    {{
        /**
        * @var $adverts \App\Entity\Adverts\Advert\Advert[]        **/
        }}
@endphp
@extends('admin.layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">User</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        {{Form::open(['route'=>['admin.adverts.adverts.index'],'method'=>'GET','id'=>'search_form'])}}
                        <th>
                            <label for="id" class="col-form-label">ID</label>
                            {{Form::text('id',request('id'),["class"=> "form-control", 'placeholder'=>"id", "id"=>"id"])}}
                        </th>
                        <th><label for="name" class="col-form-label">Updated</label></th>
                        <th>
                            <label for="name" class="col-form-label">Title</label>
                            {{Form::text('name',request('name'),["class"=> "form-control", 'placeholder'=>"name", "id"=>"name"])}}
                        </th>
                        <th>
                            <label for="user" class="col-form-label">User</label>
                            {{Form::text('user',request('user'),["class"=> "form-control", 'placeholder'=>"user", "id"=>"user"])}}
                        </th>
                        <th>
                            <label for="region" class="col-form-label">Region</label>
                            {{Form::text('region',request('region'),["class"=> "form-control", 'placeholder'=>"region", "id"=>"region"])}}
                        </th>
                        <th>
                            <label for="category" class="col-form-label">Category</label>
                            {{Form::text('category',request('category'),["class"=> "form-control", 'placeholder'=>"category", "id"=>"category"])}}
                        </th>
                        <th>
                            <label for="status" class="col-form-label">Статус</label>
                            <?= Form::select('status',$statuses, request('status'),["id"=>"status","class"=> "form-control"]); ?>
                        </th>
                        {{Form::close()}}
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($adverts as $advert)
                            <tr>
                                <td>{{ $advert->id }}</td>
                                <td>{{ $advert->updated_at }}</td>
                                <td><a href="{{ route('adverts.show', $advert) }}" target="_blank">{{ $advert->title }}</a></td>
                                <td>{{ $advert->user->id }} - {{ $advert->user->name }}</td>
                                <td>
                                    @if ($advert->region)
                                        {{ $advert->region->id }} - {{ $advert->region->name }}
                                    @endif
                                </td>
                                <td>{{ $advert->category->id }} - {{ $advert->category->name }}</td>
                                <td>
                                    <span class="badge badge-{{$classes[$advert->status]}}">{{$statuses[$advert->status]}}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $adverts->links() }}
@endsection 