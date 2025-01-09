<?php 
require_once "../Classes/addTheme.php";
require_once "../db.php";

$db = new database();
$pdo = $db->connect();

$theme = new theme("");
$themes = $theme->getAllThemes($pdo);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="bg-cover bg-center bg-fixed text-gray-800 h-screen w-screen no-repeat flex flex-col" style="background-image: url('../Pics/homeCar.jpg');">

    <!-- Navbar -->
    <nav class="bg-gray-800 py-4 px-8 flex-none">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold text-orange-500">Our Company</h1>
            <div>
                <a href="Home.php" class="text-white mx-2">Home</a>
                <a href="Reservations.php" class="text-white mx-2">Reservations</a>
                <a href="Cars.php" class="text-white mx-2">Cars</a>
                <a href="Themes.php" class="text-white mx-2">Themes</a>
                <a href="../logout.php" class="text-white mx-2">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow p-8">
    <div class="container mx-auto bg-white rounded-lg shadow-lg overflow-hidden p-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-orange-500">Explore Themes</h2>
            <div>
                <a href="favorites.php" class="inline-block bg-gray-800 text-white px-4 py-2 rounded-lg mr-2">Favorite Lists</a>
                <a href="addArticle.php" class="inline-block bg-orange-500 text-white px-4 py-2 rounded-lg">Add Article</a>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($themes as $theme): ?>
                <div class="bg-gray-100 rounded-lg p-4 shadow-md flex flex-col justify-between">
                    <h3 class="text-lg font-bold text-orange-500 mb-2"><?= htmlspecialchars($theme['themeName']) ?></h3>
                    <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <a href="viewArticle.php?idTheme=<?= htmlspecialchars($theme['idTheme']) ?>" class="bg-orange-500 text-white text-center py-2 rounded-lg mt-auto">View Articles</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </main>


    <!-- Footer -->
    <footer class="bg-gray-800 p-4 flex-none">
        <div class="container mx-auto text-center text-white">
            <p>&copy; 2025 Our Company. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>