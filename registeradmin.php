<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css.css">
    <title>Registrera spelare - FUSK</title>
</head>

<body>
    <form action="registeradmin.php" method="post" class="middle">
        <h1>Registrera admin</h1>
        <div class="middle">
            <label for="fname">Användarnamn</label>
            <input id="fname" type="fname" name="fname">
        </div>
        <div class="middle">
            <label for="pass">Lösenord</label>
            <input id="pass" type="password" name="pass">
        </div>
        <input id="submit" type="submit" name="submit">
    </form>
    <?php
    include("connect.php");

    // echo "yeet";
    if (isset($_POST['submit'])) {
        $fname = $_POST["fname"];
        $pswd = $_POST["pass"];

        $result = generateHashWithSalt($pswd);
        $salt = $result[0];
        $pswd = $result[1];
        // print_r($result . $fname);
        // echo "hello";
        $conn->query("INSERT INTO players (fname, pass, salt) VALUES ('$fname','$pswd', '$salt')");
    }
    ?>
</body>

</html>