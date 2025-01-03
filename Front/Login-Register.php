<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rent Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-white h-screen w-screen flex flex-col bg-cover bg-center h-screen" style="background-image: url('../CarRent.jpg');">

    <!-- Header -->
    <header class="bg-gray-800 p-4 flex-none">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold text-orange-500">Car Rent</h1>
            <nav>
                <a href="#" class="text-white mx-2">Home</a>
                <a href="#" class="text-white mx-2">About</a>
                <a href="#" class="text-white mx-2">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow my-8 p-4 rounded-lg mx-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Register Form -->
            <form action="../register.php" method="post" class="bg-gray-600 p-6 rounded-lg">
                <h2 class="text-2xl font-bold text-orange-500 mb-4">Register</h2>
                <label for="nom" class="block mb-2">Nom:</label>
                <input type="text" name="nom" class="w-full mb-4 p-2 rounded bg-gray-800 border border-orange-500 text-white">
                <label for="email" class="block mb-2">Email:</label>
                <input type="text" name="email" class="w-full mb-4 p-2 rounded bg-gray-800 border border-orange-500 text-white">
                <label for="password" class="block mb-2">Password:</label>
                <input type="password" name="password" class="w-full mb-4 p-2 rounded bg-gray-800 border border-orange-500 text-white">
                <button type="submit" name="submit" class="bg-orange-500 text-white p-2 rounded w-full">Sign Up</button>
            </form>

            <!-- Login Form -->
            <form action="../signin.php" method="post" class="bg-gray-600 p-6 rounded-lg">
                <h2 class="text-2xl font-bold text-orange-500 mb-4">Login</h2>
                <label for="email" class="block mb-2">Email:</label>
                <input type="text" name="email" class="w-full mb-4 p-2 rounded bg-gray-800 border border-orange-500 text-white">
                <label for="password" class="block mb-2">Password:</label>
                <input type="password" name="password" class="w-full mb-4 p-2 rounded bg-gray-800 border border-orange-500 text-white">
                <button type="submit" name="submit" class="bg-orange-500 text-white p-2 rounded w-full">Sign In</button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 p-4 flex-none">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Car Rent. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>