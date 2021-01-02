<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

//Prepare stmt
require_once "config.php";

$param_id = $_SESSION["id"];
$profilePicture = "../images/placeholder-profile.jpg";

$sql = "SELECT profilepicture FROM users WHERE id=" . $param_id;
//prepare and execute statement
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->execute();
    $result = $stmt->get_result();
}
//get statement Result and set the Profile picture accordingly
while ($row = mysqli_fetch_array($result)) {
    foreach ($row as $r) {
        $profilePicture = $r;
    }
}

if (!is_file($profilePicture)) {
    $profilePicture = "../images/placeholder-profile.jpg";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-darkmode@0.7.0/dist/darktheme.css" />
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }

        #upload {
            opacity: 0;
        }

        #upload-label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
        }
    </style>
</head>

<body>
    <?php include("tools/darkmode.php")
    ?>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. This is your Profile</h1>
    </div>


    <img id="imageResult" src=" <?php echo $profilePicture; ?>        " alt="" width="200" height="200">

    <br>
    <br>
    <br>
    <br>

    <!-- Image Upload -->
    <h4> Change Your Profile Picture </h4>
    <div class="container">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="input-group mb-3 px-2 py-2 ">
                <input name="fileToUpload" id="upload" type="file" onchange="readURL(this);" class="form-control border-0">
                <label id="upload-label" for="upload" class="">Input File </label>
                <div class="input-group-prepend">
                    <label for="upload" class="btn btn-dark"><small class="font-weight-bold">Choose file</small></label>
                </div>
            </div>
            <button type="submit" class="btn btn-dark">Save Profile Picture</button>
        </form>
    </div>

    <br>
    <br>
    <h4>Personal Information</h4>
    <br>
    <br>
    <form action="profileUpload.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row">

                <div class="col-sm">
                    <div class="container input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">First Name</span>
                        </div>
                        <input name="firstName" type="text" class="form-control">
                    </div>
                    <br>
                    <div class="container input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">E-Mail</span>
                        </div>
                        <input name="email" type="email" class="form-control">
                    </div>
                </div>
                <div class="col-sm">
                    <div class="container input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Last Name</span>
                        </div>
                        <input name="lastName" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <a href="welcome.php" class="btn btn-dark">Back</a>
        <button class="btn btn-dark" type="submit">Save</button>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a class="btn btn-danger" href="deleteaccount.php">Delete Account</a>
    </form>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

</html>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imageResult')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function() {
        $('#upload').on('change', function() {
            readURL(input);
        });
    });
    var input = document.getElementById('upload');
    var infoArea = document.getElementById('upload-label');

    input.addEventListener('change', showFileName);

    function showFileName(event) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea.textContent = 'File name: ' + fileName;
    }
</script>