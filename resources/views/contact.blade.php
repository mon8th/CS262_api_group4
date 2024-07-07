@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="pagetitle">
  <h1>Contact Us</h1>
</div>

<section class="section contact">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card info-card mb-4">
          <div class="card-body">
            <h5 class="card-title">Get in Touch</h5>
            <p class="card-text">Feel free to reach out to us with any questions or comments you may have. We're here to help!</p>
            <div class="contact-info">
              <div class="info d-flex align-items-center mb-3">
                <div class="icon bg-light p-3 rounded-circle">
                  <i class="bi bi-envelope"></i>
                </div>
                <div class="ps-3">
                  <h6>Email</h6>
                  <p>support@example.com</p>
                </div>
              </div>
              <div class="info d-flex align-items-center mb-3">
                <div class="icon bg-light p-3 rounded-circle">
                  <i class="bi bi-phone"></i>
                </div>
                <div class="ps-3">
                  <h6>Phone</h6>
                  <p>+123 456 7890</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Contact Form</h5>
            @if(session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
            <form method="POST" action="{{ route('api.contact.send') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Send Message</button>
            </div>
        </form>
          </div>
        </div>
      </div> <!-- End Col -->
    </div> <!-- End Row -->
  </div> <!-- End Container -->
</section>
@endsection

<style>
  .info-card .icon {
    font-size: 24px;
    color: #007bff;
  }
  .info-card h6 {
    font-size: 18px;
    margin-bottom: 0;
  }
  .info-card p {
    margin-bottom: 0;
    color: #6c757d;
  }
  .contact .card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
</style>
