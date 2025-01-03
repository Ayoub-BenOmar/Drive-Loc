<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    require_once "db.php";
    require_once "Classes/addCar.php";

    echo "hello";
    // Create database connection
    $database = new database();
    $pdo = $database->connect();

    // Handle file upload
    $image_path = null;
    // if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    //     $upload_dir = 'Uploads/';

    //     $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    //     $file_name = uniqid() . '.' . $file_extension;
    //     $target_path = $upload_dir . $file_name;
      
    //     if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
    //         $image_path = $target_path;
    //     }
    // }

    if (isset($_FILES['image']['name'][$i]) && !empty($_FILES['image']['name'][$i])) {
        $dir = 'Uploads/';
        $path = basename($_FILES['imagepath']['name'][$i]);
        $image_path = $dir . uniqid() . "" . $path;
        $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif', 'svg'];
        $extension = pathinfo($image_path, PATHINFO_EXTENSION);
        
        if (in_array(strtolower($extension), $allowedExtensions)) {
            if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $image_path)) {
                echo "Erreur lors du téléchargement de l'image pour le véhicule : " . $_POST['nom'][$i];
               
            }
        } else {
            echo "Extension non autorisée pour le fichier : " . $_FILES['image']['name'][$i];
          
        }
    }
    

    // Get form data
    $brand = trim($_POST['brand']);
    $model = trim($_POST['model']);
    $price = floatval($_POST['price']);
    $categoryId = intval($_POST['categoryId']);

    var_dump($brand);
    echo "jojsq";

    // Create and save the car
    $car = new Car($brand, $model, $price, $categoryId, $image_path);
    $car->addCar($pdo);
}