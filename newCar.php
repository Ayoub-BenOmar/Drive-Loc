<?php

if(isset($_POST["submit"])){

    $model = $_POST["model"];
    $price = $_POST["price"];
    $categoryId = $_POST["categoryId"];

    include "db.php";
    include "../Drive-Loc/Classes/addCar.php";

    $car = new addCar($model, $price, $categoryId);
    $car->createCar();
    echo "Car added successfully";

    // header("location: index.php?error=none");
}