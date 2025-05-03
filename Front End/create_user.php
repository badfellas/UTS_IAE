<?php
require_once 'api/api.php';

$data = [
    'name' => $_POST['name'],
    'email' => $_POST['email']
];

$response = postApi('http://localhost:8001/api/users', $data);

header('Location: users.php');
exit();
