<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Invoice;
use App\Models\IpayTransaction;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IpayController extends Controller
{
    public function callBack(Request $request)
    {
        /*record payment*/
        $data = $request->all();

        if (str_starts_with($data['id'],'inv-')) {
            $invoice = Invoice::where('id','=', substr($data['id'],4))->first();

            return $this->handleSubscriptionPayment($data, $invoice);
        } else {
            $order = Order::where('id',$data['id'])->first();

            return $this->handleOrderPayment($data, $order);
        }
    }

    public function handleOrderPayment(array $data, Order $order)
    {
        $ipayTxn = new IpayTransaction();
        $ipayTxn->order_id = $order->id;
        $ipayTxn->invoice_number = $data['ivm'];
        $ipayTxn->amount = $data['mc'];
        $ipayTxn->txn_code = $data['txncd'];
        $ipayTxn->registered_name = $data['msisdn_id'];
        $ipayTxn->registered_number = $data['msisdn_idnum'];
        $ipayTxn->channel = $data['channel'];
        $ipayTxn->save();

        $order ->update([
            'status'=> OrderStatus::PAID
        ]);

        /*record Payment*/
        $payment = new Payment();
        $payment -> ref = $data['txncd'];
        $payment -> amount = $ipayTxn ->amount;
        $payment -> source = 'ipay';
//        $payment -> currency = 'kes';
        $payment -> user_id = $order -> customer_id;
        $payment -> order_id = $order -> id;
        $payment ->save();
//        $ipayTxn ->transactions()->save($payment);

        /*reduce stock*/
        foreach ($order ->items as $item) {
            DB::table('products')
                ->where('id', '=', $item->product_id)
                ->decrement('quantity', 1);
        }

        /*give user pecks*/
        $user = $order->customer;

        $wallet = $user->hasWallet('peck-wallet');
        if ($wallet) {
            $pw = $user->getWallet('peck-wallet');
        } else {
            $pw = $user->createWallet([
                'name' => 'peck Wallet',
                'slug' => 'peck-wallet',
            ]);
        }

        $points = intdiv($payment->amount, 100);

        $pw->deposit($points);

        /*send money to KZ wallet*/
        $user = User::where('type', 'internal')->first();
        $user ->depositFloat($payment->amount);

        /*update shop wallet*/
        foreach ($order ->items  as $item)
        {

            $wallet = $item->shop->hasWallet('holding');
            if ($wallet) {
                $pw = $item->shop->getWallet('holding');
            } else {
                $pw = $item->shop->createWallet([
                    'name' => 'holding',
                    'slug' => 'holding',
                ]);
            }
            $pw->depositFloat($item -> price);

        }

        return redirect('/my-orders')->with('message','Order Completed');
    }

    public function handleSubscriptionPayment(array $data, Invoice $invoice)
    {
        $user = $invoice->user;
        $plan = $invoice->plan;

        $ipayTxn = new IpayTransaction();
        $ipayTxn->invoice_id = $invoice->id;
        $ipayTxn->invoice_number = $data['ivm'];
        $ipayTxn->amount = $data['mc'];
        $ipayTxn->txn_code = $data['txncd'];
        $ipayTxn->registered_name = $data['msisdn_id'];
        $ipayTxn->registered_number = $data['msisdn_idnum'];
        $ipayTxn->channel = $data['channel'];
        $ipayTxn->save();

        $invoice ->update([
            'paid'=> 1
        ]);

        if (!$user->subscribedTo($plan->id)) {

            $user->newSubscription($plan->name . ' - ' . 'Main', $plan);
        } else {

            $user->subscription($plan->slug)->renew();
        }

        return redirect(route('dashboard'))
            ->withSuccess('Your subscription has been updated.');
    }
}
