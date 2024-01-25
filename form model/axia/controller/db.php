<?php
$servername = "localhost";
$username = "peroduamy_prospekperodua";
$password = "prospek1234*";
$dbname = "peroduamy_prospekperodua";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
