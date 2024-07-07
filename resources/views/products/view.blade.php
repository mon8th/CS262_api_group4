@extends('layouts.app')

@section('title', 'View Product')

@section('content')
<div class="pagetitle">
  <h1>View Product</h1>
</div>
<section class="section">
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title text-center">{{ $product->name }}</h5>
      <div class="row align-items-center">
        <div class="col-md-4 text-center">
          <div class="card-img-top mb-3">
            @if($product->image)
              <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
            @else
              <img src="{{ asset('storage/images/default.png') }}" alt="Default Image" class="img-fluid rounded">
            @endif
          </div>
        </div>
        <div class="col-md-8">
          <p class="card-text">{{ $product->description }}</p>
          <a href="{{ route('products.desc_edit', $product->id) }}" class="btn btn-warning">Edit Description</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
