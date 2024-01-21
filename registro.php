<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - Sports Anywhere!</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Registrarse</h1>

    <?php
    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Conectar a la base de datos
        $servername = "127.0.0.1";
        $username = "root";
        $password = "1234";
        $dbname = "sportsanywheredb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Obtener datos del formulario
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $contrasena = $_POST["contrasena"];

        // Consulta para insertar un nuevo usuario
        $sql = "INSERT INTO Usuarios (Nombre, Email, Contraseña) VALUES ('$nombre', '$email', '$contrasena')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            echo "<p>Registro exitoso. Ahora puedes iniciar sesión.</p>";
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form method="post" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>

        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
