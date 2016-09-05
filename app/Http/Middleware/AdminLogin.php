<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * 在中间件里判断session存不存在.如果不存在。则跳转到登录页
         * 这里的判断对应LoginController里面的quit方法
         */
        if (!session('user')) {
            return redirect('admin/login');
        }
        return $next($request);
    }
}
