<?php
session_start();
require_once 'Models/DB.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner') {
    header('Location: index.php');
    exit;
}

$db = DB::conn();
$user_id = $_SESSION['user_id'];

// Status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $pet_id = $_POST['pet_id'];
    $new_status = $_POST['status'];

    // Verify pet belongs to the user
    $stmt = $db->prepare("SELECT id FROM pets WHERE id = :id AND owner_id = :owner_id");
    $stmt->execute([':id' => $pet_id, ':owner_id' => $user_id]);
    if ($stmt->fetch()) {
        $stmt = $db->prepare("UPDATE pets SET status = :status WHERE id = :id");
        $stmt->execute([':status' => $new_status, ':id' => $pet_id]);
    }

    header('Location: myPets.php'); // refresh
    exit;
}

$stmt = $db->prepare("SELECT * FROM pets WHERE owner_id = :owner_id ORDER BY created_at DESC");
$stmt->execute([':owner_id' => $user_id]);
$pets = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once 'Views/myPets.phtml';
