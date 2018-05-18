<?php

namespace SenseBook\Http\Middleware;

use Closure;
use SenseBook\Models\General;
use Illuminate\Support\Facades\Auth;

class CheckShop
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd("test");
        $user = Auth::user();
        
        $General = General::select()->orderBy('id', 'desc')->first();
        if (!empty($General)) {
            $check = ( $General->is_maintenance==1 || $General->is_close==1 ) && $user->type!='admin';
            if ($check) {
                return abort(420, "General");
            }
        }
        return $next($request);
    }
}
