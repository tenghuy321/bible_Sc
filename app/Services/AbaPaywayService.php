<?php

namespace App\Services;

use Exception;

class AbaPaywayService
{
    protected string $merchantId;
    protected string $apiKey;
    protected string $rsaPublicKeyPath;
    protected string $paymentUrl;

    public function __construct()
    {
        $this->merchantId = env('ABA_PAYWAY_MERCHANT_ID');
        $this->apiKey = env('ABA_PAYWAY_API_KEY');
        $this->rsaPublicKeyPath = env('ABA_PAYWAY_RSA_PUBLIC_KEY_PATH', storage_path('app/keys/aba_public.pem'));
        $this->paymentUrl = env('ABA_PAYWAY_PAYMENT_LINK_URL');

        if (!file_exists($this->rsaPublicKeyPath)) {
            throw new Exception("RSA public key file not found at: {$this->rsaPublicKeyPath}");
        }
    }

    /**
     * Encrypt data using ABA RSA public key
     */
    protected function opensslEncryption(string $source): string
    {
        $publicKey = file_get_contents($this->rsaPublicKeyPath);
        $maxlength = 117; // 1024-bit key, adjust if 2048-bit
        $output = '';

        while (!empty($source)) {
            $input = substr($source, 0, $maxlength);
            openssl_public_encrypt($input, $encrypted, $publicKey);
            $output .= $encrypted;
            $source = substr($source, $maxlength);
        }

        return base64_encode($output);
    }

    /**
     * Generate HMAC SHA-512 hash
     */
    protected function generateHash(string $requestTime, string $merchantAuth): string
    {
        $b4hash = $requestTime . $this->merchantId . $merchantAuth;
        return base64_encode(hash_hmac('sha512', $b4hash, $this->apiKey, true));
    }

    /**
     * Create payment link
     */
    public function createPaymentLink(array $params): array
    {
        $requestTime = time();

        $data = json_encode([
            'mc_id'           => $this->merchantId,
            'title'           => $params['title'] ?? 'Donation',
            'amount'          => $params['amount'],
            'currency'        => strtoupper($params['currency'] ?? 'USD'),
            'description'     => $params['description'] ?? 'Payment link created from Laravel',
            'payment_limit'   => $params['payment_limit'] ?? 5,
            'expired_date'    => $params['expired_date'] ?? ($requestTime + 3600),
            'return_url'      => base64_encode($params['return_url'] ?? url('/')),
            'merchant_ref_no' => $params['merchant_ref_no'] ?? uniqid('ref'),
            'payout'          => $params['payout'] ?? [],
        ]);

        // Encrypt payload
        $merchantAuth = $this->opensslEncryption($data);

        // Generate HMAC hash
        $hash = $this->generateHash($requestTime, $merchantAuth);

        // Prepare payload
        $payload = [
            'req_time'      => $requestTime,
            'merchant_id'   => $this->merchantId,
            'merchant_auth' => $merchantAuth,
            'request_data'  => base64_encode($data),
            'hash'          => $hash,
        ];

        // Call ABA API
        $ch = curl_init($this->paymentUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception('cURL Error: ' . curl_error($ch));
        }
        curl_close($ch);

        $decoded = json_decode($response, true);
        if (!$decoded) {
            throw new Exception('Invalid API response: ' . $response);
        }

        return $decoded;
    }
}
