<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait CartSession
{
    protected function getCartSessionId()
    {
        if (!session()->has('cart_session_id')) {
            session(['cart_session_id' => Str::uuid()->toString()]);
        }
        
        return session('cart_session_id');
    }
} 