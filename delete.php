<?php
include('config/database.php');

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM `todo` WHERE ID=".$id);
header('location: index.php');
