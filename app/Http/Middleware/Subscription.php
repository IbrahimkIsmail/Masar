<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Subscription
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
        $auth_id = Auth::guard('manager')->user()->id;
        $manager_in_subscription = \App\Model\Subscription::where('manager_id', $auth_id)->first();

        if ($manager_in_subscription == null) {
            return response()->json(['subscription_message' => 'لقد انتهى اشتراكك يرجى تجديد الاشتراك بامكانك الاتصال على الرقم 0597669248 للتفاصيل'], 401);

        } else if (strtotime(now()) >= strtotime($manager_in_subscription->expiration_date)) {
            return response()->json(['subscription_message' => 'لقد انتهى اشتراكك يرجى تجديد الاشتراك بامكانك الاتصال على الرقم 0597669248 للتفاصيل'], 401);

        } else {
            return $next($request);

        }
    }
}
