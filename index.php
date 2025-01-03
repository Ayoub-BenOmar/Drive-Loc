<?php

require_once('Classes/addCategory.php');
require_once('db.php');

    $db= new database();
    $pdo = $db->connect();
    // init the category 
    $category = new Category("");
    $show = $category::GetAllCategories ($pdo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="register.php" method="post">
        <h2>Register</h2>

        <label for="nom">Nom:</label>
        <input type="text" name="nom">

        <label for="email">Email:</label>
        <input type="text" name="email">

        <label for="password">Password:</label>
        <input type="password" name="password">

        <button type="submit" name="submit">Sign Up</button>
    </form>

    <form action="signin.php" method="post">
        <h2>Login</h2>

        <label for="email">Email:</label>
        <input type="text" name="email">

        <label for="password">Password:</label>
        <input type="password" name="password">

        <button type="submit" name="submit">Sign In</button>
    </form>

    <form action="newCar.php" method="POST">
        <h2>Add new car</h2>

        <label for="model">Model:</label>
        <input type="text" name="model">

        <label for="brand">Brand:</label>
        <input type="text" name="brand">

        <label for="price">Price:</label>
        <input type="number" name="price">

        <label for="image">Car Image:</label>
        <input type="file" name="image" id="image" accept="image/*">

        <label for="category">Choose a category:</label>
        <select name="categoryId" id="category">
            <?php foreach ($show as $category): ?>
                <option value="<?= htmlspecialchars($category['categoryId']) ?>">
                    <?= htmlspecialchars($category['category']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Add car</button>

    </form>


    <form action="Category.php" method="post">
        <h2>Category</h2>

        <label for="category">Category:</label>
        <input type="text" name="category">
        <button type="submit" name="submit">Add</button>

    </form>
</body>
</html>
