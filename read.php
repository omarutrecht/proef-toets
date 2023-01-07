<?php

require('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        echo "de verbinding is gelukt";
    } else {
        echo "Intere server-error";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}


$sql = "SELECT id
               ,voornaam
               ,tussenvoegsel
               ,achternaam
         FROM Persoon";

$statement =  $pdo->prepare($sql);

$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_OBJ);

//var_dump($result);

$row = "";
foreach ($result as $info) {
    $row .= "<tr>
            <td>$info->id</td>
            <td>$info->voornaam</td>
            <td>$info->tussenvoegsel</td>
            <td>$info->achternaam</td>
            <td>
                <a href= 'delete.php?id=$info->id'>
                    <img src='img/b_drop.png' alt='kruis'>
                   </a>
                   </td>
                   <td>
                    <a href='update.php?id=$info->id'>
                    <img src='img/b_edit.png' alt='potlood'>
                    </a>
                   </td>
                   </tr>";
}









?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h3>persoongegevens</h3>

    <a href="index.php">
        <input type="button" value="Nieuw record">
    </a>

    <table border="1">
        <thead>
            <th>id</th>
            <th>Voornaam</th>
            <th>tussenvoegsel</th>
            <th>Achternaam</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?= $row ?>
        </tbody>
    </table>

</body>

</html>