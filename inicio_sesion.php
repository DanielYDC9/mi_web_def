<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sports Anywhere!</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Iniciar Sesión</h1>

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
        $email = $_POST["email"];
        $contrasena = $_POST["contrasena"];

        // Consulta para verificar las credenciales del usuario
        $sql = "SELECT * FROM Usuarios WHERE Email = '$email' AND Contraseña = '$contrasena'";
        $result = $conn->query($sql);

        // Verificar si se encontró un usuario con las credenciales proporcionadas
        if ($result->num_rows > 0) {
            // Iniciar sesión y redirigir al usuario a la página principal
            session_start();
            $_SESSION["usuario"] = $email;
            header("Location: index.php");
            exit();
        } else {
            echo "<p>Credenciales incorrectas. Inténtalo de nuevo.</p>";
        }

        $conn->close();
    }
    ?>

    <form method="post" action="">
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>

        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
