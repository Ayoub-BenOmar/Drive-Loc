<?php
require_once('../Classes/user.php');
require_once('../db.php');

session_start();
$role = $_SESSION["role"];

if ($role !== "admin") {
    header("Location: ../index.php");
    exit();
}

$db = new Database();
$pdo = $db->connect();

$user = new user();

$reservations = $user->getAllReservations();

// echo "<pre>";
// print_r($reservations);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="bg-cover bg-center h-screen text-white h-screen w-screen flex flex-col" style="background-image: url('../Pics/CarRent.jpg');">

    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 flex-none">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold text-orange-500">Admin Dashboard</h1>
            <a href="../logout.php" class="text-white mx-2">Logout</a>
            <!-- Add more nav items here if needed -->
        </div>
    </nav>

    <div class="flex flex-grow overflow-hidden">
        <!-- Sidebar -->
        <aside class="bg-gray-800 w-64 min-h-screen p-4 flex flex-col">
            <nav class="flex flex-col">
                <a href="Admin-Desk.php" class="text-white py-2 px-4 mb-2 rounded bg-gray-700 hover:bg-gray-600">Desk</a>
                <a href="Admin.php" class="text-white py-2 px-4 mb-2 rounded bg-gray-700 hover:bg-gray-600">Add Car/Catgery/Theme</a>
                <a href="Admin-Reservations.php" class="text-white py-2 px-4 mb-2 rounded bg-gray-700 hover:bg-gray-600">Reservations</a>
                <a href="#" class="text-white py-2 px-4 mb-2 rounded bg-gray-700 hover:bg-gray-600">Dashboard</a>
            </nav>
        </aside>
        <!-- Main Content -->
        <main class="flex-grow p-8">
            <div class="bg-gray-600 p-6 rounded-lg mb-8">
                <h2 class="text-2xl font-bold text-orange-500 mb-4">Reservations Management</h2>
                <table class="w-full text-left">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border border-orange-500">Reservation ID</th>
                            <th class="px-4 py-2 border border-orange-500">Car ID</th>
                            <th class="px-4 py-2 border border-orange-500">User ID</th>
                            <th class="px-4 py-2 border border-orange-500">Start Date</th>
                            <th class="px-4 py-2 border border-orange-500">End Date</th>
                            <th class="px-4 py-2 border border-orange-500">Status</th>
                            <th class="px-4 py-2 border border-orange-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                            <tr>
                                <td class="px-4 py-2 border border-orange-500"><?= htmlspecialchars($reservation['idReservation']) ?></td>
                                <td class="px-4 py-2 border border-orange-500"><?= htmlspecialchars($reservation['idCar']) ?></td>
                                <td class="px-4 py-2 border border-orange-500"><?= htmlspecialchars($reservation['idUser']) ?></td>
                                <td class="px-4 py-2 border border-orange-500"><?= htmlspecialchars($reservation['dateDebut']) ?></td>
                                <td class="px-4 py-2 border border-orange-500"><?= htmlspecialchars($reservation['dateFin']) ?></td>
                                <td class="px-4 py-2 border border-orange-500">
                                    <?php if ($reservation['statut'] == 'confirmée'): ?>
                                        <span class="text-green-500"><?= htmlspecialchars($reservation['statut']) ?></span>
                                    <?php elseif ($reservation['statut'] == 'en attente'): ?>
                                        <span class="text-yellow-500"><?= htmlspecialchars($reservation['statut']) ?></span>
                                    <?php else: ?>
                                        <span class="text-red-500"><?= htmlspecialchars($reservation['statut']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-2 border border-orange-500">
                                    <form action="../handleReservation.php" method="POST" class="inline">
                                        <input type="hidden" name="reservationId" value="<?= htmlspecialchars($reservation['idReservation']) ?>">
                                        <button type="submit" name="action" value="accept" class="bg-green-500 text-white px-2 py-1 rounded">Accept</button>
                                    </form>
                                    <form action="../handleReservation.php" method="POST" class="inline">
                                        <input type="hidden" name="reservationId" value="<?= htmlspecialchars($reservation['idReservation']) ?>">
                                        <button type="submit" name="action" value="deny" class="bg-red-500 text-white px-2 py-1 rounded">Deny</button>
                                    </form>
                                    <form action="../handleReservation.php" method="POST" class="inline">
                                        <input type="hidden" name="reservationId" value="<?= htmlspecialchars($reservation['idReservation']) ?>">
                                        <button type="submit" name="action" value="delete" class="bg-gray-500 text-white px-2 py-1 rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 p-4 flex-none">
        <div class="container mx-auto text-center text-white">
            <p>&copy; 2025 Our Company. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>