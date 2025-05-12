<?php
include 'api.php';

$id = $_GET['id'];
$order = fetchApi("http://localhost:8003/orders/$id");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = ['quantity' => $_POST['quantity']];
    postApi("http://localhost:8003/orders/$id", $data);
    header('Location: index.php');
    exit;
}
?>

<form method="POST">
    Quantity: <input name="quantity" type="number" value="<?= $order['quantity'] ?>"><br>
    <button type="submit">Update Order</button>
</form>
