<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    require_once "config.php";
    //data to enter

    $sql = "INSERT INTO passwordentrys (name, password, url, userid, username,keyy) VALUES (?, ?, ?, ? ,?,?)";

    $validation = true;
    $validationErrorText = "";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssssss", $param_name, $param_password, $param_url, $param_userid, $param_username, $param_keyy);

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Passwords</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-darkmode@0.7.0/dist/darktheme.css" />
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include("tools/darkmode.php") ?>
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Do you want to upload a password?</h1>
    <a href="passwordmanager.php" class="btn btn-dark">Back to PWManager</a>
    <br>
    <br>

    <form action="uploadPassword.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="container input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Username</span>
                        </div>
                        <input name="username" type="text" class="form-control">
                    </div>
                    <br>
                    <div class="container input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Password</span>
                        </div>
                        <input name="password" type="password" class="form-control">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="container input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Url</span>
                        </div>
                        <input name="url" type="text" class="form-control">
                    </div>
                    <br>
                    <div class="container input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Name</span>
                        </div>
                        <input name="name" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button class="btn btn-dark" type="submit">Save</button>

    </form>
</body>

</html>