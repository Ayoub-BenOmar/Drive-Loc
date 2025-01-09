<?php
require_once('../Classes/addCar.php');
require_once('../Classes/addCategory.php');
require_once('../db.php');

$db = new Database();
$pdo = $db->connect();
$car = new Car("", "", "", "", "", "");
$show = $car::getAllCars($pdo, 5);

$category = new Category("");
$categories = $category::GetAllCategories ($pdo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
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
        <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-orange-500">Available Cars</h2>
                <div class="flex space-x-4">
                    <input type="text" placeholder="Search..." class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-orange-500">
                    <select class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-orange-500">
                        <option value="">Filter By Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['categoryId']) ?>">
                            <?= htmlspecialchars($category['category']) ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Example Car Card -->
                <?php foreach ($show as $car): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="../Pics/Car.jpg" alt="Car Image" class="w-full h-1/2 object-cover">
                    <div class="p-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Brand:</h3>
                                <p class="text-gray-700"><?= htmlspecialchars($car['brand']) ?></p>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Model:</h3>
                                <p class="text-gray-700"><?= htmlspecialchars($car['model']) ?></p>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Price:</h3>
                                <p class="text-gray-700">$<?= htmlspecialchars($car['price']) ?></p>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Availability:</h3>
                                <p class="text-gray-700">
                                    <?php if (htmlspecialchars($car['disponible'])): ?>
                                        <span class="text-green-500">Available</span>
                                    <?php else: ?>
                                        <span class="text-red-500">Unavailable</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="carDetails.php?carId=<?php echo $car['idCar'] ?>">
                                <button class="bg-orange-500 text-white px-4 py-2 rounded">Reserve</button>
                            </a>
                        </div>
                    </div>
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