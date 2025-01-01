<?php

    class addCar extends database{

        protected $model;
        protected $price;
        protected $disponibility;
        protected $category;

        public function __construct($model, $price, $disponibility, $category)
        {
            $this->model = $model;
            $this->price = $price;
            $this->disponibility = $disponibility;
            $this->category = $category;

        }

        protected function addNewCar(){
            $stmt = $this->connect()->prepare('INSERT INTO cars(model, price, disponibility) VALUES (?, ?, ?);');
        }
    }