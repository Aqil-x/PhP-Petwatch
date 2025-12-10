<?php
session_start();
require __DIR__ . '/Models/User.php';

$users = User::all();

require __DIR__ . '/Views/template/header.phtml';
?>

<h1>All Users</h1>

<table border="1" cellpadding="5">
    <thead>
    <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Name</th>
        <th>Role</th>
        <th>Password Hash</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['name']) ?></td>
            <td><?= htmlspecialchars($u['role']) ?></td>
            <td><?= htmlspecialchars($u['password_hash']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/Views/template/footer.phtml'; ?>
