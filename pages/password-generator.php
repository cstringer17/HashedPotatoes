<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../vendor/autoload.php';

    $alphabig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $alphasmall = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '1234567890';
    $special = '!@#$%^&*';
    $len = $_POST["passwordlength"];
    $random = openssl_random_pseudo_bytes($len);

    $string = $alphasmall;

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

    $password = '';

    for ($i = 0; $i < $len; ++$i) {
        $password .= $string[ord($random[$i]) % $string_length];
    }
} else {
    echo "not post";
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

    <form action="welcome.php" method="post" enctype="multipart/form-data">

        <input type="range" min="5" max="128" value="8" class="slider" name="passwordlength" id="passwordlength"><br>
        <label id="counter" for="passwordlength"></label><br>

        <input type="checkbox" id="bigalphabet" name="bigalphabet">
        <label for="bigalphabet">A-Z</label><br>

        <input type="checkbox" id="zerotonine" name="zerotonine">
        <label for="zerotonine"> 0-9</label><br>

        <input type="checkbox" id="specialchar" name="specialchar">
        <label for="specialchar"> !@#$%^&*</label><br>

        <button class="btn btn-dark" type="submit">Generate Password</button><br>
        <br>
        <?php

        if (isset($password)) {
            echo $password;
        }
        ?>
    </form>

    <script>
        var slider = document.getElementById("passwordlength");
        var output = document.getElementById("counter");
        output.innerHTML = slider.value; // Display the default slider value

        slider.oninput = function() {
            output.innerHTML = this.value;
        }
    </script>

</body>

</html>