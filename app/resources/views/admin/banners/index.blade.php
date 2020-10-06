@extends('admin.layouts.main')

@section('content')

    <div class="card-header">Filter</div>
    <div class="card-body">
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>
                        <label for="id" class="col-form-label">ID</label>
                    </th>
                    <th>
                        <label for="name" class="col-form-label">Name</label>
                    </th>
                    <th>
                        <label for="user" class="col-form-label">User</label>
                    </th>
                    <th>
                        <label for="region" class="col-form-label">Region</label>
                    </th>
                    <th>
                        <label for="category" class="col-form-label">Category</label>
                    </th>
                    <th>
                        <label for="status" class="col-form-label">Status</label>
                    </th>
                    <th>
                        <label for="status" class="col-form-label">&nbsp;</label>
                    </th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        {{Form::open(['url'=>'?'])}}
                            {{Form::token()}}
                            <td>
                                <div class="form-group">
                                    {{Form::text('id',request('id'),['class'=>'form-control','id'=>'id'])}}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    {{Form::text('name',request('name'),['class'=>'form-control','id'=>'name'])}}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    {{Form::text('user',request('user'),['class'=>'form-control','id'=>'user'])}}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    {{Form::text('region',request('region'),['class'=>'form-control','id'=>'region'])}}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    {{Form::text('category',request('category'),['class'=>'form-control','id'=>'category'])}}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    {{Form::select('status',$statuses,request('status'),['class'=>'form-control','id'=>'status'])}}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    {{Form::submit('Искать',["class"=>"btn btn-primary"])}}
                                    <a href="?" class="btn btn-outline-secondary">Очистить</a>
                                </div>
                            </td>
                        {{Form::close()}}
                    </tr>
                @foreach ($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td><a href="{{ route('admin.banners.show', $banner) }}" target="_blank">{{ $banner->name }}</a></td>
                        <td>{{ $banner->user->id }} - {{ $banner->user->name }}</td>
                        <td>
                            @if ($banner->region)
                                {{ $banner->region->id }} - {{ $banner->region->name }}
                            @endif
                        </td>
                        <td>{{ $banner->category->id }} - {{ $banner->category->name }}</td>
                        <td>
                            @if ($banner->isDraft())
                                <span class="badge badge-secondary">Draft</span>
                            @elseif ($banner->isOnModeration())
                                <span class="badge badge-primary">Moderation</span>
                            @elseif ($banner->isModerated())
                                <span class="badge badge-success">Ready to Payment</span>
                            @elseif ($banner->isOrdered())
                                <span class="badge badge-warning">Waiting for Payment</span>
                            @elseif ($banner->isActive())
                                <span class="badge badge-primary">Active</span>
                            @elseif ($banner->isClosed())
                                <span class="badge badge-secondary">Closed</span>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

    {{ $banners->links() }}
@endsection 