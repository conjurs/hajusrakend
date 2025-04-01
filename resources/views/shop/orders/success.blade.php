@extends('layouts.app')

@section('title', 'Order Confirmed')

@section('content')
<div class="container py-5" style="background: #111111; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <div class="progress mb-4" style="height: 4px; background: rgba(255,255,255,0.1);">
                <div class="progress-bar" role="progressbar" style="width: 100%; background: #0066FF;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <div class="success-content p-4" style="background: rgba(255,255,255,0.05); border-radius: 12px;">
                <div class="mb-4">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="#0066FF" stroke-width="2"/>
                        <path d="M8 12L11 15L16 9" stroke="#0066FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>

                <h1 class="h3 mb-4 text-white">Thank You for Your Order!</h1>

                <div class="order-details text-start p-4 mb-4" style="background: rgba(255,255,255,0.05); border-radius: 8px;">
                    <h5 class="text-white mb-3">Order Details</h5>
                    <div class="mb-2">
                        <span class="text-muted">Order Number:</span>
                        <span class="text-white ms-2">#{{ $order->id }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">Name:</span>
                        <span class="text-white ms-2">{{ $order->first_name }} {{ $order->last_name }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">Email:</span>
                        <span class="text-white ms-2">{{ $order->email }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">Phone:</span>
                        <span class="text-white ms-2">{{ $order->phone }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-muted">Payment Method:</span>
                        <span class="text-white ms-2">{{ ucfirst($order->payment_method) }}</span>
                    </div>
                    <div>
                        <span class="text-muted">Total Amount:</span>
                        <span class="text-white ms-2">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('products.index') }}" class="btn" style="background: #0066FF; color: white;">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 