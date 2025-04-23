@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Shopping Cart</h1>
            </div>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(count($items) > 0)
                <div class="card">
                    <div class="card-body">
                        <div class="cart-items">
                            @foreach($items as $item)
                                <div class="cart-item d-flex align-items-center py-3 border-bottom">
                                    <div class="cart-item-image me-4">
                                        @if($item->product->image)
                                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="cart-item-details flex-grow-1">
                                        <h5 class="mb-1">{{ $item->product->name }}</h5>
                                        <div class="text-muted small mb-2">${{ number_format($item->product->price, 2) }}</div>
                                        
                                        <div class="d-flex align-items-center">
                                            <div class="quantity-control d-flex align-items-center">
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateCartQuantity('{{ $item->id }}', -1)">−</button>
                                                <span class="quantity-display mx-3">{{ $item->quantity }}</span>
                                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateCartQuantity('{{ $item->id }}', 1)">+</button>
                                            </div>
                                            
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="ms-3">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 border-0">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="cart-item-total ms-4">
                                        <span class="fw-bold">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="cart-summary mt-4">
                            <div class="d-flex justify-content-between align-items-center py-3">
                                <span class="text-muted">Subtotal</span>
                                <span class="fw-bold">${{ number_format($total, 2) }}</span>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="{{ route('checkout.index') }}" class="btn btn-primary">Continue to Checkout</a>
                                <a href="{{ route('products.index') }}" class="btn btn-link text-muted">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body text-center py-5">
                        <h4 class="mb-3">Your cart is empty</h4>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Start Shopping</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
function updateCartQuantity(itemId, change) {
    const cartItem = event.target.closest('.cart-item');
    const quantityDisplay = cartItem.querySelector('.quantity-display');
    const currentQty = parseInt(quantityDisplay.textContent);
    const newQty = Math.max(1, Math.min(10, currentQty + change));
    
    if (newQty === currentQty) {
        return;
    }

    const form = new FormData();
    form.append('_token', '{{ csrf_token() }}');
    form.append('quantity', newQty);
    
    fetch(`/cart/update/${itemId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: form
    })
    .then(response => response.json())
    .then(data => {
        quantityDisplay.textContent = data.quantity;
        cartItem.querySelector('.cart-item-total span').textContent = '$' + data.itemTotal;
        
        const cartSubtotal = document.querySelector('.cart-summary .fw-bold');
        if (cartSubtotal) {
            cartSubtotal.textContent = '$' + data.cartTotal;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        location.reload();
    });
}
</script>
@endpush
@endsection 