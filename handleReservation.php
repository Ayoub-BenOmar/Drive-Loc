<?php
require_once('Classes/user.php');
require_once('db.php');

session_start();
$role = $_SESSION["role"];

if ($role !== "admin") {
    header("Location: ../index.php");
    exit();
}

$action = $_POST['action'];
$reservationId = $_POST['reservationId'];

if ($action && $reservationId) {
    // Create a user instance
    $user = new user();

    switch ($action) {
        case 'accept':
            $user->acceptReservation($reservationId);
            break;
        case 'deny':
            $user->denyReservation($reservationId);
            break;
        case 'delete':
            $user->deleteReservation($reservationId);
            break;
    }
}

header("Location: Front/Admin-Reservations.php");
exit();
?>