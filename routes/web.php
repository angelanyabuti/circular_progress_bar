<?php

use App\Models\HomeSlider;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*jjj*/




Route::get('/refund', function () {
    return view('refund');
})->name('refund');

Route::get('/activate', function () {
    return view('auth.activate');
})->name('activate');

Route::get("/", [\App\Http\Controllers\ShopController::class, 'index'])->name('start');

Route::get("/register/merchant", App\Http\Livewire\Auth\MerchantRegisterComponent::class)->name('auth.merchant');
Route::get("/register/member", App\Http\Livewire\Auth\MemberRegisterComponent::class)->name('auth.member');
Route::get("/register/plans", App\Http\Livewire\SubscribeComponent::class)->name('auth.plans');
Route::get("/invoice/invoice", App\Http\Livewire\ShowInvoice::class)->name('invoice.show');
Route::get('/pay-subscription', [\App\Http\Controllers\MerchantController::class, 'getPaySubscription'])->name('get.pay.subscription');
Route::get('/select-plan', [\App\Http\Controllers\MerchantController::class, "updatePlan"])->name('update.plan');

Route::get("/points", [\App\Http\Controllers\ShopController::class, "points"]);
Route::post("/index/categories/listings", [\App\Http\Controllers\ShopController::class, "categoryListings"])->name("categoryListings");

Route::post('/save-token', [App\Http\Controllers\ShopController::class, 'saveToken'])->name('save-token');

/*Market*/
Route::get('koupons', [\App\Http\Controllers\ShopController::class, 'koupons'])->name('koupons');
Route::get('product/{product}', [\App\Http\Controllers\ShopController::class, 'product'])->name('product');
Route::get('special-deals', [\App\Http\Controllers\ShopController::class, 'special'])->name('special-deals');
Route::get('special-deal/{event}', [\App\Http\Controllers\ShopController::class, 'specialDeal'])->name("specialDeal");
Route::post('special-deal', [\App\Http\Controllers\ShopController::class, 'postSpecialDeal'])->name("special-deal");
Route::get('maduka', [\App\Http\Controllers\ShopController::class, 'shops'])->name('maduka');
Route::get('duka/{shop}', [\App\Http\Controllers\ShopController::class, 'shop'])->name('duka');
Route::get('duk-map', [\App\Http\Controllers\ShopController::class, 'map'])->name('duka.map');
Route::get('category/{productCategory}', [\App\Http\Controllers\ShopController::class, 'category'])->name('category');
Route::get('categories', [\App\Http\Controllers\ShopController::class, 'categories'])->name('shop.categories');
Route::get('industry/{industry}', \App\Http\Livewire\Shop\SingleIndustryComponent::class)->name('shop.industry');
Route::get('my-cart', \App\Http\Livewire\Shop\CartComponent::class)->name('cart');
Route::get('my-orders', [\App\Http\Controllers\ShopController::class, 'orders'])->name('my.orders')->middleware('auth');
Route::get('pay/{order}', \App\Http\Livewire\Shop\PaymentComponent::class)->name('pay');
Route::get('checkout', [\App\Http\Controllers\ShopController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::get('confirm-received/{code}', [\App\Http\Controllers\ShopController::class, 'confirmReceived'])->name('confirmReceived');
Route::get('confirmed-received/{code}', [\App\Http\Controllers\ShopController::class, 'confirmedReceived'])->name('confirmedReceived');
Route::post('confirm-received/{code}', [\App\Http\Controllers\ShopController::class, 'confirmReceivedUpdate'])->name('updateConfirmReceived');


/*ipay callbak*/
Route::get('ipay-call-back',[\App\Http\Controllers\IpayController::class,'callBack'])->name('ipay.callBack');

Route::prefix('mpesa')->group(function () {
    Route::any('/callback', [\App\Http\Controllers\MpesaController::class, 'callback']);
});

Route::middleware(['auth:sanctum', 'verified', 'has.active.subscription'])->group(function () {
    Route::get('create-shop', \App\Http\Livewire\CreateShopComponent::class)->name('shop.create');
});


Route::post('ckeditor/upload', [App\Http\Controllers\CKEditorController::class,'upload'])->name('ckeditor.image-upload');

/*admin*/
Route::middleware(['auth:sanctum', 'verified', 'has.active.subscription', 'hasShop'])->group(function () {

    Route::get('admin/companies', \App\Http\Livewire\Admin\CompaniesComponent::class)->name('admincompanies');
    Route::get('admin/events', \App\Http\Livewire\Admin\EventsComponent::class)->name('adminevents');
    Route::get('admin/logistics', \App\Http\Livewire\Admin\LogisticsComponent::class)->name('logistics');
    Route::get('admin/orders', \App\Http\Livewire\Admin\OrdersComponent::class)->name('orders');
    Route::get('admin/payments', \App\Http\Livewire\Admin\ListPayments::class)->name('payments');
    Route::get('admin/agents', \App\Http\Livewire\Admin\AgentsComponent::class)->name('agents');


    Route::get('dashboard', \App\Http\Controllers\HomeController::class)->name('dashboard');
    Route::get('roles', \App\Http\Livewire\RolesComponent::class)->name('roles');
    Route::get('users', \App\Http\Livewire\UsersComponent::class)->name('users');
    Route::get('customers', \App\Http\Livewire\Admin\CustomerList::class)->name('customers');
    Route::get('merchants', \App\Http\Livewire\MerchantsComponent::class)->name('merchants');
    Route::get('plans', \App\Http\Livewire\PlansComponent::class)->name('plans');
    Route::get('home-slider', \App\Http\Livewire\HomesliderComponent::class)->name('home.sliders');
    Route::get('subscriptions', \App\Http\Livewire\ShowSubscriptions::class)->name('subscriptions.show');

    Route::get('messaging', \App\Http\Livewire\Admin\MessageComponent::class)->name('messaging');
    Route::get('merchant/users', \App\Http\Livewire\Merchant\UsersComponent::class)->name('merchant.users');
    Route::get('merchant/roles', \App\Http\Livewire\Merchant\UsersRoleComponent::class)->name('merchant.roles');
    Route::get('merchant/messages/{shop}', \App\Http\Livewire\Merchant\Messaging::class)->name('merchant.messages');


    Route::get('riders', \App\Http\Livewire\Merchant\RidersComponent::class)->name('riders');
    Route::get('rider/{id}', \App\Http\Livewire\RiderProfileComponent::class)->name('rider.profile');
    Route::get('shop-settings', \App\Http\Livewire\Merchant\ShopSettingsComponent::class)->name('shop.settings');
    Route::get('shipping-batched', \App\Http\Livewire\Merchant\ShippingBatchedComponent::class)->name('batch.shipping');

    Route::get('my-wallet', \App\Http\Livewire\WalletComponent::class)->name('my.wallet');
    Route::get('my-profile', \App\Http\Livewire\MyProfileComponent::class)->name('my.profile');


    Route::get('users-peck-wallet/{user}', [\App\Http\Livewire\Admin\UserPeckWallet::class])->name('pack.wallets');

    Route::get('inventory/categories', \App\Http\Livewire\ProductCategoryComponent::class)->name('categories');
    Route::get('inventory/industries', \App\Http\Livewire\Admin\IndustryComponent::class)->name('industries');
    Route::get('shops', \App\Http\Livewire\ShopComponent::class)->name('shops');

    Route::get('shops/single/{shop}', \App\Http\Livewire\SingleShopComponent::class)->name('single.shop');
});


