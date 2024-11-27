<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: inicio.html"); // Redirigir si no está autenticado
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['rol'];

    // Conectar a la base de datos
    include('conexion.php');

    // Actualizar los datos del usuario
    $sql = "UPDATE usuarios SET nombre=?, apellido=?, email=?, contraseña=?, telefono=?, rol=? WHERE id_usuario=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nombre, $apellido, $email, $contraseña, $telefono, $rol, $id_usuario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "No se realizaron cambios.";
    }

    $stmt->close();
    $conn->close();
}
?>