<?php
session_start();
?>
<html lang="en">
<head>
    <title>SQL Injections Lab</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<h2>Login to the wiki</h2>
<br /><br />

<form action='' method='post'>
    <table id='insert-table'>
        <tbody>
        <tr>
            <td>
                <label for='username'>Username:</label>
            </td>
            <td>
                <input name='username' id='username' class='user-input' value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" />
                
            </td>
        </tr>
        <tr>
            <td>
                <label for='password'>Password:</label>
            </td>
            <td>                
            <input type='password' name='password' id='password' class='user-input' value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" required/>
             </td>
        </tr>
        </tbody>
    </table>
    <br />
    <input type='submit' value='Login' name='Login' />
</form>

<?php
include_once('connection.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $query = 'SELECT * FROM users WHERE username = "' . $_POST['username'] . '" AND password = "' . $_POST['password'] . '"';
    
    $result = $mysqli->query($query);
    if (!$result) {
        die('Error: ' . $mysqli->error);
    }

    if ($result->num_rows > 0) {
        loginSuccessful($_POST['username']);
    } else {
        loginFailed();
    }

    $mysqli->close();
}

function loginSuccessful($name)
{
    echo 'Welcome back ' . $name . '!<br/>';
    echo '<a href="wiki/wiki.php">Continue here</a>';
    $_SESSION["loggedin"] = true;
}

function loginFailed()
{
    echo 'Wrong username or password.';
}

?>
</body>
</html>
