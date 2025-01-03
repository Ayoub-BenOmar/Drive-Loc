<?php 
require_once("db.php");
class Category {

    protected $category; 

    public function __construct($category){
        $this->category = $category;
    }

    public function addCategory($pdo) {
        if (empty($this->category)) {
            header("location: ./index.php?error=emptyInput");
            exit();
        }
    
        try {
            $stmt = $pdo->prepare('INSERT INTO category(category) VALUES (:category);');
            $stmt->execute(['category' => $this->category]);
            // return "done";
            header("location: ./index.php?error=none");
            exit();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            header("Location: ./index.php?error=databaseError");
            exit(); 
        }
    }

    public static function  GetAllCategories($pdo){
        $stmt = $pdo->prepare('SELECT * FROM category');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
