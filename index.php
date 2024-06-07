<?php
/* Inclure le fichier de configuration de la base de données*/
include './config/database.php';
/* Démarrer la session PHP*/
session_start();

/*Exécuter une requête SQL pour sélectionner toutes les tâches*/
$sql = 'SELECT * FROM todo';
$result = mysqli_query($mysqli, $sql);

/* Récupérer toutes les tâches sous forme de tableau associatif*/
$tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

/*Compter le nombre de tâches*/
$taksNumber = mysqli_num_rows($result);
$tasky = "";
$errors = '';
?>

<?php
/* Vérifier si le formulaire a été soumis*/

if (isset($_POST['submit'])) {
    /* Filtrer et valider l'entrée de l'utilisateur pour éviter les caractères spéciaux*/
    $tasky = filter_var($_POST['addtask'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    
    /* Vérifier si la tâche n'est pas vide*/
    if (!empty($tasky)) {
        $date = date('Y-m-d H:i:s');// Obtenir la date et l'heure actuelles
        $sql = "INSERT INTO `todo`(`task`, `Date`) VALUES ('$tasky','$date')";
        /* Préparer la requête SQL pour insérer une nouvelle tâche dans la base de données*/
    
        /* Exécuter la requête SQL et vérifier si elle a réussi*/
        if (mysqli_query($mysqli, $sql)) {
            /* Rediriger vers la page d'index après l'insertion réussie*/
            header('Location: index.php');
            exit;
        } else {
            /* Enregistrer l'erreur si l'insertion échoue*/
            $errors = "Erreur lors de l'ajout de la tâche : " . mysqli_error($mysqli);
        }
    } else {
        /* Enregistrer l'erreur si la tâche est vide*/
        $errors = "Veuillez entrer une tâche.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="<KEY>" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>ToDoList</title>
</head>
<body class="bg-light">
    <div class="container">
        <h1 class="text-center my-4">Ma To Do liste</h1>

        <!-- Afficher les erreurs, le cas échéant -->
        <?php if ($errors): ?>
            <div class="alert alert-danger"><?php echo $errors; ?></div>
        <?php endif; ?>

        <!-- Formulaire pour ajouter une nouvelle tâche -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="form-inline justify-content-center my-4">
            <div class="form-group mx-sm-3 mb-2">
                <label for="addtask" class="sr-only">Ajouter une tâche</label>
                <input type="text" class="form-control" id="addtask" name="addtask" placeholder="Ajouter une tâche">
            </div>
            <button type="submit" name="submit" class="btn btn-primary mb-2">Ajouter</button>
        </form>

        <!-- Liste des tâches -->
        <ul class="list-group" id="tasks-list">
            <?php 
            /* Boucle à travers les tâches et les afficher dans une liste*/
            foreach ($tasks as $task) : ?>        
                <li class="form-control"> <?php echo htmlspecialchars($task['task']); ?> </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            /* Écouter les changements sur les cases à cocher et appliquer la classe CSS appropriée*/
            $('#tasks-list').on('change', '.checklist', function() {
                $(this).closest('.list-group-item').toggleClass('list-group-item-success', this.checked);
            });
        });
    </script>
</body>
</html>
