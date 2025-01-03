<?php
require_once("db.php");

class Car {
    protected $brand;
    protected $model;
    protected $price;
    protected $categoryId;  
    protected $image;

    public function __construct($brand, $model, $price, $categoryId, $image) {
        $this->brand = $brand;
        $this->model = $model;
        $this->price = $price;
        $this->categoryId = $categoryId;
        $this->image = $image;
    }

    public function addCar($pdo) {
        if (empty($this->brand) || empty($this->model) || empty($this->price) || empty($this->categoryId)) {
            header("Location: ./index.php?error=emptyInput");
            exit();
        }

        try {
            $stmt = $pdo->prepare('INSERT INTO cars (brand, model, price, categoryId, image) 
                                 VALUES (:brand, :model, :price, :categoryId, :image)');
            
            $stmt->execute([
                'brand' => $this->brand,
                'model' => $this->model,
                'price' => $this->price,
                'categoryId' => $this->categoryId,
                'image' => $this->image
            ]);

            header("Location: ./index.php?error=none");
            exit();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            header("Location: ./index.php?error=databaseError");
            exit();
        }
    }

    public static function getAllCars($pdo) {
        try {
            $stmt = $pdo->prepare('
                SELECT cars.*, category.category as category_name 
                FROM cars 
                LEFT JOIN category ON cars.categoryId = category.categoryId
            ');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }

    public static function getCarById($pdo, $id) {
        try {
            $stmt = $pdo->prepare('SELECT * FROM cars WHERE idCar = :id');
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return null;
        }
    }
}