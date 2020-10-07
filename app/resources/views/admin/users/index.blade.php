@php
    {{
        /**
        * @var $users \App\Entity\User[]
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
                <div class="card mb-3">
                    <div class="card-header">Filter</div>
                    <div class="card-body">
                            {{Form::open(['route'=>['admin.users.index'],'method'=>'GET','id'=>'search_form'])}}
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="id" class="col-form-label">ID</label>
                                        {{Form::text('id',request('id'),["class"=> "form-control", 'placeholder'=>"id", "id"=>"id"])}}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Имя</label>
                                        {{Form::text('id',request('name'),["class"=> "form-control", 'placeholder'=>"Имя", "id"=>"id"])}}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email</label>
                                        {{Form::text('id',request('email'),["class"=> "form-control", 'placeholder'=>"Email", "id"=>"id"])}}
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="status" class="col-form-label">Статус</label>
                                        <?= Form::select('status',$statuses, request('status'),["id"=>"status","class"=> "form-control"]); ?>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="role" class="col-form-label">Роли</label>
                                        <?= Form::select('role',$roles, request('role'),["id"=>"role","class"=> "form-control"]); ?>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="permissions" class="col-form-label">Разрешения</label>
                                        <?= Form::select('permission',$permissions, request('permissions'),["id"=>"permissions","class"=> "form-control"]); ?>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="col-form-label">&nbsp;</label><br />
                                        <button type="submit" class="btn btn-primary">Поиск</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Статус</th>
                        <th>Роль</th>
                        <th>Разрешение</th>
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
            </div>
        </div>
    </div>

    {{ $users->links() }}

@endsection 