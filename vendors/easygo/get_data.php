<?php

require_once __DIR__ . '../config.php';

function getEasygoData()
{
    $ch = curl_init();

    curl_setopt_array($ch, [

        CURLOPT_URL => VENDOR_API_URL,

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . VENDOR_API_TOKEN,
            'Accept: application/json'
        ],

        CURLOPT_SSL_VERIFYPEER => true,

    ]);

    $response = curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    $error = curl_error($ch);

    curl_close($ch);

    if ($error) {

        throw new Exception(
            "cURL Error: " . $error
        );

    }

    if ($httpCode !== 200) {

        throw new Exception(
            "Vendor API Error. HTTP Code: " . $httpCode .
            " Response: " . $response
        );

    }

    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {

        throw new Exception(
            "Invalid JSON response dari vendor."
        );

    }

    return $data;
}

$data = getEasygoData();

echo '<pre>';
print_r($data);
echo '</pre>';