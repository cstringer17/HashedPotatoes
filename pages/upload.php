<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

session_start();
require_once "config.php";
// Check if image file is a actual image
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"
) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //Write $target_file to db
    //Prepare sql statement
    $sql = "UPDATE users SET profilepicture = ? WHERE id = ?";

    //Get User ID
    $param_id = $_SESSION["id"];
    $param_profilepicture = $target_file;

    if ($stmt = mysqli_prepare($mysqli, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "si", $param_profilepicture, $param_id);

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }


    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been set as your profile picture.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Profile</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-darkmode@0.7.0/dist/darktheme.css" />
</head>
<style type="text/css">
  body {
    font: 14px sans-serif;
    text-align: center;
    margin-top: 2em;
  }
</style>

<body>
  <?php include("tools/darkmode.php")
  ?>
  <div class="container">
    <br>
    <a class="btn btn-dark" href="profile.php">Back to Your Profile</a>
  </div>

</body>

</html>