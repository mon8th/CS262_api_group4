@extends('layouts.app')

@section('title', 'View Profile')

@section('content')
<div class="pagetitle mb-4">
  <h1 class="display-4">Profile</h1>
</div>

<section class="section profile">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
          <div class="card-header text-white">
            <h5 class="card-title mb-0">Profile Information</h5>
          </div>
          <div class="card-body">
            <div class="text-center mb-4">
                @if($user->image)
                    <img src="{{ asset('profile_images/' . $user->image) }}" alt="Profile Image" class="rounded-circle" width="150" height="150">
                @else
                    <img src="{{ asset('profile_images/default.png') }}" alt="Default Profile Image" class="rounded-circle" width="150" height="150">
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Name:</strong></label>
                <p class="form-control-plaintext">{{ $user->name }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Email:</strong></label>
                <p class="form-control-plaintext">{{ $user->email }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Role:</strong></label>
                <p class="form-control-plaintext">{{ ucfirst($user->role) }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Account Created:</strong></label>
                <p class="form-control-plaintext">{{ $user->created_at->format('F j, Y, g:i a') }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label"><strong>Last Updated:</strong></label>
                <p class="form-control-plaintext">{{ $user->updated_at->format('F j, Y, g:i a') }}</p>
            </div>
            <div class="d-grid">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block">Edit Profile</a>
            </div>
          </div>
        </div>

        <div class="card shadow-sm">
          <div class="card-body text-center">
            <h5 class="card-title">Need Help?</h5>
            <p class="card-text">If you have any questions or need assistance, feel free to reach out to our support team.</p>
            <a href="{{ route('contact.index') }}" class="btn btn-info">Contact Support</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
