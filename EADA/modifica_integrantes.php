<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: inicio.html"); // Redirigir si no está autenticado
    exit();
}

// Verificar si 'id_usuario' está en la URL
if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
    
    include('conexion.php');


    // Recuperar los datos del usuario por ID
    $sql = "SELECT id_usuario, nombre, apellido, email, contraseña, telefono, rol FROM usuarios WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener los datos del usuario
        $usuario = $result->fetch_assoc();
    } else {
        echo "Usuario no encontrado.";
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID de usuario no especificado.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Integrante</title>
</head>
<body>
    <h2>Modificar Integrante</h2>

    <form method="POST" action="guardar_modificacion.php">
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required><br>

        <label for="apellido">Apellido: </label>
        <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" required><br>

        <label for="email">Email: </label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required><br>

        <label for="con trseña">Contraseña: </label>
        <input type="text" id="contraseña" name="contraseña" value="<?php echo htmlspecialchars($usuario['contraseña']); ?>" required><br>

        <label for="telefono">Teléfono: </label>
        <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>" required><br>

        <label for="rol">Rol: </label>
        <select name="rol" id="rol">
            <option value="Cliente" <?php echo ($usuario['rol'] == 'Cliente') ? 'selected' : ''; ?>>Cliente</option>
            <option value="admin" <?php echo ($usuario['rol'] == 'admin') ? 'selected' : ''; ?>>admin</option>
            <option value="programador" <?php echo ($usuario['rol'] == 'programador') ? 'selected' : ''; ?>>programador</option>
        </select><br>

        <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">

        <button type="submit">Modificar</button>
    </form>
</body>
</html>