@extends('admin.layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Регионы</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Регионы</h6>
            <p><a href="{{ route('admin.regions.create') }}" class="btn btn-success">Add Region</a></p>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                @include('admin.regions._list', ['regions' => $regions])
            </div>
        </div>
    </div>
@endsection 