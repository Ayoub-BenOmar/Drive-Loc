<?php

if(isset($_POST["submit"])){

    $email = $_POST["email"];
    $password = $_POST["password"];

    include "db.php";
    include "../Drive-Loc/Classes/login.php";
    include "../Drive-Loc/Helpers/loginContr.php";
    $login = new loginContr($email, $password);

    $login->loginUser();
    echo "Login successfully";

    header("location: index.php?error=none");

}