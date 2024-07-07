@extends('layouts.app')

@section('title', 'Hosts')

@section('content')
<div class="pagetitle">
  <h1>Hosts</h1>
</div>
<section class="section">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="card-title">Host List</h5>
        <a href="{{ route('hosts.create') }}" class="btn btn-primary">Add Host</a>
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
          @foreach($hosts as $host)
          <tr>
            <td>
                @if($host->image)
                  <img src="{{ asset('profile_images/' . $host->image) }}" alt="Profile Picture" width="50" height="50" class="rounded-circle">
                @else
                  <img src="{{ asset('profile_images/default.png') }}" alt="Default Profile Picture" width="50" height="50" class="rounded-circle">
                @endif
              </td>
            <td>{{ $host->name }}</td>
            <td>{{ $host->email }}</td>
            <td>
              <a href="{{ route('hosts.edit', $host->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('hosts.destroy', $host->id) }}" method="POST" style="display:inline;">
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
        {{ $hosts->links() }}
      </div>
    </div>
  </div>
</section>
@endsection
