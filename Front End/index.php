<?php
require_once 'api/api.php';

$users = fetchApi('http://localhost:8001/api/users');
$products = fetchApi('http://localhost:8002/api/products');
$orders = fetchApi('http://localhost:8003/api/orders');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Order Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }

    .card {
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
      border: none;
    }

    .form-select,
    .form-control {
      border-radius: 10px;
    }

    .table thead {
      background: #343a40;
      color: #fff;
    }
  </style>
</head>

<body class="container py-5">
  <h2 class="text-center mb-5 fw-bold">
    🛍️ Order Management System
  </h2>

  <div class="card p-4 mb-4">
    <h5 class="mb-3">📝 Create Order</h5>
    <form action="create_order.php" method="POST">
      <div class="row g-3">
        <div class="col-md-4">
          <label>User:</label>
          <select name="user_id" class="form-select">
            <?php foreach ($users as $user): ?>
              <option value="<?= $user['id'] ?>"><?= $user['name'] ?> (<?= $user['email'] ?>)</option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label>Product:</label>
          <select name="product_id" class="form-select">
            <?php foreach ($products as $product): ?>
              <option value="<?= $product['id'] ?>"><?= $product['name'] ?> -
                Rp<?= number_format($product['price'], 0, ',', '.') ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-2">
          <label>Quantity:</label>
          <input type="number" name="quantity" class="form-control" value="1" min="1">
        </div>
        <div class="col-md-2 d-flex align-items-end">
          <button class="btn btn-primary w-100">Create</button>
        </div>
      </div>
    </form>
  </div>

  <div class="card p-4">
    <h5 class="mb-3">📦 Order List</h5>
    <table class="table table-hover align-middle text-center">
      <thead>
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Product</th>
          <th>Qty</th>
          <th>Total (Rp)</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $order): ?>
          <tr>
            <td><?= $order['id'] ?></td>
            <td>
              <span class="badge text-bg-success"><?= $order['user_id'] ?></span><br>
              <small><?= $order['user_name'] ?? '-' ?></small>
            </td>
            <td>
              <span class="badge text-bg-info"><?= $order['product_id'] ?></span><br>
              <small><?= $order['product_name'] ?? '-' ?></small>
            </td>
            <td><?= $order['quantity'] ?? '-' ?></td>
            <td><strong><?= number_format($order['total'] ?? 0, 0, ',', '.') ?></strong></td>
            <td>
              <form action="delete_order.php" method="POST" onsubmit="return confirm('Yakin ingin menghapus order ini?')">
                <input type="hidden" name="id" value="<?= $order['id'] ?>">
                <button class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>

</html>