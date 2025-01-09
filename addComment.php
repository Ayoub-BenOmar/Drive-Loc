<?php
require_once "Classes/comments.php";
require_once "db.php";

session_start();
$idArticle = $_POST['idArticle'];
$userid = $_POST['userid'];
$content = $_POST['content'];

$db = new database();
$pdo = $db->connect();

$comments = new comments();
$comments->addComment($pdo, $idArticle, $userid, $content);

header("Location: Front/Article.php?idArticle=$idArticle");
exit();
?>