<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


require_once "config.php"; 
//data to enter

$sql = "INSERT INTO passwordentrys (name, password, url, userid, username) VALUES (?, ?, ?, ? ,?)";


if ($stmt = $mysqli->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("sssss", $param_name, $param_password, $param_url, $param_userid, $param_username );

    // Set parameters
    $param_name =  $_POST["name"];
    $param_password = $_POST["password"];
    $param_url  = $_POST["url"];
    $param_userid  = $_SESSION["id"];
    $param_username = $_POST["username"];
    

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Redirect to login page
        echo "password saved";
        header("location: passwordmanager.php");
    } else {
        echo "Something went wrong. Please try again later.";
    }
    // Close statement
    $stmt->close();
}
}else{
    echo "not post";
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

<h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Do you want to upload a password?</h1>
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

        <button class="btn btn-dark" type="submit">Save</button>

    </form>
</body>

</html>