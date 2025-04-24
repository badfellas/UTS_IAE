<?php
require_once 'api/api.php';

$id = $_POST['id'];

$options = [
    'http' => [
        'method' => 'DELETE',
        'header' => "Content-Type: application/json\r\n"
    ]
];

$context = stream_context_create($options);
$response = file_get_contents("http://localhost:8003/api/orders/$id", false, $context);

// Redirect ke halaman utama
header('Location: index.php');
