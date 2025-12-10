<?php
require_once('Models/SightingsDataSet.php');
require_once('Models/DB.php');
session_start();

$view = new stdClass();
$view->pageTitle = 'Sightings';

$sightingsDataSet = new SightingsDataSet();

$search   = $_GET['search']  ?? '';
$type     = $_GET['type']    ?? '';
$status   = $_GET['status']  ?? '';

$view->sightings = $sightingsDataSet->fetchSightings($search, $type, $status);
$view->types    = $sightingsDataSet->getDistinctTypes();
$view->statuses = $sightingsDataSet->getDistinctStatuses();

try {
    $db = DB::conn();
    $stmt = $db->prepare('SELECT id, name, type FROM pets ORDER BY name ASC');
    $stmt->execute();
    $view->pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $view->pets = [];
}

// Add New Sighting
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_sighting'])) {

    if (!isset($_SESSION['user_id'])) {
        $view->errorMessage = "You must be logged in to add a sighting.";
    }
    elseif ($_SESSION['role'] !== 'user') {
        $view->errorMessage = "Only standard users can add sightings.";
    }
    else {
        $pet_id    = $_POST['pet_id'];
        $user_id   = $_SESSION['user_id'];
        $note      = $_POST['note'];
        $latitude  = $_POST['latitude']  ?? null;
        $longitude = $_POST['longitude'] ?? null;

        $stmt = $db->prepare("
            INSERT INTO sightings (pet_id, user_id, note, latitude, longitude)
            VALUES (:pet_id, :user_id, :note, :lat, :lng)
        ");
        $stmt->execute([
            ':pet_id' => $pet_id,
            ':user_id' => $user_id,
            ':note' => $note,
            ':lat' => $latitude,
            ':lng' => $longitude
        ]);

        header('Location: sightings.php');
        exit();
    }
}

$count = count($view->sightings);
$view->dbMessage = $count > 0 ? "$count sighting(s) found." : "No sightings found.";

require_once('Views/sightings.phtml');
