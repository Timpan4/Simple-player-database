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
    <title>Meny - FUSK</title>
</head>

<body>
    <form action="main.php" method="post" class="middle">
        <?php
        include("connect.php");
        include("destroyer.php");
        //check if you're logged in
        if ($_SESSION["loggedin"]) {
            echo "
        <h1>Registrera spelare</h1>
        <input id='submit' type='submit' name='submit'>";
            echo "<h1>Sök spelare</h1>
        <input id='submit' type='submit' name='sok'>
            <h1>Logga ut</h1>
        <input id='submit' type='submit' name='loggaut'>
            </form>";
            if (isset($_POST['loggaut'])) {
                //if you want to log out the session will be destroyed and you
                //will be sent to the log in page
                destroy();
                header("Location: index.php");
            }
            if (isset($_POST['submit'])) {
                //go to register player page
                header("Location: register.php");
            }
            if (isset($_POST['sok'])) {
                //go to search and display player page
                header("Location: search.php");
            }
        } else {
            //if you're not logged in get sent back to the logg in page
            header("Location: index.php");
        }
        $conn->close();
        ?>
</body>

</html>