<?php
require_once __DIR__ . "/../db.php";

class comments {

    public function getCommentsByArticleId($pdo, $idArticle) {
        try {
            $sql = 'SELECT comments.*, users.nom FROM comments INNER JOIN users ON users.idUser = comments.idUser WHERE idArticle = :idArticle';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['idArticle' => $idArticle]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }

    public function addComment($pdo, $idArticle, $idUser, $content) {
        try {
            $stmt = $pdo->prepare('INSERT INTO comments(idArticle, idUser, content) VALUES (?, ?, ?)');
            $stmt->execute([$idArticle, $idUser, $content]);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
        }
    }
}
?>