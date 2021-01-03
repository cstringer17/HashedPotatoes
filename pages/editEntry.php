<?php


//get information
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    require_once "config.php";
    //data to enter

    //$sql = "UPDATE passwordentrys WHERE idpasswordEntrys=" .  . " (name, password, url, userid, username,keyy) VALUES (?, ?, ?, ? ,?,?)";

    $sql = "UPDATE passwordentrys SET name = ? , password = ?, url = ?, username = ?, keyy = ? WHERE idpasswordEntrys=" . $_POST["id"];

    $validation = true;
    $validationErrorText = "";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sssss", $param_name, $param_password, $param_url, $param_username, $param_keyy);

        if (strlen($_POST["name"]) >= 45) {
            $validation = false;
            $validationErrorText .= "The name cannot be longer than 45 characters <br>";
        }
        if (strlen($_POST["password"]) >= 255) {
            $validation = false;
            $validationErrorText .= "The password cannot be longer than 255 characters <br>";
        }
        if (strlen($_POST["url"]) >= 255) {
            $validation = false;
            $validationErrorText .= "The url cannot be longer than 255 characters <br>";
        }
        if (strlen($_POST["username"]) >= 45) {
            $validation = false;
            $validationErrorText .= "The username cannot be longer than 45 characters <br>";
        }

        if (!(isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["url"]) && isset($_POST["username"]))) {
            $validation = false;
            $validationErrorText .= "Please make sure all fields are filled out! <br>";
        }

        //Password encrption
        $key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $ciphertext = sodium_crypto_secretbox($_POST["password"], $nonce, $key);
        $encoded = base64_encode($nonce . $ciphertext);


        if ($validation) {
            // Set parameters
            $param_name =  htmlentities($_POST["name"]);
            $param_password =  $encoded;
            $param_keyy = $key;
            $param_url  = filter_var($_POST["url"], FILTER_SANITIZE_URL);;
            $param_userid  = htmlentities($_SESSION["id"]);
            $param_username = htmlentities($_POST["username"]);


            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                header("location: passwordmanager.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }
            printf("Error: %s.\n", $stmt->error);



            // Close statement
            $stmt->close();
        } else {
            echo "Data Validation failed <br>";
            echo $validationErrorText;
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    require_once("config.php");

    if ($result = mysqli_query($mysqli, "SELECT * FROM passwordentrys WHERE idpasswordEntrys = " . $_GET["id"])) {
        $row = mysqli_fetch_array($result);

        $url = $row["url"];
        $name = $row["name"];
        $username = $row["username"];
        $key = $row["keyy"];
        $id = $row["idpasswordEntrys"];

        //decrypt password
        $password = decodePassword($row["password"], $key);
    }
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
    <title>Edit Password Entry</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-darkmode@0.7.0/dist/darktheme.css" />
    <style type="text/css">

    </style>
</head>

<body>
    <div class="container">
        <?php
        include("tools/darkmode.php")
        ?>
        <form action="editEntry.php" method="POST">
            <input name="id" type="text" readonly value="<?php echo $id ?>">
            <br>
            <br>
            <input name="username" type="text" value="<?php echo $username ?>">
            <br>
            <br>
            <input name="password" type="text" value="<?php echo $password ?>">
            <br>
            <br>
            <input name="name" type="text" value="<?php echo $name ?>">
            <br>
            <br>
            <input name="url" type="text" value="<?php echo $url ?>">
            <br>
            <br>
            <button class="btn btn-success">Save Changes</button>
        </form>
    </div>

</body>