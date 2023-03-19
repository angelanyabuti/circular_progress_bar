<?php

namespace App\Http\Controllers;

use App\Models\MpesaOperation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MpesaController extends Controller
{
    public function callback(Request $request)
    {

        Log::info($request);

        $reponseContent = json_decode($request->getContent(), true);

        $stkCallback = $reponseContent['Body']['stkCallback'];

        $CallbackMetadata = $this->formatRequestData($reponseContent['Body']['stkCallback']['CallbackMetadata']['Item']);
        $operationType = $this->getOperationType($stkCallback['ResultCode']);
        $mpesaOperation = MpesaOperation::where('merchant_request_id', $stkCallback['MerchantRequestID'])->first();
        $mpesaCode = $stkCallback['CallbackMetadata']['Item'][1]['Value'];
        $from = $stkCallback['CallbackMetadata']['Item'][4]['Value'];


        if ($operationType == false)
        {
            Log::info('STk failed');
            return  null;
            /*send sms*/
        } else
        {
            try {

                $py = Payment::where('receipt', $mpesaCode)->first();
                if ($py instanceof Payment) {
                    Log::info('payment already recorded');
                }else{
                    $amount = $CallbackMetadata['Amount'];
                    $payment = new Payment();
                    $payment->amount = $amount;
                    $payment->identifier = Str::random(5);
                    $payment->from = $from;
                    $payment->channel = 'MPesa';
                    $payment->receipt = $mpesaCode;
                    $payment -> save();

                    Log::alert('successfully Paid');

                }

            }catch (\Exception $exception)
            {
                Log::error($exception->getMessage());
            }

        }
    }

    /**
     * Method to format the array received from safaricom
     * @param $data
     * @return array
     */
    public function formatRequestData($data)
    {
        $formatedData = array();
        foreach ($data as $item) {

            if (array_key_exists('Value', $item)) {
                $key = $item['Name'];
                $value = $item['Value'];
            } else {
                $value = '';
            }

            $formatedData[$key] = $value;

        }

        return $formatedData;
    }
    public function getOperationType(int $resultCode)
    {
        if ($resultCode == 0)
        {
            return true;
        }else{
            return false;
        }
    }
}
