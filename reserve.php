<?php
session_start();

require_once "../Drive-Loc V2/Classes/user.php";
require_once "../Drive-Loc V2/db.php";

if (isset($_POST['reserveSubmit'])) {

    $carId = $_POST['carId'];
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];

    $clientId = $_SESSION["userid"];

    $db = new Database();
    $pdo = $db->connect();

    $user = new user();


    if ($user->reserveCar($carId, $dateDebut, $dateFin)) {
        //  echo "Reservation successful!";
        header("location: Front/Cars.php");
    } else {
        // echo "Reservation failed.";
    }
}
?>