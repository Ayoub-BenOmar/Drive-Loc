<?php
include "db.php";
    class theme{
        public $themeName;

        public function __construct($themeName)
        {
            $this->themeName = $themeName;
        }

        public function addNewTheme($pdo){

            try {
                $stmt = $pdo->prepare('INSERT INTO themes(themeName) VALUES(?);');
                $stmt->execute([$this->themeName]);
                echo "theme added successfully";
                exit();
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                echo "nada di nada";
                exit();
            }
        }

        public function getAllThemes($pdo){
            $stmt = $pdo->prepare('SELECT * FROM themes');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }