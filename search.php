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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js.js"></script>
    <script>
        function showHint(str, fname) {
            if (str.length == 0) {
                if (fname) {
                    document.getElementById("txtHint").innerHTML = "";
                } else {
                    document.getElementById("txtHinte").innerHTML = "";
                }
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (fname) {
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        } else {
                            document.getElementById("txtHinte").innerHTML = this.responseText;
                        }
                    }
                };
                xmlhttp.open("GET", "gethint.php?q=" + str + "&f=" + fname, true);
                // xmlhttp.open("GET", "gethint.php?f=" + fname, true);
                xmlhttp.send();
            }
        }
    </script>
    <title>Sök spelare - FUSK</title>
</head>

<body>
    <form action="search.php" method="post" class="middle" autocomplete="off">
        <input autocomplete="false" name="hidden" type="text" style="display:none;">
        <h1>Sök spelare</h1>
        <div class=" middle">
            <label for="fname">Förnamn</label>
            <input id="fname" type="fname" name="fname" onkeyup="showHint(this.value, true)">
            <p id="txtHint"></p>
        </div>
        <div class="middle">
            <label for="ename">Efternamn</label>
            <input id="ename" type="lname" name="lname" onkeyup="showHint(this.value, false)">
            <p id="txtHinte"></p>
        </div>
        <input id="submit" type="submit" name="submit">
        <input id="showall" type="submit" name="showall" value="Visa alla spelare">
        <input id="back" type="submit" name="back" value="Gå tillbaka">
        <input id='update' type='submit' name='update' value='Uppdatera'>

    </form>
    <?php
    include("connect.php");
    include("postTo.php");
    //check if you're logged in
    if ($_SESSION["loggedin"]) {
        if (isset($_POST['back'])) {
            header("Location: main.php");
        }
        if (isset($_POST['update'])) {
            // echo $_SESSION['objects'];

            $pplArr = $_SESSION["objects"];
            //loop through object array
            foreach ($pplArr as $ppl) {
                //store all object values in seperate variables
                $matches = $ppl->matches;
                $goals = $ppl->goals;
                $id = $ppl->id;
                //execute the prepared statement
                $Ustmt->execute();
                //reset the global variable
                $_SESSION['update'] = "";
            }
        }
        //display all players or the player you were looking for
        if (isset($_POST['submit']) || isset($_POST['showall'])) {
            if (isset($_POST['submit'])) {
                //get first and lastname from inputs
                $fnames = $_POST["fname"];
                $lnames = $_POST["lname"];

                //execute prepared statement to search for player
                $Sstmt->execute();
                //get result
                $result = $Sstmt->get_result();
            } else {
                //execute prepared statement to get all players
                $Astmt->execute();
                //get result
                $result = $Astmt->get_result();
            }

            //echo the start of the table
            echo "
    <table border='1'>
        <tr>
            <th>Förnamn</th>
            <th>Efternamn</th>
            <th>E-postadress</th>
            <th>Mobil</th>
            <th>Antal matcher</th>
            <th>Antal mål</th>
        </tr>";

            //loop through the result we got in the if statements and display the players
            while ($row = mysqli_fetch_array($result)) {
                if ($row['fname'] != "Admin") {
                    echo "<tr>";
                    echo "<td><p name='" . $row['id'] . "'>" . $row['fname'] . "</p></td>";
                    echo "<td>" . $row['ename'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['mob'] . "</td>";
                    //store the player id in the id of the input to later be used so you can change the values
                    echo "<td><input id='" . $row['id'] . "' type='number' value='" . $row['matches'] . "' name='matches'></td>";
                    echo "<td><input id='" . $row['id'] . "' type='number' value='" . $row['goals'] . "' name='goals'></td>";
                    echo "</tr>";
                }
            }
            echo "</table>";
        }
    } else {
        //if you're not logged in get sent back to the logg in page
        header("Location: index.php");
    }
    $conn->close();
    ?>
</body>

</html>