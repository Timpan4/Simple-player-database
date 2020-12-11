<?php
@include("connect.php");
@session_start();
// if (@$_SESSION["fnames"]) {
//     $result = $_SESSION["fnames"];
// } else {

$sql = "SELECT fname, ename FROM players";
$result = $conn->query($sql);
$_SESSION['fnames'] = $result;
// }
// get the q and f parameter from URL
$q = $_REQUEST["q"];
$fname = $_REQUEST["f"];



echo hints($q, $result, $fname);
