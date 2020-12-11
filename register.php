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
    <title>Registrera spelare - FUSK</title>
</head>

<body>
    <form action="register.php" method="post" class="middle">
        <h1>Registrera ny spelare</h1>
        <div class="middle">
            <label for="fname">Förnamn</label>
            <input id="fname" type="fname" name="fname">
        </div>
        <div class="middle">
            <label for="ename">Efternamn</label>
            <input id="ename" type="lname" name="lname">
        </div>
        <div class="middle">
            <label for="tfn">Mobil</label>
            <input id="tfn" type="phone" name="phone">
        </div>
        <div class="middle">
            <label for="email">E-postadress</label>
            <input id="email" type="email" name="email">
        </div>
        <div class="middle">
            <label for="matches">Antal matcher</label>
            <input id="matches" type="number" name="matches">
        </div>
        <div class="middle">
            <label for="goals">Antal mål</label>
            <input id="goals" type="goals" name="goals">
        </div>
        <input id="submit" type="submit" name="submit">
        <input id="back" type="submit" name="back" value="Gå tillbaka">
    </form>
    <?php
    include("connect.php");
    //check if logged in
    if ($_SESSION["loggedin"]) {
        if (isset($_POST['back'])) {
            //if you want to go back you will be sent to the main menu
            header("Location: main.php");
        }
        if (isset($_POST['submit'])) {

            unset($_SESSION['fnames']);
            //get all values from the inputs
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $matches = $_POST["matches"];
            $goals = $_POST["goals"];

            //execute prepared statement to register a new player
            $Cstmt->execute();
        }
    } else {
        //if you're not logged in you get sent to the login page
        header("Location: index.php");
    }
    $conn->close();
    ?>
</body>

</html>