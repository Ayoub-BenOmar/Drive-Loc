<?php

require_once('../Classes/addCategory.php');
require_once('../db.php');

session_start();
$role = $_SESSION["role"];

if ($role !== "admin") {
    header("Location: ../Front/Login-Register.php");
    exit();
}

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
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="bg-cover bg-center h-screen text-white h-screen w-screen flex flex-col" style="background-image: url('../Pics/CarRent.jpg');">
        
    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 flex-none">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold text-orange-500">Admin Dashboard</h1>
            <a href="../logout.php" class="text-white mx-2">Logout</a>
            <!-- Add more nav items here if needed -->
        </div>
    </nav>

    <div class="flex flex-grow overflow-hidden">
        <!-- Sidebar -->
        <aside class="bg-gray-800 w-64 min-h-screen p-4 flex flex-col">
            <nav class="flex flex-col">
                <a href="Admin-Desk.php" class="text-white py-2 px-4 mb-2 rounded bg-gray-700 hover:bg-gray-600">Desk</a>
                <a href="Admin.php" class="text-white py-2 px-4 mb-2 rounded bg-gray-700 hover:bg-gray-600">Add Car/Catgery/Theme</a>
                <a href="Admin-Reservations.php" class="text-white py-2 px-4 mb-2 rounded bg-gray-700 hover:bg-gray-600">Reservations</a>
                <a href="#" class="text-white py-2 px-4 mb-2 rounded bg-gray-700 hover:bg-gray-600">Dashboard</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow p-8 overflow-auto">
            <div class="container mx-auto grid grid-cols-3">
                <!-- Add Category Form -->
                <form action="../Category.php" method="post" class="bg-gray-600 p-4 rounded-lg mb-8 max-w-lg mx-auto h-fit">
                    <h2 class="text-2xl font-bold text-orange-500 mb-4">Add Category</h2>
                    <label for="category" class="block mb-2">Category:</label>
                    <input type="text" name="category" class="w-full mb-4 p-2 rounded bg-gray-800 border border-orange-500 text-white">
                    <button type="submit" name="submit" class="bg-orange-500 text-white p-2 rounded w-full">Add</button>
                </form>

                <!-- Add Theme Form -->
                <form action="../newTheme.php" method="post" class="bg-gray-600 p-4 rounded-lg mb-8 max-w-lg mx-auto h-fit">
                    <h2 class="text-2xl font-bold text-orange-500 mb-4">Add Theme</h2>
                    <label for="theme" class="block mb-2">Theme:</label>
                    <input type="text" name="theme" class="w-full mb-4 p-2 rounded bg-gray-800 border border-orange-500 text-white">
                    <button type="submit" name="themeSubmit" class="bg-orange-500 text-white p-2 rounded w-full">Add</button>
                </form>

                <!-- Add New Car Form -->
                <form action="../newCar.php" method="POST" enctype="multipart/form-data" class="bg-gray-600 p-4 rounded-lg max-w-lg mx-auto" enctype="multipart/form-data">
                    <h2 class="text-2xl font-bold text-orange-500 mb-4">Add New Car</h2>
                    <label for="model" class="block mb-2">Model:</label>
                    <input type="text" name="model" class="w-full mb-4 p-2 rounded bg-gray-800 border border-orange-500 text-white">
                    <label for="brand" class="block mb-2">Brand:</label>
                    <input type="text" name="brand" class="w-full mb-4 p-2 rounded bg-gray-800 border border-orange-500 text-white">
                    <label for="price" class="block mb-2">Price:</label>
                    <input type="number" name="price" class="w-full mb-4 p-2 rounded bg-gray-800 border border-orange-500 text-white">
                    <label for="image" class="block mb-2">Car Image:</label>
                    <input type="file" name="image" id="image" accept="image/*" class="w-full mb-4 p-2 rounded bg-gray-800 border border-orange-500 text-white">
                    <label for="category" class="block mb-2">Choose a category:</label>
                    <select name="categoryId" id="category" class="w-full mb-4 p-2 rounded bg-gray-800 border border-orange-500 text-white">
                        <?php foreach ($show as $category): ?>
                            <option value="<?= htmlspecialchars($category['categoryId']) ?>">
                                <?= htmlspecialchars($category['category']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="bg-orange-500 text-white p-2 rounded w-full">Add Car</button>
                </form>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 p-4 flex-none">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Car Rent. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>