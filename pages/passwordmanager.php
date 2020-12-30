<?php

require_once "config.php";

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

if ($result = mysqli_query($mysqli, "SELECT * FROM passwordentrys")) {
    while($row = mysqli_fetch_array($result))
     {
         //print info
        print_r($row);
     }
}else{
    echo "error";
}

mysqli_close($mysqli);
?>