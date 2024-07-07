@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="pagetitle">
  <h1>Add User</h1>
</div>
<section class="section">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Add New User</h5>

      <form method="POST" action="{{ $action }}">
        @csrf
        <div class="form-group mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group mb-3">
          <label for="role" class="form-label">Role</label>
          <select class="form-select" id="role" name="role">
            <option value="" selected disabled>Select Role</option>
            @foreach($roles as $value => $label)
              <option value="{{ $value }}" {{ $value == $defaultRole ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
          </select>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Add User</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
