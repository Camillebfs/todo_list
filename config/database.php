<?php
/* Définir les informations de connexion à la base de données*/
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "todo_list";

/* Établir une connexion à la base de données MySQL*/
$mysqli = mysqli_connect($host, $user, $password, $dbname);

/* Vérifier si la connexion a échoué*/
if (!$mysqli) {
    /* Arrêter l'exécution du script et afficher un message d'erreur si la connexion échoue*/
    die("Connection failed: " . mysqli_connect_error());
}


// echo 'Success: A proper connection to MySQL was made.';
// echo '<br>';
// echo 'Host information: ' . $mysqli->host_info;
// echo '<br>';
// echo 'Protocol version: ' . $mysqli->protocol_version;

// $mysqli->close();
?>