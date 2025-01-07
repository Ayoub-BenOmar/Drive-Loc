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

<body class="bg-cover bg-center h-screen text-gray-800 h-screen w-screen flex flex-col" style="background-image: url('../Pics/homeCar.jpg');">
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
    <main class="flex-grow p-32">
        <div class="container mx-auto bg-white p-12 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-orange-500 mb-4">Welcome to Our Company</h2>
            <p class="text-gray-700 mb-4">
                Our company offers a wide range of high-quality rental cars to meet your needs. Whether you are looking for a compact car for city driving 
                or a spacious SUV for a family road trip, we have the perfect vehicle for you. Our dedicated team is committed to providing excellent 
                customer service and ensuring that you have a pleasant rental experience. Explore our website to learn more about our offerings and make 
                your reservation today!
            </p>
            <p class="text-gray-700">
                With years of experience in the car rental industry, we pride ourselves on our extensive selection of vehicles, competitive pricing, 
                and convenient rental process. We value your trust and strive to exceed your expectations with every rental. Thank you for choosing us 
                for your car rental needs.
            </p>
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