<?php
require_once('../Classes/user.php');
require_once('../db.php');

session_start();
$userId = $_SESSION["userid"];

// if (!$userId) {
//     header("Location: login.php");
//     exit();
// }

$db = new Database();
$pdo = $db->connect();

$user = new user();

$reservations = $user->getUserReservations($userId);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations</title>
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
            <h2 class="text-2xl font-bold text-orange-500 mb-4">My Reservations</h2>
            <table class="min-w-full bg-white text-center">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-200 text-gray-800">Car ID</th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-800">Start Date</th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-800">End Date</th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-800">Status</th>
                        <th class="py-2 px-4 bg-gray-200 text-gray-800">Creation Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($reservation['idCar']) ?></td>
                            <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($reservation['dateDebut']) ?></td>
                            <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($reservation['dateFin']) ?></td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                <?php if ($reservation['statut'] == 'confirmée'): ?>
                                    <span class="text-green-500"><?= htmlspecialchars($reservation['statut']) ?></span>
                                <?php elseif ($reservation['statut'] == 'en attente'): ?>
                                    <span class="text-yellow-500"><?= htmlspecialchars($reservation['statut']) ?></span>
                                <?php else: ?>
                                    <span class="text-red-500"><?= htmlspecialchars($reservation['statut']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($reservation['dateCreation']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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