@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5" style="background: #111111; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="h3 mb-4 text-white">Checkout</h1>

            <div class="progress mb-4" style="height: 4px; background: rgba(255,255,255,0.1);">
                <div class="progress-bar" role="progressbar" style="width: 66%; background: #0066FF;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <div class="checkout-form p-4" style="background: rgba(255,255,255,0.05); border-radius: 12px;">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <h5 class="text-white mb-3">Contact Information</h5>
                        <div class="mb-3">
                            <label class="form-label text-muted">Email</label>
                            <input type="email" name="email" class="form-control" style="background: rgba(255,255,255,0.1); border: none; color: white;" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-white mb-3">Shipping Address</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">First Name</label>
                                <input type="text" name="first_name" class="form-control" style="background: rgba(255,255,255,0.1); border: none; color: white;" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted">Last Name</label>
                                <input type="text" name="last_name" class="form-control" style="background: rgba(255,255,255,0.1); border: none; color: white;" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Address</label>
                            <input type="text" name="address" class="form-control" style="background: rgba(255,255,255,0.1); border: none; color: white;" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">City</label>
                                <input type="text" name="city" class="form-control" style="background: rgba(255,255,255,0.1); border: none; color: white;" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Country</label>
                                <input type="text" name="country" class="form-control" style="background: rgba(255,255,255,0.1); border: none; color: white;" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Postal Code</label>
                                <input type="text" name="postal_code" class="form-control" style="background: rgba(255,255,255,0.1); border: none; color: white;" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-white mb-3">Payment Method</h5>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="card" value="card" checked style="background-color: #0066FF; border-color: #0066FF;">
                                <label class="form-check-label text-white" for="card">
                                    Credit Card
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

                    <div class="cart-summary mt-4 p-3" style="background: rgba(255,255,255,0.05); border-radius: 8px;">
                        <h5 class="text-white mb-3">Order Summary</h5>
                        @foreach($items as $item)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">{{ $item->product->name }} × {{ $item->quantity }}</span>
                                <span class="text-white">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                            </div>
                        @endforeach
                        <hr style="border-color: rgba(255,255,255,0.1);">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Total</span>
                            <span class="text-white">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn" style="background: #0066FF; color: white;">Complete Order</button>
                        <a href="{{ route('cart.index') }}" class="btn btn-link text-muted">Return to Cart</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
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