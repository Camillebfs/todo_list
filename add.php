<?php
include('config/database.php');

if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    $date = date('Y-m-d H:i:s'); 

    if (empty($task)) {
        $errors = "You must fill in the task";
    } else {
        $query = "INSERT INTO `todo` (Todo, Date) VALUES (0, '$task', '$date')";
        mysqli_query($conn, $query);
        header('location: index.php');
    }
}

