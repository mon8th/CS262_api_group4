@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="pagetitle">
  <h1>Edit User</h1>
</div>
<section class="section">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Edit User Details</h5>

      <form method="POST" action="{{ $action }}">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group mb-3">
          <label for="role" class="form-label">Role</label>
          <select class="form-select" id="role" name="role" required>
            @foreach($roles as $value => $label)
              <option value="{{ $value }}" {{ $user->role == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
          </select>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Update User</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
