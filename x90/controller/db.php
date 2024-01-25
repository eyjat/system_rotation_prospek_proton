<?php
$servername = "localhost";
$username = "protonmy_prospekproton";
$password = "proton1234*";
$dbname = "protonmy_prospekproton";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
