<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        return view('shop.checkout.index', compact('total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:bank,card,paypal',
        ]);

        $sessionId = session('cart_session_id');
        $cart = Cart::where('session_id', $sessionId)->first();
        
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $total = $cart->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        session()->flash('dummy_order', [
            'id' => rand(1000, 9999),
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'total_amount' => $total,
            'created_at' => now()
        ]);

        session()->forget('cart_session_id');

        return redirect()->route('orders.success');
    }

    public function success()
    {
        if (!session()->has('dummy_order')) {
            return redirect()->route('cart.index');
        }

        $order = (object) session()->get('dummy_order');
        return view('shop.orders.success', compact('order'));
    }

    public function show()
    {
        return redirect()->route('cart.index');
    }
}
