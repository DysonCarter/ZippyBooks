ZippyBooks.php
<!-- db-starter.php
     A PHP script to demonstrate database programming.
-->
<html>
<head>
    <title> Database Programming with PHP </title>
    <style type = "text/css">
    td, th, table {border: thin solid black;}
    </style>
</head>
<body>
<?php
    $id = $_POST["id"];
    $title = $_POST["title"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $flag = isset($_POST["flag"]) && $_POST["flag"] === "on";
$action = $_POST["action"];

// Connect to MySQL
$db = mysqli_connect("localhost:3306", "root", "password", "Bookstore");
if (!$db) {
    print "Error - Could not connect to MySQL";
    exit;
}

if ($action == "display") {
    $query = "SELECT * FROM books";
} else if ($action == "insert") {
    $query = "INSERT INTO books VALUES ('$id', '$title', '$price', '$quantity', '$flag')";
} else if ($action == "update") {
    $query = "UPDATE books SET price = '$price' WHERE id = '$id'";
} else if ($action == "delete") {
    $query = "DELETE FROM books WHERE id = '$id'";
}

if ($query != "") {
    $query_html = htmlspecialchars($query);
    print "<b> The query is: </b> " . $query_html . "<br />";
    
    $result = mysqli_query($db, $query);
    if (!$result) {
        print "Error - the query could not be executed";
        $error = mysqli_error($db);
        print "<p>" . $error . "</p>";
        exit;
    }
}

    
// Final Display of All Entries
$query = "SELECT * FROM books";
$result = mysqli_query($db,$query);
if (!$result) {
    print "Error - the query could not be executed";
    $error = mysqli_error();
    print "<p>" . $error . "</p>";
    exit;
}

// Get the number of rows in the result, as well as the first row
//  and the number of fields in the rows
$num_rows = mysqli_num_rows($result);
//print "Number of rows = $num_rows <br />";

print "<table><caption> <h2> books ($num_rows) </h2> </caption>";
print "<tr align = 'center'>";

$row = mysqli_fetch_array($result);
$num_fields = mysqli_num_fields($result);

// Produce the column labels
$keys = array_keys($row);
for ($index = 0; $index < $num_fields; $index++) 
    print "<th>" . $keys[2 * $index + 1] . "</th>";
print "</tr>";
    
// Output the values of the fields in the rows
for ($row_num = 0; $row_num < $num_rows; $row_num++) {
    print "<tr align = 'center'>";
    $values = array_values($row);
    for ($index = 0; $index < $num_fields; $index++){
        $value = htmlspecialchars($values[2 * $index + 1]);
        print "<th>" . $value . "</th> ";
    }
    print "</tr>";
    $row = mysqli_fetch_array($result);
}
print "</table>";
?>
<br>
<a href="ZippyBooks.html">Go Back</a>
</body>
</html>
