<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="register.php" method="post">
        <h2>Register</h2>

        <label for="nom">Nom:</label>
        <input type="text" name="nom">

        <label for="email">Email:</label>
        <input type="text" name="email">

        <label for="password">Password:</label>
        <input type="password" name="password">

        <button type="submit" name="submit">Sign Up</button>
    </form>


    <form action="signin.php" method="post">
        <h2>Login</h2>

        <label for="email">Email:</label>
        <input type="text" name="email">

        <label for="password">Password:</label>
        <input type="password" name="password">

        <button type="submit" name="submit">Sign Up</button>
    </form>
</body>
</html>
