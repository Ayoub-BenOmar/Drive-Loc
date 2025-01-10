<?php
require_once 'db.php';
require_once 'Classes/comments.php';

session_start();
$UserId = $_SESSION['userid'];
$commentId = $_POST['commentId'];
$idArticle = $_POST['idArticle'];
if ($UserId && $commentId && $idArticle) {
    $db = new database();
    $pdo = $db->connect();
    $comment = new comments();
    $comments = $comment->getCommentById($pdo, $commentId);

    if ($comments && $comment['idUser'] == $UserId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateComment'])) {
            $updatedContent = $_POST['content'];
            $comment->editComment($pdo, $commentId, $UserId, $updatedContent);
            header("Location: Front/Article.php?idArticle=" . $idArticle);
            exit();
        }
    } else {
        header("Location: Front/Article.php?idArticle=" . $idArticle . "&error=invaliduser");
        exit();
    }
} else {
    header("Location: ../article.php?error=missingdata");
    exit();
}
?>