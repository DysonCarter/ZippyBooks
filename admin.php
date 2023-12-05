<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = mysqli_connect("localhost:3306", "root", "password", "Bookstore");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    $query = "SELECT * FROM users WHERE username='$enteredUsername' AND password='$enteredPassword'";
    
    $result = mysqli_query($conn, $query);

    // if the user is found go to zippy books else go back to home page
    if ($result->num_rows > 0) {
        header("Location: ZippyBooks.html");
        exit();
    } else {
        header("Location: prj.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ZippyBooks - Admin Login</title>
    <link rel="stylesheet" href="zippystyle.css">
    <link rel="icon" type="image/x-icon" href="zippy.png">
</head>
<body>
    <h1>ZippyBooks - Admin Login</h1>

    <nav>
        <a href="prj.php">Home</a>
        <a href="help.html">Help</a>
        <a href="admin.php">Admin</a>
        <a href="search.php">Search</a>
        <a href="cart.php">Cart</a>
    </nav>
    <main>
    <form method="post" action="admin.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
    </main>

    <footer>
        <p>&copy; 2023 Dyson Carter. All rights reserved.</p>
    </footer>
</body>
</html>
