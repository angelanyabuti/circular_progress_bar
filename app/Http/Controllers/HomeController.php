<?php

namespace App\Http\Controllers;

use App\Configs\Configs;
use App\Models\HomeSlider;
use App\Models\Shop;
use App\Traits\RedirectTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __invoke(Request $request)
    {
        switch (Auth::user()->type) {
            case Configs::ADMIN_ROLE_TYPE:
                $shops = Shop::all();

                $orders = DB::table('orders')
                    ->count();
                $sales = DB::table('orders')
                    ->where('status','=','completed')
                    ->sum('amount');

                $products = DB::table('products')
                    ->count();

                $customers = DB::table('users')
                    ->where('type','=','customer')
                    ->count();
                $merchants = DB::table('users')
                    ->where('type','=','merchant')
                    ->count();

                $data = [
                    'orders'=>$orders,
                    'sales'=>$sales,
                    'products'=>$products,
                    'customers'=>$customers,
                    'merchants'=>$merchants
                ];

                return view('dashboard', compact('shops','data'));
            case Configs::MERCHANT_ROLE_TYPE:
                return redirect()->route('shops');
            case Configs::CUSTOMER_ROLE_TYPE:
                return  redirect('/');
            default:
                return view('merchant.cashier');
        }

    }

}
