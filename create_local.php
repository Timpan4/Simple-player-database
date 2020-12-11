<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">


        <?php
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            include("create_form.php");
        }
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "TE17fusk_Tim";


        // Create connection
        /*echo "server: " . $servername . "<br>";
    echo "user: " . $username . "<br>";
    echo "pass: " . $password . "<br>";
    echo "db: " . $dbname . "<br>";*/
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // sql to create table
        $sql = "CREATE TABLE players (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(30) NOT NULL,
    ename VARCHAR(30) NOT NULL,
    mob VARCHAR(50),
    email VARCHAR(50),
    matches VARCHAR(50),
    goals VARCHAR(50),
    pass VARCHAR(150),
    salt VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";


        if (mysqli_query($conn, $sql)) {
            echo "Table players created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($conn);
        }

        mysqli_close($conn);


        ?>
    </div>

</body>

</html>