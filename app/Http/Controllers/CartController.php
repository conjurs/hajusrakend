<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\CartSession;
use Illuminate\Support\Str;

class CartController extends Controller
{
    use CartSession;

    public function index()
    {
        $sessionId = $this->getCartSessionId();
        $cart = Cart::firstOrCreate(['session_id' => $sessionId]);
        $items = $cart->items;
        
        $total = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        
        return view('shop.cart.index', compact('items', 'total'));
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
        
        return redirect()->route('cart.index');
    }
    
    public function updateQuantity(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
        ]);
        
        $cartItem = CartItem::findOrFail($id);
        $cartItem->quantity = $validated['quantity'];
        $cartItem->save();
        
        $total = $cartItem->product->price * $cartItem->quantity;
        $cartTotal = $cartItem->cart->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        
        return response()->json([
            'quantity' => $cartItem->quantity,
            'itemTotal' => number_format($total, 2),
            'cartTotal' => number_format($cartTotal, 2),
        ]);
    }
    
    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
        
        return redirect()->route('cart.index');
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
        
        return redirect()->route('cart.index')->with('success', 'Item added to cart');
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
        
        session()->forget('cart_session_id');
        
        return redirect()->route('cart.index');
    }
}
