@php
    {{
        /**
        *   @var $user \App\Entity\User\User
        */
    }}
@endphp

@extends('admin.layouts.main')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User</h1>
    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="col-8">
                <h6 class="m-0 font-weight-bold text-primary">Пользователи </h6>
            </div>
            <div class="col-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mr-1">Edit</a>
                @if ($user->isWait())
                    {{Form::open(['route'=>['admin.users.verify', $user],'class'=>"mr-1",'method'=>'post'])}}
                    @csrf
                        {{Form::submit('Подтвердить',["class"=>"btn btn-success"])}}
                    {{Form::close()}}
                @endif
                @can('admin-panel')
                     {{Form::open(['route'=>['admin.users.destroy', $user],'class'=>"mr-1",'method'=>'post'])}}
                        @csrf
                        @method('DELETE')
                        {{Form::submit('Удалить',["class"=>"btn btn-danger"])}}
                    {{Form::close()}}
                @endcan
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <th>ID</th><td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>Имя</th><td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th><td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Статус</th>
                    <td>
                        @if ($user->isWait())
                            <span class="badge badge-secondary">Ожидает активацию</span>
                        @endif
                        @if ($user->isActive())
                            <span class="badge badge-primary">Активный</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Роли</th>
                    <td>
                        @if ($user->isAdmin())
                            <span class="badge badge-danger">Админ</span>
                        @else
                            <span class="badge badge-secondary">Пользователь</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Разрешения</th>
                    <td>
                        @if ($user->isExecutor())
                            <span class="badge badge-primary">Исполнитель</span>
                        @else
                            <span class="badge badge-success">Заказчик</span>
                        @endif
                    </td>
                </tr>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection 