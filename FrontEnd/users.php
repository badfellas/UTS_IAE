<?php
require_once 'api/api.php';


$users = fetchApi('http://localhost:8001/users'); // ganti URL sesuai UserService kamu
?>

<h1>User List</h1>
<a href="create_user.php">Add User</a>
<table border="1">
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['name'] ?></td>
        <td><?= $user['email'] ?></td>
        <td>
            <a href="update_user.php?id=<?= $user['id'] ?>">Edit</a>
            <a href="delete_user.php?id=<?= $user['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
