<?php

$payload = [
    'authentication' => [
        'apiKey' => '274686_4714f9ae7545e2e9cd535bf29e4f7298d635d40b3d3f807',
        'propKey' => '274686_4714f9ae7545e2e9cd535bf29e4f7298d635d40b3d3f807'
    ],
    'arrivalFrom' => date('Ymd'),
    'arrivalTo' => date('Ymd', strtotime('+6 months')),
    'status' => '1'
];

$ch = curl_init('https://api.beds24.com/json/getBookings');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

curl_close($ch);

echo $response;
