<?php

require_once "config.php";
session_start();

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}




function createCard($row)
{
    echo '<div class="card" style="width: 18rem;">';
    echo '<div class="card-body">';
    echo '<img src="//logo.clearbit.com/' . $row["url"] . '?size=80" class="rounded"><br>';
    echo '<h5 class="card-title">' . $row["name"] . '</h5>';
    echo '<h6 class="card-subtitle mb-2 text-muted">' . $row["url"] .  '</h6>';
    echo '<h6 class="card-subtitle mb-2 text-muted">' . $row["username"] .  '</h6>';
    echo '<h6 class="card-subtitle mb-2 text-muted" onclick="copyPassword(this)">' . $row["password"] .  '</h6>';
    echo '</div></div><br>';
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
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. These are your passwords</h1>
        <br>
        <button class="btn btn-dark" href="uploadPassword.php">New Password</button>
    </div>

    <?php
    if ($result = mysqli_query($mysqli, "SELECT * FROM passwordentrys WHERE userid = " . $_SESSION["id"])) {

        while ($row = mysqli_fetch_array($result)) {
            createCard($row);
        }
    } else {
        echo "error";
    }

    mysqli_close($mysqli);

    ?>
    

    <a href="https://clearbit.com">Logos provided by Clearbit</a>
</body>
<script>
    
</script>