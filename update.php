<?php
include 'db-conn.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Checkt of id bestaat
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // Zelfde als create
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $klas = isset($_POST['klas']) ? $_POST['klas'] : '';
        $minuten = isset($_POST['minuten']) ? $_POST['minuten'] : '';
        $reden = isset($_POST['reden']) ? $_POST['reden'] : '';
        // Update de data
        $stmt = $pdo->prepare('UPDATE studenten SET id = ?, name = ?, klas = ?, minuten = ?, reden = ? WHERE id = ?');
        $stmt->execute([$id, $name, $klas, $minuten, $reden, $_GET['id']]);
        header("Location: read.php");
    }
    // Get the studet from the studets table
    $stmt = $pdo->prepare('SELECT * FROM studenten WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $studenten = $stmt->fetch(PDO::FETCH_ASSOC);
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

<div  class="position-absolute top-40 start-50 translate-middle-x">
	<h2>Update</h2>
    <form class="column" action="update.php?id=<?=$studenten['id']?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" value="<?=$studenten['id']?>" id="id">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?=$studenten['name']?>" id="name">
        <label for="klas">klas</label>
        <input type="text" name="klas" value="<?=$studenten['klas']?>" id="klas" style="text-transform:uppercase">
        <label for="minuten">minuten</label>
        <input type="number" name="minuten" value="<?=$studenten['minuten']?>" id="minuten">
        <label for="reden">Reden</label>
        <input type="text" name="reden" value="<?=$studenten['reden']?>" id="reden">
        <br>
        <input type="submit" class="btn btn-primary" value="Wijzigen">
    </form>
    
</div>

</body>
</html>

