<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function createPayment(Request $request)
    {
        $validated = $request->validate([
            'currency' => 'required|in:usd,khr',
            'amount'   => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->currency === 'usd' && $value <= 0) {
                        $fail(__('Amount in USD must be greater than 0.'));
                    }
                    if ($request->currency === 'khr' && $value < 100) {
                        $fail(__('Amount in KHR must be at least 100.'));
                    }
                },
            ],
        ]);

        $merchantId  = env('ABA_PAYWAY_MERCHANT_ID');
        $merchantKey = env('ABA_PAYWAY_API_KEY');
        $paymentUrl  = env('ABA_PAYWAY_API_URL');

        $currency = strtoupper($validated['currency']);
        $amount = $currency === 'USD'
            ? number_format((float) $validated['amount'], 2, '.', '')
            : number_format((int) $validated['amount'], 0, '', '');

        // $tranId  = date('YmdHis');
        // $reqTime = date('YmdHis');
        $tranId = time();
        $reqTime = time();


        $fields = [
            'req_time'       => $reqTime,
            'merchant_id'    => $merchantId,
            'tran_id'        => $tranId,
            'amount'         => $amount,
            'firstname'      => 'Teng',
            'lastname'       => 'Huy',
            'email'          => 'tenghuyly2330@gmail.com',
            'phone'          => '+85510800994',
            'payment_option' => 'abapay_khqr',
            // 'type' => 'pre-auth',
            'currency'       => $currency,
        ];


        $hashString = $reqTime
            . $merchantId
            . $tranId
            . $amount
            . $fields['firstname']
            . $fields['lastname']
            . $fields['email']
            . $fields['phone']
            // . $fields['type']
            . $fields['payment_option']
            . $currency;

        $fields['hash'] = base64_encode(
            hash_hmac('sha512', $hashString, $merchantKey, true)
        );

        // dd($hashString, $fields['hash']);

        $form = '<form id="abaPayForm" method="POST" action="' . $paymentUrl . '">';
        foreach ($fields as $key => $value) {
            $form .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
        }
        $form .= '</form>';
        $form .= '<script>document.getElementById("abaPayForm").submit();</script>';

        return response($form);
    }
}
