

<?php
include 'db-conn.php';
# Connect to MySQL database
$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare('SELECT * FROM studenten ORDER BY id');
$stmt->execute();
$studenten = $stmt->fetchAll(PDO::FETCH_ASSOC);



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
<table class="table table-primary table-hover">
  <thead>
    <tr>
      <th>Naam</th>
      <th>Klas</th>
      <th>Aantal Minuten</th>
      <th>Reden van te laat zijn</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    
      <?php foreach ($studenten as $student): ?>
        <tr>
        <td><?=$student['name']?></td>
        <td><?=$student['klas']?></td>
        <td><?=$student['minuten']?></td>
        <td><?=$student['reden']?></td>
        <td><a href="update.php?id=<?=$student['id']?>" class="btn btn-primary">Wijzig</a></td>
        <td><a href="delete.php?id=<?=$student['id']?>" class="btn btn-secondary">Verwijder</a></td>
        </tr>
        <?php endforeach; ?>
    

  </tbody>
</table>
<a href="create.php" class="btn btn-danger"name="create">Weer eentje telaat</a>
</div>


</body>
</html>

