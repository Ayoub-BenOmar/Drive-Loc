<?php 
require_once "../Classes/addBlog.php";
require_once "../Classes/comments.php";
require_once "../db.php";

session_start();
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
$idArticle = isset($_GET['idArticle']) ? $_GET['idArticle'] : null;

if ($idArticle === null) {
    header("Location: Themes.php");
    exit();
}

$db = new database();
$pdo = $db->connect();

$blog = new blog("", "", "", "");
$article = $blog->getArticleById($pdo, $idArticle);

$comment = new comments();
$comments = $comment->getCommentsByArticleId($pdo, $idArticle);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']) ?></title>
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
                <h2 class="text-2xl font-bold text-orange-500"><?= htmlspecialchars($article['title']) ?></h2>
                <a href="addToFav.php?idArticle=<?= htmlspecialchars($idArticle) ?>" class="bg-orange-500 text-white px-4 py-2 rounded-lg">Add to Favorite List</a>
            </div>
            <div>
                <div class="flex justify-center mb-4">
                <img src="../Pics/Car.jpg" alt="Article Image" class="w-fit h-64 object-cover mb-4">
                </div>
                <p class="text-gray-700"><?= nl2br(htmlspecialchars($article['content'])) ?></p>
            </div>
            <div class="mt-8">
                <?php if ($userid !== null): ?>
                    <form action="../addComment.php" method="POST" class="my-4">
                        <input type="hidden" name="idArticle" value="<?= htmlspecialchars($idArticle) ?>">
                        <input type="hidden" name="userid" value="<?= htmlspecialchars($userid) ?>">
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Comment</label>
                            <textarea name="content" id="content" rows="4" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm"></textarea>
                        </div>
                        <div>
                            <button type="submit" name="submitComment" class="bg-orange-500 text-white text-center py-2 px-4 rounded-lg w-fit">Submit Comment</button>
                        </div>
                    </form>
                <?php else: ?>
                    <p class="text-gray-700">You need to be logged in to comment.</p>
                <?php endif; ?>

                <h3 class="text-xl font-bold text-orange-500 mb-4">Comments</h3>
                    <?php foreach ($comments as $comment): ?>
                        <div class="bg-gray-100 p-4 rounded-lg mb-4">
                            <p class="text-gray-700 mb-2"><strong><?= htmlspecialchars($comment['nom']) ?></strong></p>
                            <p class="text-gray-700"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
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