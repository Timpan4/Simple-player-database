<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css.css">
    <title>Logga - FUSK</title>
</head>

<body>
    <form action="index.php" method="post" class="middle">
        <h1>Logga in</h1>
        <div class="middle">
            <label for="uname">Användarnamn</label>
            <input id="uname" type="username" name="uname">
        </div>
        <div class="middle">
            <label for="pwd">Lösenord</label>
            <input id="pwd" type="password" name="pwd">
        </div>
        <input id="submit" type="submit" name="submit">
    </form>
    <?php
    include("connect.php");
    //log in
    if (isset($_POST['submit'])) {

        $uname = $_POST["uname"];
        //get username from input and execute prepared statement to check
        //if the username is legit
        $Lstmt->execute();
        //get the result
        $result = mysqli_fetch_array($Lstmt->get_result());

        //get the password from the input
        $pwd = $_POST["pwd"];

        if ($uname == "user" && $pwd == "") {
            $_SESSION["loggedin"] = true;
            $_SESSION["Admin"] = false;
        } else {

            //get the salt of the found player
            $salt = $result["salt"];
            //hash the typed password with the salt
            $pswd = hash("sha256", $pwd . $salt);

            //check if the hashed password is the same as the one on the server
            if ($pswd == $result["pass"]) {
                $_SESSION["loggedin"] = true;
                $_SESSION["Admin"] = true;
                header("Location: main.php");
            }
        }
    }
    $conn->close();
    ?>
</body>

</html>