<?php
$host = "localhost";
$user = "root"; // your DB username
$pass = "";     // your DB password
$dbname = "me_rental";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>