<?php
require_once('Classes/user.php');
require_once('db.php');

session_start();
$role = $_SESSION["role"];

if ($role !== "admin") {
    header("Location: Classes/Login-Register.php");
    exit();
}

$action = $_POST['action'];
$reservationId = $_POST['reservationId'];
$carId = $_POST['carId'];
if ($action && $reservationId && $carId) {
    $user = new user();
    switch ($action) {
        case 'accept':
            $user->acceptReservation($reservationId, $carId);
            break;
        case 'deny':
            $user->denyReservation($reservationId, $carId);
            break;
        case 'delete':
            $user->deleteReservation($reservationId);
            break;
    }
}

header("Location: Front/Admin-Reservations.php");
exit();
?>