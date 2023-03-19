<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasShop
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->type == 'merchant') {
            /*get merchant company*/
            $company = auth()->user()->company_id;
            $shops = DB::table('shops')->where('company_id','=',  $company)->count();
            if ($shops < 1){
                return redirect()->route('shop.create');
            }

        }

        return $next($request);
    }
}
