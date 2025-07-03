<?php
$dbhost = 'db';
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'sqlilab';
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_errno) {
    die('<p>Could not connect: ' . $mysqli->connect_error . '</p>');
}
