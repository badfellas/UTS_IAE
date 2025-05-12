<?php
require_once 'api/api.php';

$id = $_POST['id'];
$response = deleteApi("http://localhost:8003/api/orders/$id", []);

header('Location: index.php');
exit();
