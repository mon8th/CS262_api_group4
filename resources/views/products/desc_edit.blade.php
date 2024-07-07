@extends('layouts.app')

@section('title', 'Edit Description')

@section('content')
<div class="pagetitle">
  <h1>Edit Description</h1>
</div>
<section class="section">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">{{ $product->name }}</h5>
      <form action="{{ route('products.desc_update', $product->id) }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="description">Update Description</label>
          <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-warning mt-3">Save Description</button>
      </form>
    </div>
  </div>
</section>
@endsection
