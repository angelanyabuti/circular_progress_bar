<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Event;
use App\Models\HomeSlider;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Shop;
use App\Models\User;
use App\Notifications\NewOrderNotificaton;
use Carbon\Carbon;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    /**
     * Write code on Method
     *
     */
    public function index()
    {

        $slides = HomeSlider::all();
        $categories = ProductCategory::whereNull("parent_id")->orderBy('id', 'ASC')->limit(4)->get();
        $sub_categories = ProductCategory::whereNotNull("parent_id")->orderBy('id', 'ASC')->limit(6)->get();

        return view('index', compact('slides', 'categories', 'sub_categories'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryListings(Request $request)
    {
        $category_id = $request -> input("category");

        $categories = ProductCategory::with('products')->where("parent_id",$category_id)->inRandomOrder()->limit(6)->get();
        $categories_array = array();

        foreach ($categories as $category) {
            $value['id'] = $category['id'];
            $value['products'] = $category->products->count();
            $value['name'] = ucfirst($category['name']);
            $categories_array[] = $value;
        }

        $response = array(
            "status" => "00",
            "categories" => $categories_array
        );

        return response()->json($response);

    }

    public function saveToken(Request $request)
    {
        auth()->user()->update(['device_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }

    public function product(Product $product)
    {

        return view('shop.product', compact('product'));
    }

    public function koupons()
    {
        return view('shop.koupons');
    }

    public function category(ProductCategory $productCategory)
    {
        return view('shop.category', compact('productCategory'));
    }

    public function categories()
    {
//        $categories = ProductCategory::has('products')->get();
        return view('shop.categories');
    }

    public function orders()
    {
        return view('shop.customer-orders');
    }

    public function cart()
    {
        $cart = Cart::session(session()->getId());
        if ($cart->isEmpty()) {
            return $this->emptyCart();
        }
        $items = $cart->getContent();
        return redirect()->route('cart');
    }

    public function emptyCart()
    {
        return redirect('/')->with('message', 'Your art is empty');
//        dd('ll');
    }

    public function checkout()
    {
        $uuid = Session::get('basket');
        $cart = Cart::session($uuid);

        if ($cart->isEmpty()) {
            return $this->emptyCart();
        }

        /*create customer*/

        $user = Auth::user();

        /*cart*/

        $items = $cart ->getContent();

        /*create Order*/

        $order = new Order();
        $order -> customer_id = $user ->id;
        $order -> amount = $cart -> getTotal();
        $order -> address = $user-> address;
        $order -> status = OrderStatus::PENDING;
        $order ->save();

        /*create Order Items*/


        foreach ($items as $item)
        {
            $order_item = new OrderItem();
            $order_item -> product_id = $item -> model -> id;
            $order_item -> shop_id = $item -> model -> shop_id;
            $order_item -> order_id = $order ->id;
            $order_item -> price = $item -> model -> price;
            $order_item -> quantity = $item -> quantity;
            $order_item -> sub_total = $item -> getPriceSum();
            $order_item -> code = Str::random(8);
            $order_item -> save();
        }

        $cart->clear();



        /*notify admin and shop of new Order*/
        $recipients = User::where('id', $user->id)->where('role_id',1 )->get();
        Notification::send($recipients ,  new NewOrderNotificaton());
        $cart->clear();



        if ( $order ->amount > 0)
        {
           

            return redirect()->route('cart');
        }
        session()->flash('success','Present CODE to Merchant ');
        return redirect()->route('pay', $order);
        /*Redirect to Payments*/ 
    }


    public function shop(Shop $shop)
    {
        return view('shop.shop', compact('shop'));
    }

    public function shops()
    {
        return view('shop.shops');
    }

    public function map()
    {
        return view('shop.map');
    }

    public function special()
    {
        $events = Event::where('status', true)->get();
        return view('shop.special-deals', compact("events"));
    }

    public function specialDeal(Event $event)
    {
        return view('shop.special-deal', compact("event"));
    }

    public function postSpecialDeal(Request $request)
    {

        $user = User::firstOrCreate(
            [
             'email' => $request->email,
            ],
            [
            'email' => $request->email,
            'name' => $request->name
        ]);

        DB::table('event_subscriptions')->insert([
            'event_id' => $request->input('event'),
            'user_id' => $user ->id,
            'event_date' => date('Y-m-d', strtotime($request->input('event_date'))),
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('special-deals');
    }

    public function profile()
    {
        return view('customer-profile');
    }

    public function points()
    {
        $points = Shop::where('active', '=', true)->select(['name', 'slug', 'latitude', 'longitude',])
            ->has('products')
            ->with(['products' => function($q)
            {
                $q -> active();
            }
            ])
            ->limit(10)
            ->get();

        $points->map(function ($item) {
            $item->url = route('duka', $item->slug);

            return $item;
        });

        $points = json_encode($points);

        return $points;
    }

    public function confirmReceived($code)
    {
        $order = Order::where('receive_confirm_code','=',$code)->firstOrFail();

        if ($order->order_received_confirmed_at) {
            return redirect()->route('confirmedReceived', $code);
        }

        return view('customer.confirm-order', compact('order'));
    }

    public function confirmedReceived($code)
    {
        $order = Order::where('receive_confirm_code','=',$code)->firstOrFail();

        return view('customer.order-confirmed', compact('order'));
    }

    public function confirmReceivedUpdate(Request $request, $code)
    {
        $order = Order::where('receive_confirm_code','=',$code)->firstOrFail();
        $order->order_received = $request->received;
        $order->order_received_confirmed_at = now();
        $order->save();

        return redirect()->route('confirmedReceived', $code);
    }
}
