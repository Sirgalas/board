@php
    {{
        /**
        * @var $users \App\Entity\User\User[]
        */
    }}
@endphp

@extends('admin.layouts.main')

@section('content')
    <!-- Begin Page Content -->

        <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Пользователи </h6>
            <p><a href="{{ route('admin.users.create') }}" class="btn btn-success">Add User</a></p>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                {{Form::open(['route'=>['admin.users.index'],'method'=>'GET','id'=>'search_form'])}}
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> <label for="id" class="col-form-label">ID</label></th>
                            <th><label for="name" class="col-form-label">Имя</label></th>
                            <th><label for="email" class="col-form-label">Email</label></th>
                            <th><label for="status" class="col-form-label">Статус</label></th>
                            <th><label for="role" class="col-form-label">Роли</label></th>
                            <th><label for="permissions" class="col-form-label">Разрешения</label></th>
                        </tr>
                        <tr>
                            <th>{{Form::text('id',request('id'),["class"=> "form-control", 'placeholder'=>"id", "id"=>"id"])}}</th>
                            <th>{{Form::text('name',request('name'),["class"=> "form-control", 'placeholder'=>"Имя", "id"=>"id"])}}</th>
                            <th>{{Form::text('email',request('email'),["class"=> "form-control", 'placeholder'=>"Email", "id"=>"id"])}}</th>
                            <th>{{Form::select('status',$statuses, request('status'),["id"=>"status","class"=> "form-control"])}}</th>
                            <th>{{Form::select('role',$roles, request('role'),["id"=>"role","class"=> "form-control"])}}</th>
                            <th>{{Form::select('permission',$permissions, request('permissions'),["id"=>"permissions","class"=> "form-control"])}}</th>
                            <th><button type="submit" class="btn btn-primary">Поиск</button></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->isWait())
                                    <span class="badge badge-secondary">Ожидает активацию</span>
                                @endif
                                @if ($user->isActive())
                                    <span class="badge badge-primary">Активный</span>
                                @endif
                            </td>
                            <td>
                                @if ($user->isAdmin())
                                    <span class="badge badge-danger">Админ</span>
                                @else
                                    <span class="badge badge-secondary">Пользователь</span>
                                @endif
                            </td>
                            <td>
                                @if ($user->isExecutor())
                                    <span class="badge badge-primary">Исполнитель</span>
                                @else
                                    <span class="badge badge-success">Заказчик</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{Form::close()}}

            </div>
        </div>
    </div>

    {{ $users->links() }}

@endsection 