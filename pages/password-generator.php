<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../vendor/autoload.php';

    //set password specification
    $alphabig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $alphasmall = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '1234567890';
    $special = '!@#$%^&*';
    //set passwordlength equal to slider
    $len = $_POST["passwordlength"];
    //take OpenSSL random pseudeo bytes function and set length with $len
    $random = openssl_random_pseudo_bytes($len);
    //Set $string = to $alphasmall because we need somehting already in $string
    $string = $alphasmall;
    // check if checkbox is set and add passowrd specification to $string if set
    if (isset($_POST["bigalphabet"])) {
        $string .= $alphabig;
    }
    if (isset($_POST["zerotonine"])) {
        $string .= $numbers;
    }
    if (isset($_POST["specialchar"])) {
        $string .= $special;
    }

    $string_length = strlen($string);
    //password empty
    $password = '';
    //create the password with the wanted specfications
    for ($i = 0; $i < $len; ++$i) {
        $password .= $string[ord($random[$i]) % $string_length];
    }
} else {
    echo "Generate a new Password!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Password Generator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="card container-sm" style="width: 18rem;">
        <form action="welcome.php" method="post" enctype="multipart/form-data">

            <div class="card-body">



                <form action="welcome.php" method="post" enctype="multipart/form-data">
                    <?php
                    if (isset($password)) {
                        echo "<h4>" . $password . "</h4>";
                    }
                    ?>
                    <br><input type="range" min="5" max="128" value="8" class="slider" name="passwordlength" id="passwordlength"><br>
                    <label id="counter" for="passwordlength"></label><br>

                    <input type="checkbox" id="bigalphabet" name="bigalphabet">
                    <label for="bigalphabet">A-Z</label><br>

                    <input type="checkbox" id="zerotonine" name="zerotonine">
                    <label for="zerotonine"> 0-9</label><br>

                    <input type="checkbox" id="specialchar" name="specialchar">
                    <label for="specialchar"> !@#$%^&*</label><br>

                    <button class="btn btn-dark" type="submit">Generate Password</button><br>
                    <br>


            </div>
    </div>


    </form>

    <script>
        var slider = document.getElementById("passwordlength");
        var output = document.getElementById("counter");
        output.innerHTML = slider.value;

        slider.oninput = function() {
            output.innerHTML = this.value;
        }
    </script>

</body>

</html>