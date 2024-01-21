<?php
include 'conexion.php';

// Función para obtener la lista de productos
function obtenerProductos() {
    global $conn;
    $sql = "SELECT * FROM Productos";
    $result = $conn->query($sql);
    return ($result->num_rows > 0) ? $result : false;
}

// Función para agregar un nuevo producto
function agregarProducto($nombre, $descripcion, $precio, $imagenURL) {
    global $conn;
    $sql = "INSERT INTO Productos (Nombre, Descripcion, Precio, ImagenURL) VALUES ('$nombre', '$descripcion', $precio, '$imagenURL')";
    return $conn->query($sql);
}

// Función para actualizar un producto existente
function actualizarProducto($id, $nombre, $descripcion, $precio, $imagenURL) {
    global $conn;
    $sql = "UPDATE Productos SET Nombre='$nombre', Descripcion='$descripcion', Precio=$precio, ImagenURL='$imagenURL' WHERE ProductoID=$id";
    return $conn->query($sql);
}

// Función para eliminar un producto
function eliminarProducto($id) {
    global $conn;
    $sql = "DELETE FROM Productos WHERE ProductoID=$id";
    return $conn->query($sql);
}

// Función para mostrar todos los productos
function mostrarProductos() {
    global $conn;

    $sql = "SELECT * FROM Productos";
    $result = $conn->query($sql);

    echo "<h2>Lista de Productos</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imagen URL</th>
                <th>Acciones</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["ProductoID"] . "</td>
                <td>" . $row["Nombre"] . "</td>
                <td>" . $row["Descripcion"] . "</td>
                <td>" . $row["Precio"] . "</td>
                <td>" . $row["ImagenURL"] . "</td>
                <td>
                    <a href='crud.php?action=editar&id=" . $row["ProductoID"] . "'>Editar</a>
                    <a href='crud.php?action=eliminar&id=" . $row["ProductoID"] . "'>Eliminar</a>
                </td>
            </tr>";
    }

    echo "</table>";
}

// Función para mostrar el formulario de agregar/editar producto
function mostrarFormulario($id = null) {
    global $conn;

    $nombre = '';
    $descripcion = '';
    $precio = '';
    $imagenURL = '';

    if ($id) {
        // Obtener los datos del producto si es una edición
        $sql = "SELECT * FROM Productos WHERE ProductoID = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nombre = $row['Nombre'];
            $descripcion = $row['Descripcion'];
            $precio = $row['Precio'];
            $imagenURL = $row['ImagenURL'];
        }
    }

    echo "<h2>" . ($id ? "Editar" : "Agregar") . " Producto</h2>";
    echo "<form method='post' action='crud.php'>";
    echo "<input type='hidden' name='id' value='$id'>";
    echo "Nombre: <input type='text' name='nombre' value='$nombre'><br>";
    echo "Descripción: <textarea name='descripcion'>$descripcion</textarea><br>";
    echo "Precio: <input type='text' name='precio' value='$precio'><br>";
    echo "Imagen URL: <input type='text' name='imagenURL' value='$imagenURL'><br>";
    echo "<input type='submit' name='guardar' value='" . ($id ? "Actualizar" : "Agregar") . "'>";
    echo "</form>";
}

// Función para agregar o actualizar un producto
function agregarActualizarProducto($id, $nombre, $descripcion, $precio, $imagenURL) {
    global $conn;

    if ($id) {
        // Actualizar producto
        if (actualizarProducto($id, $nombre, $descripcion, $precio, $imagenURL)) {
            echo "Producto actualizado correctamente.";
        } else {
            echo "Error al actualizar producto.";
        }
    } else {
        // Agregar nuevo producto
        if (agregarProducto($nombre, $descripcion, $precio, $imagenURL)) {
            echo "Producto agregado correctamente.";
        } else {
            echo "Error al agregar producto.";
        }
    }
}

// Procesar las acciones
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'editar':
            if (isset($_GET['id'])) {
                mostrarFormulario($_GET['id']);
            }
            break;

        case 'eliminar':
            if (isset($_GET['id'])) {
                eliminarProducto($_GET['id']);
            }
            break;
    }
}

if (isset($_POST['guardar'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagenURL = $_POST['imagenURL'];

    agregarActualizarProducto($id, $nombre, $descripcion, $precio, $imagenURL);
}

// Mostrar la lista de productos
mostrarProductos();

// Cerrar la conexión
$conn->close();
?>
