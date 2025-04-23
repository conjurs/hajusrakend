<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Traits\CartSession;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    use CartSession;

    public function index()
    {
        $sessionId = $this->getCartSessionId();
        $cart = Cart::where('session_id', $sessionId)->first();
        
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $items = $cart->items;
        $total = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('shop.checkout.index', compact('items', 'total'));
    }
} 