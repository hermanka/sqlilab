<?php
session_start();
?>
<html lang="en">
<head>
    <title>SQL Injections Lab</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<?php
if(isset($_SESSION["loggedin"])) {
?>
<h2>Here are some programming languages</h2>


<form action='' method='post'>
    <table id='insert-table'>
        <tbody>
        <tr>
            <td>
                <label for='query'>Search for:</label>
            </td>
            <td>
                <input type='text' name='query' id='query' class='user-input' value='<?php
                    if (isset($_POST['query'])) echo $_POST['query']
                    ?>'></input>
            </td>
        </tr>
        </tbody>
    </table>
    <br />
    <input type='submit' value='Search' name='search' />
</form>

<table id='data-table'>
    <tbody>
    <tr>
        <th>Name</th>
        <th>Description</th>
    </tr>

    <?php
    include_once('../connection.php');
    if (isset($_POST['query'])) {
        $query = 'SELECT name, description FROM languages WHERE description LIKE "%' . $_POST['query'] . '%"';
        $result = $mysqli->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['name'] . '</td><td>' . $row['description'] . '</td>';
                echo '</tr>';
            }
        } else {
                echo '<tr>';
                echo '<td>Not found</td><td>Not found</td>';
                echo '</tr>';
        }

        $mysqli->close();
    }
    ?>
    </tbody>
</table>
<br />
<a href="logout.php">Logout</a>
<?php
} else {
    echo "You are note authorized!";
    echo "<br><a href='../index.php'>Back</a>";
}
?>
</body>
</html>
