<?php
include 'api.php';

$products = fetchApi('http://localhost:8002/products');
?>

<h1>Product List</h1>
<a href="create_product.php">Add Product</a>
<table border="1">
    <tr><th>ID</th><th>Name</th><th>Price</th><th>Actions</th></tr>
    <?php foreach ($products as $product): ?>
    <tr>
        <td><?= $product['id'] ?></td>
        <td><?= $product['name'] ?></td>
        <td><?= $product['price'] ?></td>
        <td>
            <a href="update_product.php?id=<?= $product['id'] ?>">Edit</a>
            <a href="delete_product.php?id=<?= $product['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
