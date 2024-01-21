<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Anywhere! - Productos</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://js.stripe.com/v3/"></script>
    <script src="script.js"></script>
</head>
<body>
    <select id="themeSelector">
        <option value="claro">Tema Claro</option>
        <option value="oscuro">Tema Oscuro</option>
        <option value="rojo">Tema Rojo</option>
        <option value="azul">Tema Azul</option>
    </select>
    <header>
        <h1>Sports Anywhere!</h1>
        <img src="IMG/logo.png" alt="Logo" style="width: 600px;">
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="productos">
            <h2>PRODUCTOS</h2>
            
            <?php
            // Incluir el archivo de conexión
            include 'conexion.php';

            // Realizar una consulta de productos
            $sql = "SELECT * FROM Productos";
            $result = $conn->query($sql);

            // Mostrar los resultados
            while ($row = $result->fetch_assoc()) {
                echo "<div class='producto'>";
                echo "<h3>" . $row["Nombre"] . "</h3>";
                echo "<p>" . $row["Descripcion"] . "</p>";
                echo "<img src='" . $row["ImagenURL"] . "' style='max-width: 200px;'>";
                echo "<p>Precio: " . $row["Precio"] . "€</p>";
                echo "<button onclick=\"agregarAlCarrito('" . $row["Nombre"] . "', 10)\">Agregar al Carrito</button>";
                echo "</div>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
            
        </section>
    </main>


    <script src="script.js"></script>
</body>
</html>
