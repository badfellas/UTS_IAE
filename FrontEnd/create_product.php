<?php
require_once 'api/api.php';

$data = [
    'name' => $_POST['name'],
    'price' => $_POST['price']
];

$response = postApi('http://localhost:8002/api/products', $data);

header('Location: products.php');
exit();
