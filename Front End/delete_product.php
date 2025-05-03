<?php
require_once 'api/api.php';

$id = $_POST['id'];
$response = deleteApi("http://localhost:8002/api/products/$id", []);

header('Location: products.php');
exit();
