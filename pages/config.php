<?php
// Database config
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'test');
define('DB_PASSWORD', 'qwert_1337');
define('DB_NAME', 'hashedpotatoes');

//Connect to Database
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($mysqli === false){
  echo "connection error";
  die("ERROR: Could not connect. " . $mysqli->connect_error);

}
