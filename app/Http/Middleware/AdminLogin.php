<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
{
    public function handle($request, Closure $next)
    {
        if (!session('user')) {
            return redirect('admin/login');
        }
        return $next($request);
    }
}
