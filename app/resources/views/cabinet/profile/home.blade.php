@php
{{
    /**
    * @var $user \App\Entity\User
    */
}}
@endphp

@extends('layouts.app')

@section('content')
    @include('includes._nav',['page'=>'profile'])

    <div class="mb-3">
        <a href="{{ route('cabinet.profile.edit') }}" class="btn btn-primary">Edit</a>
    </div>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th>First Name</th><td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Last Name</th><td>{{ $user->last_name }}</td>
        </tr>
        <tr>
            <th>Email</th><td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Phone</th><td>
                @if ($user->phone)
                    {{ $user->phone }}
                    @if (!$user->isPhoneVerified())
                        <i>(is not verified)</i><br />
                        {{Form::open(['route'=>('cabinet.profile.phone')])}}
                            {{Form::token()}}
                            {{Form::submit('Подтвердить',['class'=>'btn btn-sm btn-success'])}}
                        {{Form::close()}}
                    @endif
                @endif
            </td>
        </tr>
        @if ($user->phone)
            <tr>
                <th>Two Factor Auth</th>
                <td>
                    {{Form::open(['route'=>['cabinet.profile.phone.auth'],'method'=>'POST'])}}
                        @csrf
                        @if ($user->isPhoneAuthEnabled())
                            {{Form::submit('Включить',['class'=>'btn btn-sm btn-success'])}}
                        @else
                            {{Form::submit('Выключить',['class'=>'btn btn-sm btn-danger'])}}
                        @endif
                    {{Form::close()}}
                </td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection 