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
    <title>Add New Article</title>
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
            <h2 class="text-2xl font-bold text-orange-500 mb-4">Add New Article</h2>
            <form action="../createPost.php" method="post" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                </div>
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="content" id="content" rows="4" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm"></textarea>
                </div>
                <div>
                    <label for="theme" class="block text-sm font-medium text-gray-700">Theme</label>
                    <select name="idTheme" id="idTheme" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                        <option value="">Select a theme</option>
                        <?php foreach ($themes as $theme): ?>
                            <option value="<?= htmlspecialchars($theme['idTheme']) ?>"><?= htmlspecialchars($theme['themeName']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                </div>
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <input type="text" name="tags" id="tags" placeholder="Comma-separated tags" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                </div>
                <div>
                    <button type="submit" name="addPost" class="bg-orange-500 text-white text-center py-2 rounded-lg w-full">Submit Article</button>
                </div>
            </form>
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