<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleDeployedPath
{
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();
        
        if (strpos($path, 'current/public/index.php/') === 0) {
            $newPath = substr($path, strlen('current/public/index.php/'));
            $request->server->set('REQUEST_URI', '/' . $newPath);
        }
        
        return $next($request);
    }
} 