<!DOCTYPE html>
<html>
<head>
    <title>ZippyBooks</title>
    <link rel="stylesheet" href="zippystyle.css">
    <link rel="icon" type="image/x-icon" href="zippy.png">
</head>
<body>
    <?php
        session_start();
    ?>

    <h1>ZippyBooks</h1>

    <nav>
        <a href="prj.php">Home</a>
        <a href="help.html">Help</a>
        <a href="admin.php">Admin</a>
        <a href="search.php">Search</a>
        <a href="cart.php">Cart</a>
    </nav>

    <main>
        <h2>All Our Books:</h2>
        <?php

        $db = mysqli_connect("localhost:3306", "root", "password", "Bookstore");
        if (!$db) {
            die("Error - Could not connect to MySQL: " . mysqli_connect_error());
        }

        $query = "SELECT title FROM books ORDER BY title ASC";
        $result = mysqli_query($db, $query);

        $num_rows = mysqli_num_rows($result);

        print "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            print "<li>" . htmlspecialchars($row["title"]) . "</li>";
        }
        print "</ul>";

        ?>
    </main>

    <footer>
        <p>&copy; 2023 Dyson Carter. All rights reserved.</p>
    </footer>

</body>
</html>
