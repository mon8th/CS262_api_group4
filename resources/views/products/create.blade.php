@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="pagetitle mb-4 d-flex align-items-center">
  <a href="{{ route('productstock') }}" class="btn btn-link p-0 mr-2">
    <i class="fas fa-arrow-left"></i>
  </a>
  <h1 class="display-4 mb-0">Add Product</h1>
</div>
<section class="section">
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title">Add New Product</h5>

      <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
          <label for="name" class="form-label">Product Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" required>
        </div>
        <div class="form-group mb-3">
          <label for="category" class="form-label">Category</label>
          <select class="form-select" id="category" name="category" required>
            <option value="" selected disabled>Select Category</option>
            <option value="Music">Music</option>
            <option value="Art">Art</option>
            <option value="Indoors">Indoors</option>
            <option value="Outdoors">Outdoors</option>
            <option value="Technology">Technology</option>
            <option value="Sports">Sports</option>
          </select>
        </div>
        <div class="form-group mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" placeholder="Enter product price" required>
        </div>
        <div class="form-group mb-3">
          <label for="quantity" class="form-label">Quantity</label>
          <input type="number" class="form-control" id="quantity" name="quantity" min="0" placeholder="Enter product quantity" required>
        </div>
        <div class="form-group mb-4">
          <label for="image" class="form-label">Image</label>
          <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
