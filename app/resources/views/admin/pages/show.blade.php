@extends('admin.layouts.main')

@section('content')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-primary mr-1">Edit</a>
        {{Form::open(['route'=>(['admin.pages.destroy', $page]),'method'=>'POST','class'=>'mr-1'])}}
            {{Form::token()}}
            @method('DELETE')
            {{Form::submit('Удалить',['class'=>'btn btn-danger'])}}
        {{Form::close()}}
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $page->id }}</td>
        </tr>
        <tr>
            <th>Title</th>
            <td>{{ $page->title }}</td>
        </tr>
        <tr>
            <th>Menu Title</th>
            <td>{{ $page->menu_title }}</td>
        </tr>
        <tr>
            <th>Slug</th>
            <td>{{ $page->slug }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $page->description }}</td>
        </tr>
        </tbody>
    </table>

    <div class="card">
        <div class="card-body pb-1">
            {!! clean($page->content) !!}
        </div>
    </div>
@endsection 