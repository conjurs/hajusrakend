@extends('layouts.app')

@section('title', $product->name . ' - Shop - Hajusrakendused')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>{{ $product->name }}</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Products
        </a>
        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                <i class="bi bi-trash"></i> Delete
            </button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        @if($product->image)
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
        @else
        <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 400px;">
            <i class="bi bi-image text-muted" style="font-size: 5rem;"></i>
        </div>
        @endif
    </div>
    <div class="col-md-7">
        <div class="card h-100">
            <div class="card-body">
                <h3 class="text-danger mb-3">${{ number_format($product->price, 2) }}</h3>
                
                <div class="mb-4">
                    <h5>Description</h5>
                    <p>{{ $product->description }}</p>
                </div>
                
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="10">
                        </div>
                        <div class="col-md-8 mb-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 