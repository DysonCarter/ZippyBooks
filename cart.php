<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_to_cart"])) {
        $book_title = $_POST["book_title"];
        // Add the book to session cart array
        $_SESSION['cart'][$book_title] = true;
    } elseif (isset($_POST["clear_cart"])) {
        session_destroy();
        //redirect so the cart shows empty
        header("Location: cart.php");
        exit();
    } elseif (isset($_POST["checkout"])) {
        $conn = mysqli_connect("localhost:3306", "root", "password", "Bookstore");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Loop through each book in the cart and update Bookstore
        foreach ($_SESSION['cart'] as $book_title => $value) {
            $update_query = "UPDATE books SET quantity = quantity - 1 WHERE title = '$book_title'";
            $result = mysqli_query($conn, $update_query);
        }
        
        session_destroy();
        header("Location: thanks.html");
        exit();
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ZippyBooks - Cart</title>
    <link rel="stylesheet" href="zippystyle.css">
    <link rel="icon" type="image/x-icon" href="zippy.png">
</head>
<body>

    <h1>ZippyBooks - Cart</h1>

    <nav>
        <a href="prj.php">Home</a>
        <a href="help.html">Help</a>
        <a href="admin.php">Admin</a>
        <a href="search.php">Search</a>
        <a href="cart.php">Cart</a>
    </nav>

    <main>
        <h2>Shopping Cart:</h2>
        <?php
        // Show books in cart
        if (count($_SESSION['cart']) > 0) {
            print "<ul>";
            foreach ($_SESSION['cart'] as $book_title => $value) {
                print "<li>$book_title</li>";
            }
            print "</ul>";
        } else {
            print "<p>Your cart is empty.</p>";
        }
        ?>

        <form method="post" action="">
            <input type="submit" name="clear_cart" value="Clear Cart">
        </form>
        <form method="post" action="">
            <input type="submit" name="checkout" value="Checkout">
        </form>
    </main>

    <footer>
        <p>&copy; 2023 Dyson Carter. All rights reserved.</p>
    </footer>

</body>
</html>
