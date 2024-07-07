@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="pagetitle mb-8">
            <h1 class="display-4">Tickets</h1>
          </div>
        <form method="GET" action="{{ route('tickets.search') }}" class="form-inline">
            <input type="text" name="search" placeholder="Search Ticket" class="form-control mr-2">
            <button type="submit" class="btn btn-danger">Search</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>User Email</th>
                    <th>Booking Ticket</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->description }}</td>
                    <td>${{ number_format($ticket->price, 2) }}</td>
                    <td>{{ $ticket->user_email }}</td>
                    <td>{{ $ticket->code }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
