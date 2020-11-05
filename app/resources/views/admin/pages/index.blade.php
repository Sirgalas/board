@extends('admin.layouts.main')
@section('content')

    <p><a href="{{ route('admin.pages.create') }}" class="btn btn-success">Add Page</a></p>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach ($pages as $page)
            <tr>
                <td>
                    @for ($i = 0; $i < $page->depth; $i++) &mdash; @endfor
                    <a href="{{ route('admin.pages.show', $page) }}">{{ $page->title }}</a>
                </td>
                <td>{{ $page->menu_title }}</td>
                <td>{{ $page->slug }}</td>
                <td>
                    <div class="d-flex flex-row">
                        {{Form::open(['route'=>(['admin.pages.store', $page]),'method'=>'POST','class'=>'mr-1'])}}
                            {{Form::token()}}
                            <button type="submit" class='btn btn-sm btn-outline-primary'><span class="fa fa-double-angle-up"></span></button>
                        {{Form::close()}}
                        {{Form::open(['route'=>(['admin.pages.up', $page]),'method'=>'POST','class'=>'mr-1'])}}
                            {{Form::token()}}

                            <button type="submit" class='btn btn-sm btn-outline-primary'><span class="fa fa-angle-up"></span></button>
                        {{Form::close()}}
                        {{Form::open(['route'=>(['admin.pages.up', $page]),'method'=>'POST','class'=>'mr-1'])}}
                            {{Form::token()}}
                            <button type="submit" class='btn btn-sm btn-outline-primary'><span class="fa fa-angle-down"></span></button>

                        {{Form::close()}}
                        {{Form::open(['route'=>(['admin.pages.last', $page]),'method'=>'POST','class'=>'mr-1'])}}
                            {{Form::token()}}
                            <button type="submit" class='btn btn-sm btn-outline-primary'><span class="fa fa-double-angle-down"></span></button>
                        {{Form::close()}}
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection 