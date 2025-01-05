<?php
require_once('Classes/user.php');
require_once('db.php');

session_start();
$idUser = $_SESSION["userid"];
$idCar = $_POST['carId'];
$comment = $_POST['comment'];
$idAvis = $_POST['idAvis'];

if ($idUser && $idCar) {
    $user = new user();

    if (isset($_POST['submitReview'])) {
        if ($idAvis) {
            $result = $user->editReview($idAvis, $idUser, $comment);
            $message = $result ? "Review updated successfully." : "Failed to update review.";
        } else {
            $result = $user->addReview($idUser, $idCar, $comment);
            $message = $result ? "Review added successfully." : "Failed to add review. Make sure you have a confirmed reservation for this car.";
        }
    } elseif (isset($_POST['deleteReview'])) {
        $result = $user->deleteReview($idAvis, $idUser);
        $message = $result ? "Review deleted successfully." : "Failed to delete review.";
    }

    echo $message;
} else {
    echo "Invalid input.";
}
?>