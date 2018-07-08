<?php
/**
 * Created by PhpStorm.
 * User: yanyue
 * Date: 2018/4/6
 * Time: 16:51
 */
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('cadre/login');
            }
        }
        return $next($request);
    }
}