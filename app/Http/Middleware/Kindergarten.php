<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Zend\Diactoros\Response;

class Kindergarten
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $managerAuth = Auth::guard('manager')->user();
        $kindergarten = $managerAuth->kindergarten;
        if (($kindergarten->email == null && $kindergarten->mobile_number == null && $kindergarten->phone_number == null
            || $kindergarten->description == null || $kindergarten->full_address == null)) {
            return response()->json(['data' => false]);
        }
        return $next($request);
    }
}
