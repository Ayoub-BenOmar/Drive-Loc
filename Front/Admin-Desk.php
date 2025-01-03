<?php
require_once('../Classes/addCar.php');
require_once('../db.php');

// Create a new database connection
$db = new Database();
$pdo = $db->connect();

// Fetch all cars
$car = new Car("", "", "", "", "", "");
$show = $car::getAllCars($pdo);
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

<body class="bg-cover bg-center h-screen text-white h-screen w-screen flex flex-col" style="background-image: url('../CarRent.jpg');">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 flex-none">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold text-orange-500">Admin Dashboard</h1>
            <!-- Add more nav items here if needed -->
        </div>
    </nav>

    <div class="flex flex-grow overflow-hidden">
        <!-- Sidebar -->
        <aside class="bg-gray-800 w-64 min-h-screen p-4 flex flex-col">
            <nav class="flex flex-col">
                <a href="Admin-Desk.php" class="text-white py-2 px-4 mb-2 rounded bg-gray-700 hover:bg-gray-600">Desk</a>
                <a href="Admin.php" class="text-white py-2 px-4 mb-2 rounded bg-gray-700 hover:bg-gray-600">Add Car</a>
                <a href="#" class="text-white py-2 px-4 mb-2 rounded bg-gray-700 hover:bg-gray-600">Reservations</a>
                <a href="#" class="text-white py-2 px-4 mb-2 rounded bg-gray-700 hover:bg-gray-600">Dashboard</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow p-8 overflow-auto">
            <div class="container mx-auto">
                <!-- Desk Table -->
                <div class="bg-gray-600 p-6 rounded-lg mb-8">
                    <h2 class="text-2xl font-bold text-orange-500 mb-4">Car List</h2>
                    <table class="w-full text-left">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border border-orange-500">Brand</th>
                                <th class="px-4 py-2 border border-orange-500">Model</th>
                                <th class="px-4 py-2 border border-orange-500">Price</th>
                                <th class="px-4 py-2 border border-orange-500">Category</th>
                                <th class="px-4 py-2 border border-orange-500">Availability</th>
                                <th class="px-4 py-2 border border-orange-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($show as $car): ?>
                            <tr>
                                <td class="px-4 py-2 border border-orange-500"><?= htmlspecialchars($car['brand']) ?></td>
                                <td class="px-4 py-2 border border-orange-500"><?= htmlspecialchars($car['model']) ?></td>
                                <td class="px-4 py-2 border border-orange-500"><?= htmlspecialchars($car['price']) ?></td>
                                <td class="px-4 py-2 border border-orange-500"><?= htmlspecialchars($car['categoryId']) ?></td>
                                <td class="px-4 py-2 border border-orange-500">
                                    <?php if(htmlspecialchars($car['disponible'])): ?> Available
                                    <?php else: ?> Unvailable
                                    <?php endif;?>
                                </td>
                                <td class="px-4 py-2 border border-orange-500">
                                    <button class="bg-orange-500 text-white px-2 py-1 rounded mr-2">Edit</button>
                                    <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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