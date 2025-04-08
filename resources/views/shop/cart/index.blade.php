@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container py-5" style="background: #111111; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-white mb-0">{{ $showCheckout ? 'Checkout' : 'Shopping Cart' }}</h1>
                @if($showCheckout)
                    <button onclick="showCart()" class="btn text-white" style="background: rgba(255,255,255,0.1);">
                        ← Back to Cart
                    </button>
                @endif
            </div>

            @if(count($items) > 0)
                <div class="progress mb-4" style="height: 4px; background: rgba(255,255,255,0.1);">
                    <div class="progress-bar" role="progressbar" style="width: {{ $showCheckout ? '66%' : '33%' }}; background: #0066FF;" aria-valuenow="{{ $showCheckout ? '66' : '33' }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div id="cartContent" style="display: {{ $showCheckout ? 'none' : 'block' }};">
                    <div class="cart-items">
                        @foreach($items as $item)
                            <div class="cart-item d-flex align-items-center py-4" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                                <div class="cart-item-image me-4">
                                    @if($item->product->image)
                                        <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <div class="bg-dark rounded d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="cart-item-details flex-grow-1">
                                    <h5 class="mb-1 text-white">{{ $item->product->name }}</h5>
                                    <div class="text-muted small mb-2">${{ number_format($item->product->price, 2) }}</div>
                                    
                                    <div class="d-flex align-items-center">
                                        <div class="quantity-control d-flex align-items-center">
                                            <button type="button" class="quantity-btn minus" onclick="updateCartQuantity('{{ $item->id }}', -1)">−</button>
                                            <span class="quantity-display mx-3 text-white">{{ $item->quantity }}</span>
                                            <button type="button" class="quantity-btn plus" onclick="updateCartQuantity('{{ $item->id }}', 1)">+</button>
                                        </div>
                                        
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="ms-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 border-0" style="color: #FF4444;">Remove</button>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="cart-item-total ms-4">
                                    <span class="text-white">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="cart-summary mt-4">
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted">Subtotal</span>
                            <span class="text-white">${{ number_format($total, 2) }}</span>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button onclick="showCheckout()" class="btn" style="background: #0066FF; color: white;">Continue to Checkout</button>
                            <a href="{{ route('products.index') }}" class="btn btn-link text-muted">Continue Shopping</a>
                        </div>
                    </div>
                </div>

                <div id="checkoutContent" style="display: {{ $showCheckout ? 'block' : 'none' }};">
                    <div class="checkout-form" style="background: rgba(255,255,255,0.05); border-radius: 12px; padding: 24px;">
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-white">First Name</label>
                                    <input type="text" name="first_name" class="form-control" style="background: rgba(255,255,255,0.1); border: none; color: white;" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-white">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" style="background: rgba(255,255,255,0.1); border: none; color: white;" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-white">Email</label>
                                <input type="email" name="email" class="form-control" style="background: rgba(255,255,255,0.1); border: none; color: white;" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-white">Phone</label>
                                <input type="tel" name="phone" class="form-control" style="background: rgba(255,255,255,0.1); border: none; color: white;" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-white">Payment Method</label>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="bank" value="bank" checked style="background-color: #0066FF; border-color: #0066FF;">
                                        <label class="form-check-label text-white" for="bank">
                                            🏦 Bank Transfer
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="card" value="card" style="background-color: #0066FF; border-color: #0066FF;">
                                        <label class="form-check-label text-white" for="card">
                                            💳 Credit Card
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal" style="background-color: #0066FF; border-color: #0066FF;">
                                        <label class="form-check-label text-white" for="paypal">
                                            PayPal
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="order-summary p-3 mb-4" style="background: rgba(255,255,255,0.05); border-radius: 8px;">
                                <h5 class="text-white mb-3">Order Summary</h5>
                                @foreach($items as $item)
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">{{ $item->product->name }} × {{ $item->quantity }}</span>
                                        <span class="text-white">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                                    </div>
                                @endforeach
                                <hr style="border-color: rgba(255,255,255,0.1);">
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Total</span>
                                    <span class="text-white">${{ number_format($total, 2) }}</span>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn" style="background: #0066FF; color: white;">Complete Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <h4 class="mb-3 text-white">Your cart is empty</h4>
                    <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('products.index') }}" class="btn" style="background: #0066FF; color: white;">Start Shopping</a>
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
        
        const cartSubtotal = document.querySelector('.cart-summary .text-white');
        if (cartSubtotal) {
            cartSubtotal.textContent = '$' + data.cartTotal;
        }
        
        const checkoutTotal = document.querySelector('.order-summary .text-white:last-child');
        if (checkoutTotal) {
            checkoutTotal.textContent = '$' + data.cartTotal;
        }
        
        const itemName = cartItem.querySelector('.text-white').textContent;
        const orderSummaryItems = document.querySelectorAll('.order-summary .d-flex');
        orderSummaryItems.forEach(item => {
            const itemText = item.querySelector('.text-muted');
            if (itemText && itemText.textContent.includes(itemName)) {
                const itemTotal = item.querySelector('.text-white');
                if (itemTotal) {
                    itemTotal.textContent = '$' + data.itemTotal;
                }
                itemText.textContent = itemName + ' × ' + data.quantity;
            }
        });
    })
    .catch(error => {
        console.error('Error:', error);
        location.reload();
    });
}

function showCheckout() {
    document.getElementById('cartContent').style.display = 'none';
    document.getElementById('checkoutContent').style.display = 'block';
    document.querySelector('.progress-bar').style.width = '66%';
    document.querySelector('h1').textContent = 'Checkout';
}

function showCart() {
    document.getElementById('cartContent').style.display = 'block';
    document.getElementById('checkoutContent').style.display = 'none';
    document.querySelector('.progress-bar').style.width = '33%';
    document.querySelector('h1').textContent = 'Shopping Cart';
}
</script>

<style>
.quantity-control {
    background: rgba(255,255,255,0.1);
    border-radius: 6px;
    padding: 4px 12px;
}
.quantity-btn {
    background: none;
    border: none;
    color: #0066FF;
    font-size: 1.2rem;
    padding: 0;
    cursor: pointer;
}
.quantity-btn:hover {
    color: #0052CC;
}
.quantity-display {
    min-width: 20px;
    text-align: center;
}
.cart-item:last-child {
    border-bottom: none !important;
}
.form-control:focus {
    background: rgba(255,255,255,0.15);
    border: none;
    box-shadow: none;
    color: white;
}
.form-control::placeholder {
    color: rgba(255,255,255,0.5);
}
</style>
@endsection 