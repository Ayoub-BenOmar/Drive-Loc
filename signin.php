<?php

if(isset($_POST["submit"])){

    $email = $_POST["email"];
    $password = $_POST["password"];

    include "db.php";
    include "../Drive-Loc V2/Classes/user.php";
    include "../Drive-Loc V2/Helpers/loginContr.php";

    $login = new loginContr($email, $password);
    $login->loginUser();

    header("location: index.php?error=none");

}