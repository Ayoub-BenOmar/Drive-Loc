<?php
session_start();

require_once('Classes/addBlog.php');
require_once('db.php');

if(isset($_POST['addPost'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $idTheme = $_POST['idTheme'];

    $idUser = $_SESSION['userid'];

    $db = new Database();
    $pdo = $db->connect();

    $blog = new blog($title, $content, $idUser, $idTheme);
    
    if ($blog->addPost($pdo)) {
        echo "nikaaa7";
    } else {
        echo "yedk fiiih";
    }
    
}
?>