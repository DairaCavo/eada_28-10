<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: inicio.html");
    exit();
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexión a la base de datos
    include('conexion.php');

    // Validar y obtener los datos del formulario
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $rol = isset($_POST['rol']) ? $_POST['rol'] : null;
    $contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : null; // Aquí está correctamente definido
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;

    if ($nombre && $apellido && $email && $rol && $contraseña && $telefono) { // Cambiado $Contraseña por $contraseña
        // Insertar en la base de datos
        $sql = "INSERT INTO usuarios (nombre, apellido, email, rol, contraseña, telefono) VALUES ('$nombre', '$apellido', '$email', '$rol', '$contraseña', '$telefono')";

        if ($conn->query($sql) === TRUE) {
            echo "Integrante agregado con éxito.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Por favor, complete todos los campos.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Integrantes</title>
</head>
<body>
    <h1>Agregar Integrantes</h1>
    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="contraseña">Contraseña:</label>
        <input type="contraseña" id="contraseña" name="contraseña" required>
        <br>
        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required>
            <option value="Programador">Programador</option>
            <option value="Cliente">Cliente</option>
            <option value="Admin">Admin</option>
        </select>
        <br>
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required>
        <br><br>
        <button type="submit">Agregar</button>
    </form>
</body>
</html>