<?php

require_once "config.php";
session_start();

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

if ($result = mysqli_query($mysqli, "SELECT * FROM passwordentrys WHERE userid = " . $_SESSION["id"] )) {
    while($row = mysqli_fetch_array($result))
     {
        createCard($row);
     }
}else{
    echo "error";
}

mysqli_close($mysqli);


function createCard($row){
    echo '<div class="card" style="width: 18rem;">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $row["name"] . '</h5>';
    echo '<h6 class="card-subtitle mb-2 text-muted">' . $row["url"] .  '</h6>';
    echo '<h6 class="card-subtitle mb-2 text-muted">' . $row["username"] .  '</h6>';
    echo '<h6 class="card-subtitle mb-2 text-muted">' . $row["password"] .  '</h6>';
    echo '</div></div>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Passwords</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
</body>