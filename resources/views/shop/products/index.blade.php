@extends('layouts.app')

@section('title', 'Shop - Hajusrakendused')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>Shop</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('cart.index') }}" class="btn btn-cyan">
            <i class="bi bi-cart"></i> View Cart
        </a>
    </div>
</div>

<div class="row">
    @forelse($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="product-image-container">
                @if($product->image)
                <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                @else
                <div class="card-img-top d-flex align-items-center justify-content-center">
                    <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                </div>
                @endif
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text text-truncate">{{ $product->description }}</p>
                <p class="card-text fw-bold text-cyan">${{ number_format($product->price, 2) }}</p>
                
                <form action="{{ route('cart.store', $product) }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="number" class="form-control bg-custom-dark text-white border-secondary" name="quantity" value="1" min="1" max="10">
                        <button class="btn btn-cyan" type="submit">
                            <i class="bi bi-cart-plus"></i> Add
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-transparent">
                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-cyan">
                    <i class="bi bi-eye"></i> Details
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info">
            No products found.
        </div>
    </div>
    @endforelse
</div>
@endsection 