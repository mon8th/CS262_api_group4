@extends('layouts.app')

@section('title', 'Customers')

@section('content')
<div class="pagetitle">
  <h1>Customers</h1>
</div>
<section class="section">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="card-title">Customer List</h5>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">Add Customer</a>
      </div>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Profile Picture</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($customers as $customer)
          <tr>
            <td>
                @if($customer->image)
                  <img src="{{ asset('profile_images/' . $host->image) }}" alt="Profile Picture" width="50" height="50" class="rounded-circle">
                @else
                  <img src="{{ asset('profile_images/default.png') }}" alt="Default Profile Picture" width="50" height="50" class="rounded-circle">
                @endif
              </td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>
              <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        {{ $customers->links() }}
      </div>
    </div>
  </div>
</section>
@endsection
