<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait CartSession
{
    protected function getCartSessionId()
    {
        $sessionId = session('cart_session_id');
        
        if (!$sessionId) {
            $sessionId = Str::random(40);
            session(['cart_session_id' => $sessionId]);
        }
        
        return $sessionId;
    }
} 