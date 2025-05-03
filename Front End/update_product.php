<?php
include 'api.php';

$id = $_GET['id'];
$product = fetchApi("http://localhost:8002/products/$id");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = ['name' => $_POST['name'], 'price' => $_POST['price']];
    postApi("http://localhost:8002/products/$id", $data);
    header('Location: products.php');
    exit;
}
?>

<form method="POST">
    Name: <input name="name" value="<?= $product['name'] ?>"><br>
    Price: <input name="price" type="number" value="<?= $product['price'] ?>"><br>
    <button type="submit">Update</button>
</form>
