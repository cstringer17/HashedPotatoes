<?php

require_once "config.php";
session_start();

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

function createCard($row)
{
    echo '<div class="card col entry" style="width: 30rem; margin-left:20px;">';
    echo '<div class="card-body">';
    echo '<img src="//logo.clearbit.com/' . $row["url"] . '?size=80" class="rounded"><br>';
    echo '<h5 class="card-title">' . $row["name"] . '</h5>';
    echo ' <h6 class="card-subtitle mb-2 text-muted"> ' . $row["url"] .  '</h6>';
    echo '<h6 class="card-subtitle mb-2 text-muted">' . $row["username"] .  '</h6>';
    echo '<h6 class="card-subtitle mb-2 text-muted" onclick="copyPassword(this)">' . decodePassword($row["password"], $row["keyy"])  .  '</h6>';
    echo '<a href="editEntry.php?id=' .  $row["idpasswordEntrys"] .  '   "><i class="fas fa-edit"></i></a>';
    echo '<a class="delete" href="deleteEntry.php?id=' .  $row["idpasswordEntrys"] .  '   "><i class="fas fa-trash"></i></a>';
    echo '</div></div>';
}

function decodePassword($encoded, $key)
{
    $decoded = base64_decode($encoded);
    $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
    $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
    $plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
    return $plaintext;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Passwords</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-darkmode@0.7.0/dist/darktheme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }

        .entry {
            -ms-flex: 0 0 230px;
            flex: 0 0 230px;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        .delete {
            margin-left: 5%;
        }
    </style>
</head>

<body>

    <div class="page-header">
        <br>
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. These are your passwords</h1>
        <?php include("tools/darkmode.php")
        ?>
        <br>
        <a class="btn btn-dark" href="uploadPassword.php">New Password</a>
        <a class="btn btn-dark" href="welcome.php">Back to Home</a>
<<<<<<< HEAD
    </div>
    <br>
    <div class="container container-fluid">
        <div class="row">
            <?php
=======
    </div><br>
>>>>>>> 37cc88ad3a462ac161f391046941a7e28e4aa4b2

            $counter = 0;

            if ($result = mysqli_query($mysqli, "SELECT * FROM passwordentrys WHERE userid = " . $_SESSION["id"])) {

                while ($row = mysqli_fetch_array($result)) {
                    createCard($row);
                    $counter++;
                    if ($counter == 4) {
                        echo '<div class="w-100"></div><br>';
                        $counter = 0;
                    }
                }
            } else {
                echo "error";
            }

            mysqli_close($mysqli);

            ?>
        </div>
    </div>
    <div class="footer">
        <a id="footer-text" href="https://clearbit.com">Logos provided by Clearbit</a>
    </div>
</body>
<script>

</script>