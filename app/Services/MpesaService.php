<?php


namespace App\Services;


use App\Models\MpesaOperation;
use SmoDav\Mpesa\Laravel\Facades\Simulate;
use SmoDav\Mpesa\Laravel\Facades\STK;

class MpesaService
{
    const CUSTOMER_BUYGOODS_ONLINE = 'CustomerBuyGoodsOnline';
    public function push($amount, $phone)
    {
        $stk = new STK();
        $response = $stk->push($amount, $phone, 'Some Reference', 'Test Payment');

//        $response = STK::request($amount)
//            ->from($phone)
//            ->usingReference('Some Reference', 'Test Payment')
//            ->setCommand(self::CUSTOMER_BUYGOODS_ONLINE)
//            ->push();


        $res = (array)$response;
        if (array_key_exists("ResponseCode",$res))
        {
            if ($res['ResponseCode'] == 0)
            {
                $mpesaOperation = MpesaOperation::create([
                    'merchant_request_id' =>  $res['MerchantRequestID'],
                    'checkout_request_id' =>  $res['CheckoutRequestID'],
                    'response_code' =>  $res['ResponseCode'],
                    'response_description' =>  $res['ResponseDescription'],
                    'customer_message' =>  $res['CustomerMessage'],
                ]);

            }
        }
        else
        {
            dd($response) ;
        }
    }

}
