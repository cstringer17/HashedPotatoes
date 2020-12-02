<?php
/* Database credentials. */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'hashedpotatoes');
 


/* Attempt to connect to MySQL database */

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($mysqli -> connect_errno) {
    alert("Failed to connect to MySQL: " . $mysqli -> connect_error);
    exit();
  }
  function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
    }

  $mysqli -> close();

  


?>
