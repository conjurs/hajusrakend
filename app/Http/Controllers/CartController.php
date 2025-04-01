<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{

    public function index()
    {
        $sessionId = $this->getCartSessionId();
        $cart = Cart::where('session_id', $sessionId)->first();
        $items = $cart ? $cart->items : collect();
        
        $total = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $showCheckout = request()->has('checkout');
        
        return view('shop.cart.index', compact('items', 'total', 'showCheckout'));
    }

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $sessionId = $this->getCartSessionId();
        
        $cart = Cart::firstOrCreate(['session_id' => $sessionId]);
        
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $validated['product_id'])
            ->first();
            
        if ($cartItem) {
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            $cartItem = new CartItem([
                'cart_id' => $cart->id,
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ]);
            $cartItem->save();
        }
        
        return redirect()->route('cart.index')->with('success', 'Product added to cart');
    }
    
    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $cartItem = CartItem::findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        $cart = $cartItem->cart;
        $cartTotal = $cart->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $itemTotal = $cartItem->product->price * $cartItem->quantity;

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated successfully',
            'quantity' => $cartItem->quantity,
            'itemTotal' => number_format($itemTotal, 2),
            'cartTotal' => number_format($cartTotal, 2)
        ]);
    }
    
    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
        
        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }
    
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
        ]);
        
        $sessionId = $this->getCartSessionId();
        $cart = Cart::firstOrCreate(['session_id' => $sessionId]);
        
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();
            
        if ($cartItem) {
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            $cartItem = new CartItem([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
            ]);
            $cartItem->save();
        }
        
        return redirect()->route('cart.index')->with('success', 'Product added to cart');
    }

    private function getCartSessionId()
    {
        if (!session()->has('cart_session_id')) {
            session(['cart_session_id' => Str::uuid()->toString()]);
        }
        
        return session('cart_session_id');
    }
    
    /**
     * Clear cart
     */
    public function clearCart()
    {
        $sessionId = $this->getCartSessionId();
        $cart = Cart::where('session_id', $sessionId)->first();
        
        if ($cart) {
            CartItem::where('cart_id', $cart->id)->delete();
        }
        
        return redirect()->route('cart.index')->with('success', 'Cart cleared');
    }
}
