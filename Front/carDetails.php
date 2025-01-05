<?php
require_once('../Classes/addCar.php');
require_once('../Classes/addCategory.php');
require_once('../db.php');

// Get the car ID from the query parameter
$carId = isset($_GET['carId']) ? $_GET['carId'] : null;

// Create a new database connection
$db = new Database();
$pdo = $db->connect();

// Fetch car details by ID
$car = new Car("", "", "", "", "", "");
$carDetails = $car::getCarById($pdo, $carId);

$category = new Category("");
$categories = $category::GetAllCategories ($pdo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
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
                <a href="#" class="text-white mx-2">Reservations</a>
                <a href="Cars.php" class="text-white mx-2">Cars</a>
                <a href="../logout.php" class="text-white mx-2">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow p-8">
        <div class="container mx-auto bg-white rounded-lg shadow-lg overflow-hidden flex">
            <!-- Car Image -->
            <div class="w-1/2 p-8">
                <img src="../Pics/Car.jpg" alt="Car Image" class="object-cover w-full h-auto rounded-lg shadow-lg">
            </div>
            <!-- Car Details -->
            <div class="w-1/2 p-8">
                <h2 class="text-2xl font-bold text-orange-500 mb-4"><?= htmlspecialchars($carDetails['brand']) ?> : <?= htmlspecialchars($carDetails['model']) ?></h2>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-gray-700"><strong>Price:</strong> $<?= htmlspecialchars($carDetails['price']) ?>/day</p>
                    </div>
                    <div>
                        <p class="text-gray-700"><strong>Availability:</strong> <?= htmlspecialchars($carDetails['disponible']) ? 'Available' : 'Unavailable' ?></p>
                    </div>
                    <div>
                        <p class="text-gray-700"><strong>Category:</strong> <?= htmlspecialchars($carDetails['category_name']) ?></p>
                    </div>
                    <div>
                        <p class="text-gray-700"><strong>2500 km</p></strong>
                    </div>
                    <div>
                        <p class="text-gray-700"><strong>Hybrid</p></strong>
                    </div>
                    <div>
                        <p class="text-gray-700"><strong>GPS:</strong> Yes </p>
                    </div>
                    <div>
                        <p class="text-gray-700"><strong>Transmission:</strong> Automatic</p>
                    </div>
                    <div>
                        <p class="text-gray-700"><strong>Insurance:</strong> Full coverage</p>
                    </div>
                </div>

                <!-- Reservation Form -->
                <?php if ($carDetails['disponible']): ?>
                    <form action="../reserve.php" method="POST" class="mt-4">
                        <input type="hidden" name="carId" value="<?= htmlspecialchars($carId) ?>">
                        <div class="mb-4">
                            <label for="debutDate" class="block text-gray-700">Debut Date:</label>
                            <input type="date" id="dateDebut" name="dateDebut" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-orange-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="endDate" class="block text-gray-700">End Date:</label>
                            <input type="date" id="dateFin" name="dateFin" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-orange-500" required>
                        </div>
                        <button type="submit" name="reserveSubmit" class="bg-orange-500 text-white px-4 py-2 rounded">Reserve</button>
                    </form>
                <?php else: ?>
                    <p class="text-red-500 text-xl font-bold mt-4">This car is currently unavailable for reservation.</p>
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