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
}
?>