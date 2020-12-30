<?php

session_start();
require_once "tools/loginCheck.php";

//fetch users passwords
$int = (int)$_SESSION["id"];


require_once "config.php";

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


$sql = "SELECT * FROM hashedpotatoes.passwordentrys WHERE userid = ?";



if ($stmt = $mysqli->prepare($sql)) {


    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("s", $param_userid);

    // Set parameters
    $param_userid = $int;

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Store result
        $stmt->store_result();
        // Check if username exists, if yes then verify password
        if ($stmt->num_rows >= 0) {
            echo $stmt;
        }
        echo "statement executed";
        
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    $stmt->close();
}else{
    echo "Oops! Something went wrong. Please try again later.";
    printf("Error: %s.\n", $stmt->error);
}

?>
<html>
<h1> test </h1>

</html>