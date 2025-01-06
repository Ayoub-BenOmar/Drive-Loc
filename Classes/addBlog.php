<?php
include "../db.php";

class blog {
    protected $title;
    protected $content;
    protected $idUser;
    protected $idTheme;

    public function __construct($title, $content, $idUser, $idTheme) {
        $this->title = $title;
        $this->content = $content;
        $this->idUser = $idUser;
        $this->idTheme = $idTheme;
    }

    public function addPost($pdo) {
        if (empty($this->title) || empty($this->content)) {
            header("Location: index.php?error=missingFields");
            exit();
        }

        try {
            $stmt = $pdo->prepare('INSERT INTO articles(idUser, idTheme, title, content) VALUES (?, ?, ?, ?)');
            $stmt->execute([$this->idUser, $this->idTheme, $this->title, $this->content]);
            header("Location: index.php?success=postAdded");
            exit();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            header("Location: index.php?error=databaseError");
            exit();
        }
    }

    public function getAllBlogs($pdo) {
        try {
            $sql = 'SELECT articles.idArticle, articles.title, articles.content, articles.image, articles.video, articles.approved, articles.dateCreation, themes.themeName, users.username
                    FROM articles
                    JOIN themes ON articles.idTheme = themes.idTheme
                    JOIN users ON articles.idUser = users.idUser
                    ORDER BY articles.dateCreation DESC';
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }
}
?>