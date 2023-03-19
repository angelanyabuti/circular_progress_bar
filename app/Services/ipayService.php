<?php


namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

class ipayService
{
    public function ipayFrame($invoice)
    {
        $fields = array(
            "live"=> "0",
            "oid"=> $invoice ->id,
            "inv"=> $invoice ->id,
            "ttl"=> $invoice ->amount + $invoice -> shipping_cost,
            "tel"=> '0'.substr($invoice -> customer -> phone, -9),
            "eml"=>  $invoice -> customer -> email,
            "vid"=> config('ipay.vendor_id'),
            "p1"=> "",
            "p2"=> "",
            "p3"=> "",
            "p4"=> "900",
            "curr"=> "KES",
            "cbk"=> route('ipay.callBack'),
            "cst"=> "1",
            "crl"=> "2"
        );

        $datastring =  $fields['live'].$fields['oid'].$fields['inv'].$fields['ttl'].$fields['tel'].$fields['eml'].$fields['vid'].$fields['curr'].$fields['p1'].$fields['p2'].$fields['p3'].$fields['p4'].$fields['cbk'].$fields['cst'].$fields['crl'];

        $hashkey = config('ipay.hash_key');
        $generated_hash = hash_hmac('sha1',$datastring , $hashkey);

        return [$generated_hash, $fields];
    }

}
