<?php

if(isset($_POST["submit"])){

    $category = $_POST["category"];

    include "db.php";
    include "../Drive-Loc/Classes/addCategory.php";

    $database = new Database();
    $pdo = $database->connect();

    $newCategory = new Category($category);
    $newCategory->addCategory($pdo);
    // header("location: index.php?error=none");    
}