<?php
include 'db-conn.php';
$pdo = pdo_connect_mysql();
// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM studenten WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $studenten = $stmt->fetch(PDO::FETCH_ASSOC);
    #if (!$contact) {
        #exit('student doesn\'t exist with that ID!');
    #}
    // confirm
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM studenten WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the contact!';
            header('Location: read.php');
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>CRUD Challenge</title>
</head>
<body class="p-3 mb-2 bg-info text-white">
<div class="position-absolute top-40 start-50 translate-middle-x">
	<h2>Verwijder student</h2>
	<p>Weet u zeker dat u <?=$studenten['name']?> uit deze lijst wilt verwijderen?</p>
    <div>
        <a class="btn btn-primary" href="delete.php?id=<?=$studenten['id']?>&confirm=yes">Ja</a>
        <a class="btn btn-primary" href="delete.php?id=<?=$studenten['id']?>&confirm=no">Nee</a>
    </div>
    
</div>
</body>
</html>