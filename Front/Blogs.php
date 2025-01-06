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
                <a href="Blog.php" class="text-white mx-2">Blog</a>
                <a href="../logout.php" class="text-white mx-2">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow p-8">
        <div class="container mx-auto bg-white rounded-lg shadow-lg overflow-hidden p-8">
            <h2 class="text-2xl font-bold text-orange-500 mb-4">Blog</h2>

            <!-- Add New Post Form -->
                <form action="add_post.php" method="POST" class="mb-8">
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">Title:</label>
                        <input type="text" id="title" name="title" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-orange-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700">Content:</label>
                        <textarea id="content" name="content" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-orange-500" required></textarea>
                    </div>
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">Add Post</button>
                </form>

            <!-- Display Blog Posts -->
                <div class="mb-8">
                    <h3 class="text-xl font-bold text-orange-500">Title</h3>
                    <p class="text-gray-700">Content</p>
                    <p class="text-gray-500 text-sm">Posted on 00/00/0000</p>
                    <a href="post.php?id=" class="text-blue-500">Read more...</a>
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