<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActiveSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $subs = auth()->user()->activeSubscriptions();

        if (($subs -> count() < 1) && auth()->user()->type !== 'internal' && auth()->user()->type !== 'customer') {
            return redirect()->route('get.pay.subscription');
            /*get merchant company*/
//            return redirect()->route('shop.create');

        }

        return $next($request);
    }
}
