<?php 
require_once "../Classes/addBlog.php";
require_once "../db.php";

$idTheme = $_GET['idTheme'];

if ($idTheme === null) {
    header("Location: Themes.php");
    exit();
}

$db = new database();
$pdo = $db->connect();

$blog = new blog("", "", "", "");
$articles = $blog->getAllBlogs($pdo, $idTheme);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles in Theme</title>
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
            <h2 class="text-2xl font-bold text-orange-500 mb-4">Articles in Theme</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php if (empty($articles)): ?>
                    <p class="col-span-4 text-gray-700">No articles found for this theme.</p>
                <?php else: ?>
                    <?php foreach ($articles as $article): ?>
                        <div class="bg-gray-100 rounded-lg p-4 shadow-md flex flex-col justify-between">
                            <h3 class="text-lg font-bold text-orange-500 mb-2 text-left"><?= htmlspecialchars($article['title']) ?></h3>
                            <img src="../Pics/Car.jpg" alt="Article Image" class="w-full h-32 object-cover mb-4">
                            <a href="Article.php?idArticle=<?= htmlspecialchars($article['idArticle']) ?>" class="bg-orange-500 text-white text-center py-2 rounded-lg mt-auto">Read more</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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