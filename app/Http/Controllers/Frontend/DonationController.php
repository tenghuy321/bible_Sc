<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\AbaPaywayService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DonationController extends Controller
{

    // public function createPayment(Request $request)
    // {
    //     $validated = $request->validate([
    //         'currency' => 'required|in:usd,khr',
    //         'amount' => [
    //             'required',
    //             'numeric',
    //             function ($attribute, $value, $fail) {
    //             if ($value <= 0) {
    //                 $fail(__('Amount in USD must be greater than 0.'));
    //             }
    //         }
    //         ]
    //     ]);

    //     $merchantId = env('ABA_PAYWAY_MERCHANT_ID');
    //     $apiKey     = env('ABA_PAYWAY_API_KEY');
    //     $publicKey  = file_get_contents(base_path(env('ABA_PAYWAY_RSA_PUBLIC_KEY_PATH')));
    //     $paymentUrl = env('ABA_PAYWAY_API_URL');

    //     $currency = 'USD';
    //     $amount = number_format((float)$validated['amount'], 2, '.', '');

    //     $expiredDate = time() + 3600;
    //     $requestTime = date('YmdHis');
    //     $merchantRefNo = 'REF' . $requestTime;

    //     $payload = [
    //         'mc_id'           => $merchantId,
    //         'title'           => 'Donation Payment',
    //         'amount'          => (float)$amount,
    //         'currency'        => $currency,
    //         'description'     => 'Donation payment link',
    //         'payment_limit'   => 1,
    //         'expired_date'    => $expiredDate,
    //         // 'expired_date'    => date('YmdHis', strtotime('+1 hour')),
    //         // 'return_url' => base64_encode("http://localhost:8000/"),
    //         'return_url' => base64_encode("https://olive-tiger-871329.hostingersite.com/"),
    //         'merchant_ref_no' => $merchantRefNo,
    //     ];


    //     $merchantAuth = $this->opensslEncryption(json_encode($payload), $publicKey);


    //     $hashString = $requestTime . $merchantId . $merchantAuth;
    //     $hash = base64_encode(hash_hmac('sha512', $hashString, $apiKey, true));


    //     $postData = [
    //         'request_time'  => $requestTime,
    //         'merchant_id'   => $merchantId,
    //         'merchant_auth' => $merchantAuth,
    //         'hash'          => $hash,
    //     ];

    //     // dd($postData);

    //     $response = Http::asForm()->post($paymentUrl, $postData);

    //     // dd($response->json());

    //     Log::info('ABA request', ['payload' => $payload, 'postData' => $postData]);
    //     Log::info('ABA response', ['response' => $response->json()]);

    //     if ($response->successful()) {
    //         $resData = $response->json();

    //         // Some ABA responses wrap everything inside "data"
    //         if (isset($resData['data']['payment_link'])) {
    //             $paymentLink = $resData['data']['payment_link'];

    //             // Add https:// if missing
    //             if (!str_starts_with($paymentLink, 'http')) {
    //                 $paymentLink = 'https://' . $paymentLink;
    //             }

    //             return redirect()->away($paymentLink);
    //         }

    //         return back()->withErrors([
    //             'msg' => 'Unable to generate payment link: ' . json_encode($resData)
    //         ]);
    //     }


    //     return back()->withErrors(['msg' => 'ABA PayWay API request failed: ' . $response->body()]);
    // }
    // private function opensslEncryption($source, $publicKey)
    // {
    //     $maxlength = 117;
    //     $output = '';
    //     while (!empty($source)) {
    //         $input = substr($source, 0, $maxlength);
    //         openssl_public_encrypt($input, $encrypted, $publicKey);
    //         $output .= $encrypted;
    //         $source = substr($source, $maxlength);
    //     }
    //     return base64_encode($output);
    // }



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
