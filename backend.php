<?php
$servername = "127.0.0.1";
$username = "root";
$password = "1234";
$dbname = "sportsanywheredb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos de usuarios
$resultUsers = $conn->query("SELECT * FROM users");
$users = $resultUsers->fetch_all(MYSQLI_ASSOC);

// Obtener datos de publicaciones
$resultPosts = $conn->query("SELECT * FROM posts");
$posts = $resultPosts->fetch_all(MYSQLI_ASSOC);

// Devolver datos como JSON
$data = array("users" => $users, "posts" => $posts);
echo json_encode($data);

// Cerrar conexión
$conn->close();
?>
