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
    //         'amount' => [
    //             'required',
    //             'numeric',
    //             function ($attribute, $value, $fail) {
    //                 if ($value <= 0) {
    //                     $fail(__('Amount in USD must be greater than 0.'));
    //                 }
    //             },
    //         ],
    //     ]);

    //     $merchantId   = env('ABA_PAYWAY_MERCHANT_ID');
    //     $apiKey       = env('ABA_PAYWAY_API_KEY');
    //     $paymentUrl   = env('ABA_PAYWAY_PAYMENT_LINK_URL');

    //     $rsaPublicKey = file_get_contents(storage_path('app/keys/aba_public.pem'));


    //     $currency = 'USD';
    //     $amount   = number_format((float) $validated['amount'], 2, '.', '');
    //     // $tranId   = time();
    //     $reqTime = time();
    //     $expiredTime = time();

    //     $data = [
    //         'mc_id'        => $merchantId,
    //         'title'        => 'Donation Payment',
    //         'amount'       => $amount,
    //         'currency'     => $currency,
    //         'description'  => 'Payment link created',
    //         'expired_date' => $expiredTime,
    //         'return_url'   => url('/'),
    //     ];

    //     $merchantAuth = $this->rsaEncrypt(json_encode($data, JSON_UNESCAPED_SLASHES), $rsaPublicKey);
    //     $b4hash = $reqTime . $merchantId . $merchantAuth;
    //     $hash = base64_encode(hash_hmac('sha512', $b4hash, $apiKey, true));

    //     $response = Http::asForm()->post($paymentUrl, [
    //         'req_time'      => $reqTime,
    //         'merchant_id'   => $merchantId,
    //         'merchant_auth' => $merchantAuth,
    //         'hash'          => $hash,
    //     ]);

    //     // $resData = $response->json();

    //     dd($response->json());

    //     if (isset($resData['data']['payment_url'])) {
    //         return response()->json([
    //             'success'      => true,
    //             'payment_link' => $resData['data']['payment_url'],
    //         ]);
    //     }

    //     return response()->json([
    //         'success' => false,
    //         'message' => $resData['message'] ?? 'Failed to create payment link.',
    //         'debug'   => $resData,
    //     ], 400);
    // }

    // private function rsaEncrypt(string $data, string $publicKey): string
    // {
    //     $maxLength = 117; // for 1024-bit key
    //     $output = '';

    //     while (!empty($data)) {
    //         $chunk = substr($data, 0, $maxLength);
    //         $data = substr($data, $maxLength);

    //         if (!openssl_public_encrypt($chunk, $encryptedChunk, $publicKey, OPENSSL_PKCS1_PADDING)) {
    //             throw new Exception('RSA encryption failed: ' . openssl_error_string());
    //         }

    //         $output .= $encryptedChunk;
    //     }

    //     return base64_encode($output);
    // }

    public function createPayment(Request $request)
    {
        $validated = $request->validate([
            'currency' => 'required|in:usd,khr',
            'amount' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                if ($value <= 0) {
                    $fail(__('Amount in USD must be greater than 0.'));
                }
            }
            ]
        ]);

        $merchantId = env('ABA_PAYWAY_MERCHANT_ID');
        $apiKey     = env('ABA_PAYWAY_API_KEY');
        $publicKey  = file_get_contents(base_path(env('ABA_PAYWAY_RSA_PUBLIC_KEY_PATH')));
        $paymentUrl = env('ABA_PAYWAY_API_URL');
        
        $currency = 'USD';
        $amount = number_format((float)$validated['amount'], 2, '.', '');
        
        $expiredDate = time() + 3600; // 1 hour validity
        $requestTime = date('YmdHis');
        $merchantRefNo = 'REF' . $requestTime;

        $payload = [
            'mc_id'           => $merchantId,
            'title'           => 'Donation Payment',
            'amount'          => (float)$amount,
            'currency'        => $currency,
            'description'     => 'Donation payment link',
            'payment_limit'   => 1,
            'expired_date'    => $expiredDate, 
            // 'expired_date'    => date('YmdHis', strtotime('+1 hour')),
            // 'return_url' => base64_encode("http://localhost:8000/"),
            'return_url' => base64_encode("https://olive-tiger-871329.hostingersite.com/"),
            'merchant_ref_no' => $merchantRefNo,
            // Optional payout field if needed:
            // 'payout' => '[{"acc":"122092016015926","amt":0.01},{"acc":"122091511120425","amt":0.02}]',
        ];

        
        $merchantAuth = $this->opensslEncryption(json_encode($payload), $publicKey);

        
        $hashString = $requestTime . $merchantId . $merchantAuth;
        $hash = base64_encode(hash_hmac('sha512', $hashString, $apiKey, true));

        
        $postData = [
            'request_time'  => $requestTime,
            'merchant_id'   => $merchantId,
            'merchant_auth' => $merchantAuth,
            'hash'          => $hash,
        ];

        // dd($postData);

        $response = Http::asForm()->post($paymentUrl, $postData);

        // dd($response->json());

        Log::info('ABA request', ['payload' => $payload, 'postData' => $postData]);
        Log::info('ABA response', ['response' => $response->json()]);
       
        if ($response->successful()) {
    $resData = $response->json();

    // Some ABA responses wrap everything inside "data"
    if (isset($resData['data']['payment_link'])) {
        $paymentLink = $resData['data']['payment_link'];

        // Add https:// if missing
        if (!str_starts_with($paymentLink, 'http')) {
            $paymentLink = 'https://' . $paymentLink;
        }

        return redirect()->away($paymentLink);
    }

    return back()->withErrors([
        'msg' => 'Unable to generate payment link: ' . json_encode($resData)
    ]);
}


        return back()->withErrors(['msg' => 'ABA PayWay API request failed: ' . $response->body()]);
    }
    private function opensslEncryption($source, $publicKey)
    {
        $maxlength = 117;
        $output = '';
        while (!empty($source)) {
            $input = substr($source, 0, $maxlength);
            openssl_public_encrypt($input, $encrypted, $publicKey);
            $output .= $encrypted;
            $source = substr($source, $maxlength);
        }
        return base64_encode($output);
    }

    public function paymentSuccess(Request $request)
{
    // ABA will redirect here after payment.
    // You can capture data from the query string or POST if provided.
    
    // Example: $request->all() may contain transaction info
    // Log::info('ABA Payment Success Response:', $request->all());

    return view('frontend.payment-success', [
        'message' => 'Thank you! Your payment was successful.'
    ]);
}

}
