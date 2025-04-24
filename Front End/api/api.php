<?php
function fetchApi($url) {
    $response = file_get_contents($url);
    return json_decode($response, true);
}

function postApi($url, $data) {
    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-Type: application/json\r\n",
            'content' => json_encode($data)
        ]
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    return json_decode($response, true);
}
