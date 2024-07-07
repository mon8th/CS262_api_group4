@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="pagetitle mb-4">
  <h1 class="display-4">Edit Profile</h1>
</div>

<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <!-- Profile Information -->
        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <h5 class="card-title">Profile Information</h5>

            @if(session('status') && session('status') == 'profile-updated')
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
              @csrf
              @method('PATCH')

              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
              </div>

              <div class="mb-3">
                <label for="image" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="image" name="image">
              </div>

              @if($user->image)
                <div class="mb-3">
                  <img src="{{ asset('profile_images/' . $user->image) }}" alt="Profile Image" width="150">
                </div>
              @endif

              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update Profile</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Update Password -->
        <div class="card shadow-sm mb-4">
          <div class="card-body">
            <h5 class="card-title">Update Password</h5>

            @if(session('status') && session('status') == 'password-updated')
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>

              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update Password</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Delete Account -->
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Delete Account</h5>

            @if(session('status') && session('status') == 'account-deleted')
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif

            <form method="POST" action="{{ route('profile.destroy') }}">
              @csrf
              @method('DELETE')

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-danger">Delete Account</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
@endsection

<style>
  .pagetitle {
    margin-bottom: 2rem;
  }
  .card-title {
    font-weight: 700;
  }
  .card {
    border-radius: 10px;
  }
  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
  }
  .btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
  }
  .btn-primary:hover, .btn-primary:focus {
    background-color: #0056b3;
    border-color: #0056b3;
  }
  .btn-danger:hover, .btn-danger:focus {
    background-color: #c82333;
    border-color: #bd2130;
  }
</style>
