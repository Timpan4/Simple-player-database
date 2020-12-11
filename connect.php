<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TE17fusk_Tim";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected";


//prepared statement to register a new player
$Cstmt = $conn->prepare("INSERT INTO players (fname, ename, mob, email, matches, goals, pass, salt) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$Cstmt->bind_param("ssssssss", $fname, $lname, $phone, $email, $matches, $goals, $pswd, $salt);
//prepared statement to search for specific players
$Sstmt = $conn->prepare("SELECT id, fname, ename, mob, email, matches, goals FROM players WHERE fname = ? OR ename = ?");
$Sstmt->bind_param("ss", $fnames, $lnames);

//prepared statement to show all players
$Astmt = $conn->prepare("SELECT id, fname, ename, mob, email, matches, goals FROM players");
//prepared statement to log in
$Lstmt = $conn->prepare("SELECT fname, pass, salt FROM players WHERE fname = ?");
$Lstmt->bind_param("s", $uname);
//prepared statement to update player data
$Ustmt = $conn->prepare("UPDATE players SET matches=?, goals=? WHERE id=?");
$Ustmt->bind_param("sss", $matches, $goals, $id);

//function to hint name
function hints($q, $result, $fname)
{
    $hint = "";
    if ($q !== "") {
        //make everything lowercase
        $q = strtolower($q);
        $len = strlen($q);
        while ($name = $result->fetch_assoc()) {
            //check if true
            if ($fname == "true") {
                $name = $name['fname'];
            } else {
                $name = $name['ename'];
            }
            if ($name !== "Admin") {
                //compare $q with the letters of $name
                if (stristr($q, substr($name, 0, $len))) {
                    if ($hint === "") {
                        $hint = $name;
                    } else {
                        $hint .= ", " . $name;
                    }
                }
            }
        }
    }
    // Output "no suggestion" if no hint was found or output correct values
    return $hint === "" ? "No suggestion" : "Do you mean: " . $hint;
}

//function to hash a password and return the hashed password + salt
function generateHashWithSalt($password)
{
    $passnSalt = array();
    //generate salt
    $salt = md5(uniqid(rand(), true));
    //add salt to array
    $passnSalt[0] = $salt;
    //generate hashed password with salt
    $passnSalt[1] = hash("sha256", $password . $passnSalt[0]);
    //return array
    return $passnSalt;
}
// echo "Connected successfully <br/>";
