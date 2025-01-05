<?php
require_once('Classes/user.php');

session_start();
$userId = $_SESSION["userid"];

if ($userId) {
    $user = new user();
    $user->logout();
} else {
    header("Location: ../Login-Register.php");
    exit();
}
?>