<?php
$servername = "127.0.0.1";
$username = "root";
$password = "1234";
$dbname = "sportsanywheredb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
