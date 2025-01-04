<?php
if (!class_exists('database')){
class database{

    public function connect(){
        try {
            $username = "root";
            $password = "";
            $db = new PDO('mysql:host=localhost;dbname=location_voitures', $username, $password);
            return $db;
        } catch (PDOException $e) {
            echo "Error!" . $e->getMessage();
            die(); 
        }
    }
}
}
?>