<?php

    class addCar extends database{

        protected $model;
        protected $price;
        protected $categoryId;

        public function __construct($model, $price, $categoryId){
            $this->model = $model;
            $this->price = $price;
            $this->categoryId = $categoryId;

        }

        protected function addNewCar(){
            $stmt = $this->connect()->prepare('INSERT INTO cars(model, price, categoryId) VALUES (?, ?, ?);');

            if(!$stmt->execute(array($this->model, $this->price, $this->categoryId))){
                $stmt = NULL;
                header("Location: ./index.php?error=stmtfailed");
                exit();
            }
            $stmt = NULL;
        }

        public function createCar() {
            try {
                $this->addNewCar();
                header("Location: ./index.php?success=caradded");
                exit();
            } catch (Exception $e) {
                header("Location: ./index.php?error=stmtfailed");
                exit();
            }
        }
    }