<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    require_once "config.php";
    //data to enter

    $sql = "UPDATE users SET firstname = ? , lastname = ?, email = ? WHERE id=" . $_SESSION["id"];

    $validation = true;
    $validationErrorText = "";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sss", $param_firstname, $param_lastname, $param_email);

        if (strlen($_POST["lastName"]) >= 50) {
            $validation = false;
            $validationErrorText .= "The name cannot be longer than 50 characters <br>";
        }
        if (strlen($_POST["firstName"]) >= 50) {
            $validation = false;
            $validationErrorText .= "The password cannot be longer than 50 characters <br>";
        }
        if (strlen($_POST["email"]) >= 50) {
            $validation = false;
            $validationErrorText .= "The url cannot be longer than 50 characters <br>";
        }
    }



    if ($validation) {
        // Set parameters
        $param_firstname =  htmlentities($_POST["firstname"]);
        $param_lastname =  htmlentities($_POST["lastname"]);
        $param_email = htmlentities($_POST["email"]);



        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            header("location: profile.php");
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
