@extends('admin.layouts.main')

@section('content')


    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Subject</th>
            <th>User</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <form action="?" method="GET">
                <td>{{Form::text('id',request('id'),['class'=>"form-control"])}}</td>
                <td></td>
                <td></td>
                <td></td>
                <th>{{Form::text('user',request('user'),['class'=>"form-control"])}}</th>
                <th>{{Form::select('status',$statuses,request('status'))}}</th>
            </form>
        </tr>
        @foreach ($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->created_at }}</td>
                <td>{{ $ticket->updated_at }}</td>
                <td><a href="{{ route('admin.tickets.show', $ticket) }}" target="_blank">{{ $ticket->subject }}</a></td>
                <td>{{ $ticket->user->id }} - {{ $ticket->user->name }}</td>
                <td>
                    @if ($ticket->isOpen())
                        <span class="badge badge-danger">Open</span>
                    @elseif ($ticket->isApproved())
                        <span class="badge badge-primary">Approved</span>
                    @elseif ($ticket->isClosed())
                        <span class="badge badge-secondary">Closed</span>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $tickets->links() }}
@endsection 