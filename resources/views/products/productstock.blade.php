@extends('layouts.app')

@section('title', 'Product Stock')

@section('content')
<div class="pagetitle mb-4">
  <h1 class="display-4">Product Stock</h1>
</div>
<section class="section">
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="card-title mb-0">Product List</h5>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>ID</th>
              <th>Product Name</th>
              <th>Category</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Image</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->category }}</td>
              <td>${{ number_format($product->price, 2) }}</td>
              <td>{{ $product->quantity }}</td>
              <td>
                @if($product->image)
                  <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" width="50">
                @else
                  <img src="{{ asset('storage/images/default.png') }}" alt="Default Image" class="img-thumbnail" width="50">
                @endif
              </td>
              <td class="d-flex">
                <a href="{{ route('products.view', $product->id) }}" class="btn btn-info btn-sm mr-1">View</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm mr-1">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')" style="display:inline-block;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- Pagination Links -->
      <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-4') }}
      </div>
    </div>
  </div>
</section>
@endsection
