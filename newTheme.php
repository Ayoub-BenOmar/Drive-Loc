<?php
require_once "Classes/addTheme.php";
require_once "db.php";
if(isset($_POST['themeSubmit'])){

    $themeName = $_POST['theme'];

    $db = new Database();
    $pdo = $db->connect();

    $theme = new theme($themeName);
    $theme->addNewTheme($pdo);
}