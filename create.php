<?php 
include 'db-conn.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $klas = isset($_POST['klas']) ? $_POST['klas'] : '';
    $minuten = isset($_POST['minuten']) ? $_POST['minuten'] : '';
    $reden = isset($_POST['reden']) ? $_POST['reden'] : '';
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO studenten VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $klas, $minuten, $reden]);
    header("Location: read.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>CRUD Challenge</title>
    <style>
        input, label{
            display:block;
        }
    </style>
</head>
<body class="p-3 mb-2 bg-info text-white">
<div class="position-absolute top-40 start-50 translate-middle-x">
    <form  class="column" action="create.php" method="post">
        <div class="mb-3">
        <label for="name">Naam</label>
        <input type="text" name="name" value="" id="name">
        </div>
        <div class="mb-3">
        <label for="klas">Klas</label>
        <input type="text" name="klas" value="" id="klas" style="text-transform:uppercase">
        </div>
        <div class="mb-3">
        <label for="minuten">Aantal minuten te laat</label>
        <input type="number" name="minuten" value="" id="minuten" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
        </div>
        <div class="mb-3">
        <label for="reden">Reden van te laat komen</label>
        <input type="text" name="reden" value="" id="reden">
        </div>
        <div class="mb-3">
        <input type="submit" class="btn btn-primary" name="save" value="Toevoegen"></input>
        </div>
    </form>
</div>
</body>
</html>