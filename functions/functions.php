<?php
require_once '../config/config.php';

function create_payment_link($amount, $description, $success_url, $cancel_url) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paymongo.com/v1/links",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'data' => [
                'attributes' => [
                    'amount' => $amount * 100, // PayMongo accepts amounts in centavos
                    'description' => $description,
                    'remarks' => 'Online Store Payment',
                    'checkout_url' => [
                        'success' => $success_url,
                        'failed' => $cancel_url
                    ]
                ]
            ]
        ]),
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic " . base64_encode(PAYMONGO_SECRET_KEY . ":"),
            "Content-Type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return ['error' => "cURL Error #:" . $err];
    }

    $response_data = json_decode($response, true);
    return $response_data;
}
?>
