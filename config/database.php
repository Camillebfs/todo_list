<?php
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "todo_list";

$mysqli = mysqli_connect($host, $user, $password, $dbname);

if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo 'Success: A proper connection to MySQL was made.';
// echo '<br>';
// echo 'Host information: ' . $mysqli->host_info;
// echo '<br>';
// echo 'Protocol version: ' . $mysqli->protocol_version;

// $mysqli->close();