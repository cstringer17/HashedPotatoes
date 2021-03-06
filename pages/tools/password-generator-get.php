<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["passwordlength"])) {
    require '../vendor/autoload.php';

    //set password specification
    $alphabig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $alphasmall = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '1234567890';
    $special = '!@#$%^&*';
    //set passwordlength equal to slider
    $len = $_GET["passwordlength"];
    //take OpenSSL random pseudeo bytes function and set length with $len
    $random = openssl_random_pseudo_bytes($len);
    //Set $string = to $alphasmall because we need somehting already in $string
    $string = $alphasmall;
    // check if checkbox is set and add passowrd specification to $string if set
    if (isset($_GET["bigalphabet"])) {
        $string .= $alphabig;
    }
    if (isset($_GET["zerotonine"])) {
        $string .= $numbers;
    }
    if (isset($_GET["specialchar"])) {
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


        <div class="card-body">
            <?php
            if (isset($password)) {
                echo '<textarea id="passwordArea" name="message" rows="4" cols="30">  '  . $password . '</textarea>';
            }
            ?>
            <br>
            <button id="success" class="btn btn-info" onclick="copypassword()">Copy text</button>
            <br>
            <div id="message"></div>
            <br>

            <form method="get" enctype="multipart/form-data">
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
    <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.0.4/js/bootstrap-alert.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script>
        var slider = document.getElementById("passwordlength");
        var output = document.getElementById("counter");
        output.innerHTML = slider.value;

        slider.oninput = function() {
            output.innerHTML = this.value;
        }

        function copypassword() {
            var copyText = document.getElementById("passwordArea");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
        }

        $(document).ready(function() {

            $('#success').click(function(e) {
                console.log("success");
                e.preventDefault()
                $('#message').html('<br><div class="alert alert-success"><button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">×</button>Password Copied!</div>');
            })
        });
    </script>

</body>

</html>