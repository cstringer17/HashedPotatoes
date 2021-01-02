<?php

require_once("config.php");

// Prepare an insert statement
$sql = "DELETE FROM passwordentrys WHERE idpasswordEntrys = ?";

if ($stmt = $mysqli->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("s", $param_id);

    $param_id = $_GET["id"];

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Redirect to login page
        header("location: passwordmanager.php");
    } else {
        echo "Something went wrong. Please try again later.";
    }
    // Close statement
    $stmt->close();
}
