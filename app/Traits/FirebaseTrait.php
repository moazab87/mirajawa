<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

trait  FirebaseTrait
{
    use NotificationMessageTrait;

    public function sendFcmNotification($tokens, $data = [], $lang = 'ar')
    {
        $apiurl = 'https://fcm.googleapis.com/v1/projects/' . config('app.project_id') . '/messages:send';

        $headers = [
            'Authorization: Bearer ' . $this->getToken(),
            'Content-Type: application/json'
        ];

        $notification = [
            'title' => $this->getTitle($data, $lang),
            'body'  => $this->getBody($data, $lang),
        ];

        $preparedData = $this->prepareData($data);
        $iosTokens = clone $tokens;
        $this->sendAndroidFcmNotifications($tokens->where(['device_type' => 'android'])->get()
            ->pluck('device_id')->toArray(), $preparedData, $apiurl, $headers, $notification, $lang);

        $this->sendIosFcmNotifications($iosTokens->where(['device_type' => 'ios'])
            ->pluck('device_id')->toArray(), $preparedData, $apiurl, $headers, $notification, $lang);
    }

    private function prepareData($data)
    {
        foreach ($data as $key => $value) {
            if (is_int($value)) {
                $data[$key] = strval($value);
            } elseif (is_bool($value)) {
                $data[$key] = strval($value);
            } elseif (is_array($value)) {
                $data[$key] = json_encode($value);
            }
        }
        return $data;
    }

    private function sendAndroidFcmNotifications($tokens, $data, $url, $headers, $notification, $lang)
    {
        foreach ($tokens as $token) {
            $message = $this->getAndroidMessageFormat($token, $data, $notification, $lang);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
            $result = curl_exec($ch);
            if ($result === false) {
                die('Curl failed: ' . curl_error($ch));
            }

            curl_close($ch);
        }
    }

    private function getAndroidMessageFormat($token, $data, $notification, $lang)
    {

        return [
            'message' => [
                'token' => $token,
                'notification' => $notification,
                'data' => [
                    'title' => $this->getTitle($data, $lang),
                    'body_' . $lang => $this->getBody($data, $lang),
                    'type' => $data['type'],
                    'order_id' => isset($data['order_id']) ? $data['order_id'] : null
                ],
            ],
        ];
    }

    private function sendIosFcmNotifications($tokens, $data, $url, $headers, $notification, $lang)
    {
        foreach ($tokens as $token) {
            $message = $this->getIosMessageFormat($token, $data, $notification, $lang);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
            $result = curl_exec($ch);
            if ($result === false) {
                //Failed
                die('Curl failed: ' . curl_error($ch));
            }

            curl_close($ch);
        }
    }

    private function getIosMessageFormat($token, $data, $notification)
    {
        return [
            'message' => [
                'token' => $token,
                'notification' => $notification,
                'data' => $data,
                'apns' => [
                    //                    'mutable-content'=> 1,
                    'headers' => [
                        'apns-priority' => '10', // High priority for immediate delivery
                        'apns-push-type' => 'alert', // For alert notifications
                    ],
                    'payload' => [
                        'aps' => [
                            'alert' => $notification,
                            'sound' => 'default',
                        ],
                    ],
                ],
                // 'sound'             => 'default',
            ],
        ];
    }


    private function getToken()
    {
        $secret = openssl_get_privatekey(config('app.private_key'));
        // Create the token header
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'RS256'
        ]);

        $payload = json_encode([
            "iss"   => config('app.client_email'),
            "scope" => "https://www.googleapis.com/auth/firebase.messaging",
            "aud"   => "https://oauth2.googleapis.com/token",
            "exp"   => time() + 3600,
            "iat"   => time()
        ]);

        // Encode Header
        $base64UrlHeader = $this->base64UrlEncode($header);

        // Encode Payload
        $base64UrlPayload = $this->base64UrlEncode($payload);

        // Create Signature Hash
        openssl_sign($base64UrlHeader . "." . $base64UrlPayload, $signature, $secret, OPENSSL_ALGO_SHA256);

        // Encode Signature to Base64Url String
        $base64UrlSignature = $this->base64UrlEncode($signature);

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        //-----Request token------
        $client = new Client();

        $response = $client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt
            ],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);

        $responseBody = json_decode($response->getBody());

        if (!isset($responseBody->access_token)) {
            throw new \Exception("Failed to get access token: " . json_encode($responseBody));
        }

        return $responseBody->access_token;
    }

    private function base64UrlEncode($text)
    {
        return str_replace(
            ['+', '/', '='],
            ['-', '_', ''],
            base64_encode($text)
        );
    }
}
