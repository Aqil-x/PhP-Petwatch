<?php
session_start();

require __DIR__ . '/Models/User.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($name === '') $errors[] = "Name is required.";
    if ($username === '') $errors[] = "Username is required.";

    if (User::findByUsername($username)) {
        $errors[] = "Username already exists.";
    }

    // Password rules
    if (strlen($password) < 12) $errors[] = "Password must be at least 12 characters.";
    if (!preg_match('/[A-Z]/', $password)) $errors[] = "Password must contain an uppercase letter.";
    if (!preg_match('/[a-z]/', $password)) $errors[] = "Password must contain a lowercase letter.";
    if (!preg_match('/[0-9]/', $password)) $errors[] = "Password must contain a number.";
    if (!preg_match('/[^A-Za-z0-9]/', $password)) $errors[] = "Password must contain a symbol.";

    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    if (!$errors) {
        if (User::create($username, $password, $name, 'user')) {
            $_SESSION['user_id'] = DB::conn()->lastInsertId();
            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'user';
            header("Location: index.php");
            exit;
        }
    }
}

require __DIR__ . '/Views/template/header.phtml';
?>

<h2>Register</h2>

<?php if ($errors): ?>
    <div class="error-box">
        <ul>
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post">
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <label>Confirm Password:</label>
    <input type="password" name="confirm" required>

    <button type="submit">Register</button>
</form>

<?php require __DIR__ . '/Views/template/footer.phtml'; ?>
