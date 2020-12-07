<?php
/* Database credentials. */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'test');
define('DB_PASSWORD', 'qwert_1337');
define('DB_NAME', 'hashedpotatoes');
 


/* Attempt to connect to MySQL database */

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($mysqli === false){
  die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
