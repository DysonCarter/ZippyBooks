<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost:3306", "root", "password", "Bookstore");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $searchTerm = $_POST["search"];

    $query = "SELECT * FROM books WHERE title LIKE '%$searchTerm%' AND quantity > 0";
    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ZippyBooks - Search</title>
    <link rel="stylesheet" href="zippystyle.css">
    <link rel="icon" type="image/x-icon" href="zippy.png">
</head>


<body>
    <h1>ZippyBooks - Search</h1>

    <nav>
        <a href="prj.php">Home</a>
        <a href="help.html">Help</a>
        <a href="admin.php">Admin</a>
        <a href="search.php">Search</a>
        <a href="cart.php">Cart</a>
    </nav>
    <main>
    <form method="post" action="search.php">
        <label for="search">Search:</label>
        <input type="text" name="search" required>
        <input type="submit" value="Search">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $result) {
        print "<h3>Search Results:</h3>";
        print "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            print "<li>";
            print $row["title"]; //title
            print "<br>";
            print $row["price"]; //price

            // Add to cart button
            print '<form  style="display: inline-block; margin-right: 10px;" method="post" action="cart.php">';
            print '<input type="hidden" name="book_title" value="' . $row["title"] . '">';
            print '<input type="submit" name="add_to_cart" value="Add to Cart">';
            print '</form>';

            print "</li>";
        }
        print "</ul>";
    }
    ?>
    <br>
    </main>
    <footer>
        <p>&copy; 2023 Dyson Carter. All rights reserved.</p>
    </footer>
</body>
</html>
