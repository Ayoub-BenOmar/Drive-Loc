<?php
require_once __DIR__ . "/../db.php" ;

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
            header("Location: Front/Themes.php?success=postAdded");
            exit();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            header("Location: index.php?error=databaseError");
            exit();
        }
    }

    public function getAllBlogs($pdo, $id_article) {
        try {
            $sql = 'SELECT articles.title, articles.idTheme, themes.themeName as theme_name from articles inner JOIN themes on themes.idTheme = articles.idTheme where articles.idTheme = :id_article';
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id_article' => $id_article]);
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }
}
?>