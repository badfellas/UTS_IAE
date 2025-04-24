<?php
require_once 'api/api.php';

$data = [
    'user_id' => $_POST['user_id'],
    'product_id' => $_POST['product_id'],
    'quantity' => $_POST['quantity']
];

$response = postApi('http://localhost:8003/api/orders', $data);

header('Location: index.php');
