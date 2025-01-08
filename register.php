<?php

if(isset($_POST["submit"])){

    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    include "db.php";
    include "../Drive-Loc V2/Classes/user.php";
    include "../Drive-Loc V2/Helpers/signupContr.php";
    $signup = new signupContr($nom, $email, $password);

    $signup->signupUser();
    echo "Register successfully";

    header("location: Front/Login-Register.php?error=none");
}