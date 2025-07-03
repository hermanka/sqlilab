<?php
// Koneksi ke database
    include_once('../connection.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SQL Injections Lab</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<?php
if(isset($_SESSION["loggedin"])) {
?>
<h2>Search for a Product</h2>
<form method="post">
    <input type="text" name="keyword" placeholder="Enter keyword..." />
    <input type="submit" value="Search" />
</form>

<?php
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    // ❌ Rentan terhadap SQL Injection
    $query = "SELECT * FROM products WHERE name LIKE '%$keyword%' OR description LIKE '%$keyword%'";
    $result = $mysqli->query($query);

    echo "<div class='result'>";
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // ❌ Rentan terhadap XSS
            echo "<p><strong>" . $row['name'] . "</strong>: " . $row['description'] . "</p>";
        }
    } else {
        echo "<p>No products found.</p>";
    }
    echo "</div>";
}
?>
<?php
} else {
    echo "You are note authorized!";
    echo "<br><a href='../index.php'>Back</a>";
}
?>
</body>
</html>
