<?php
include 'api.php';

$id = $_GET['id'];
$user = fetchApi("http://localhost:8001/users/$id");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = ['name' => $_POST['name'], 'email' => $_POST['email']];
    postApi("http://localhost:8001/users/$id", $data); // asumsikan POST bisa update, sesuaikan kalau pakai PUT/PATCH
    header('Location: users.php');
    exit;
}
?>

<form method="POST">
    Name: <input name="name" value="<?= $user['name'] ?>"><br>
    Email: <input name="email" value="<?= $user['email'] ?>"><br>
    <button type="submit">Update</button>
</form>
