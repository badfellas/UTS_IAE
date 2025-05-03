<?php
require_once 'api/api.php';

$id = $_POST['id'];
$response = deleteApi("http://localhost:8001/api/users/$id", []);

header('Location: users.php');
exit();
