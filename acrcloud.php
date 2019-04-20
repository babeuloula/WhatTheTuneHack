<?php
/**
 * @author      BaBeuloula <info@babeuloula.fr>
 * @copyright   Copyright (c) BaBeuloula
 * @license     MIT
 */

header('Content-Type: application/json');

$httpMethod       = 'POST';
$httpUri          = '/v1/identify';
$dataType         = 'audio';
$signatureVersion = '1';
$timestamp        = time();

$config = require('config.php');
extract($config);

$stringToSign = $httpMethod."\n".
    $httpUri."\n".
    $accessKey."\n".
    $dataType."\n".
    $signatureVersion."\n".
    $timestamp;

$url = "https://play.whatthetune.com/hits/current";

$cURL = curl_init();
curl_setopt_array($cURL, [
    CURLOPT_URL            => $baseUrl.$httpUri,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => [
        "sample"            => file_get_contents($url),
        "sample_bytes"      => strlen(file_get_contents($url)),
        "access_key"        => $accessKey,
        "data_type"         => $dataType,
        "signature"         => base64_encode(
            hash_hmac("sha1", $stringToSign, $accessSecret, true)
        ),
        "signature_version" => $signatureVersion,
        "timestamp"         => $timestamp,
    ],
    CURLOPT_RETURNTRANSFER => true,
]);

$response = curl_exec($cURL);
curl_close($cURL);
if (false === $response) {
    echo json_encode([
        'success' => false,
        'error' => [
            'message' => curl_error($cURL),
            'no' => curl_errno($cURL),
        ],
    ]);
}

$response = json_decode($response);

echo json_encode([
    'song' => $response->metadata->music[0]->title,
    'artist' => $response->metadata->music[0]->artists[0]->name,
]);



