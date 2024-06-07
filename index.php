<?php
include './config/database.php';
session_start();

$sql = 'SELECT * FROM todo';
$result = mysqli_query($mysqli, $sql);
$tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
$taksNumber = mysqli_num_rows($result);
$tasky = "";
$errors = '';
?>
<?php

if (isset($_POST['submit'])) {
    $tasky = filter_var($_POST['addtask'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!empty($tasky)) {
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `todo`(`task`, `Date`) VALUES ('$tasky','$date')";
    

        if (mysqli_query($mysqli, $sql)) {
            header('Location: index.php');
            exit;
        } else {
            $errors = "Erreur lors de l'ajout de la tâche : " . mysqli_error($mysqli);
        }
    } else {
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

        <?php if ($errors): ?>
            <div class="alert alert-danger"><?php echo $errors; ?></div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="form-inline justify-content-center my-4">
            <div class="form-group mx-sm-3 mb-2">
                <label for="addtask" class="sr-only">Ajouter une tâche</label>
                <input type="text" class="form-control" id="addtask" name="addtask" placeholder="Ajouter une tâche">
            </div>
            <button type="submit" name="submit" class="btn btn-primary mb-2">Ajouter</button>
        </form>

        <ul class="list-group" id="tasks-list">
            <?php 
            
            foreach ($tasks as $task) : ?>        
            <li class=""> <?php echo $task['task']?> </li>
                
            <?php endforeach; ?>
    
        </ul>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tasks-list').on('change', '.checklist', function() {
                $(this).closest('.list-group-item').toggleClass('list-group-item-success', this.checked);
            });
        });
    </script>
</body>
</html>
