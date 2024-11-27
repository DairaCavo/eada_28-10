<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: inicio.html"); // Redirigir si no está autenticado
    exit();
}

// Verificar si 'id_ticket' está en la URL
if (isset($_GET['id_ticket'])) {
    $id_ticket = $_GET['id_ticket'];
    
    include('conexion.php');

    // Recuperar los datos del ticket por ID
    $sql = "SELECT id_ticket, titulo, fecha_asignacion, fecha_finalizacion, descripcion, prioridad, estado, paleta_colores, descripcion_archivos, esquema_diseño, comentarios_adicionales FROM tickets WHERE id_ticket = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_ticket);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener los datos del ticket
        $ticket = $result->fetch_assoc();
    } else {
        echo "Ticket no encontrado.";
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID de ticket no especificado.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Ticket</title>
</head>
<body>
    <h2>Modificar Ticket</h2>

    <form method="POST" action="valida_modi_ticket.php">
        <label for="titulo">Título: </label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($ticket['titulo']); ?>" required><br>

        <label for="fecha_asignacion">Fecha de asignación: </label>
        <input type="date" id="fecha_asignacion" name="fecha_asignacion" value="<?php echo htmlspecialchars($ticket['fecha_asignacion']); ?>" required><br>

        <label for="fecha_finalizacion">Fecha de finalización: </label>
        <input type="date" id="fecha_finalizacion" name="fecha_finalizacion" value="<?php echo htmlspecialchars($ticket['fecha_finalizacion']); ?>" required><br>

        <label for="descripcion">Descripción: </label>
        <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($ticket['descripcion']); ?></textarea><br>

        <label for="prioridad">Prioridad: </label>
        <select name="prioridad" id="prioridad">
            <option value="Alta" <?php echo ($ticket['prioridad'] == 'Alta') ? 'selected' : ''; ?>>Alta</option>
            <option value="Media" <?php echo ($ticket['prioridad'] == 'Media') ? 'selected' : ''; ?>>Media</option>
            <option value="Baja" <?php echo ($ticket['prioridad'] == 'Baja') ? 'selected' : ''; ?>>Baja</option>
        </select><br>

        <label for="estado">Estado: </label>
        <select name="estado" id="estado">
            <option value="Abierto" <?php echo ($ticket['estado'] == 'Abierto') ? 'selected' : ''; ?>>Abierto</option>
            <option value="En progreso" <?php echo ($ticket['estado'] == 'En progreso') ? 'selected' : ''; ?>>En progreso</option>
            <option value="Cerrado" <?php echo ($ticket['estado'] == 'Cerrado') ? 'selected' : ''; ?>>Cerrado</option>
        </select><br>

        <label for="paleta_colores">Paleta de colores: </label>
        <input type="text" id="paleta_colores" name="paleta_colores" value="<?php echo htmlspecialchars($ticket['paleta_colores']); ?>" required><br>

        <label for="descripcion_archivos">Descripción del archivo: </label>
        <textarea id="descripcion_archivos" name="descripcion_archivos"><?php echo htmlspecialchars($ticket['descripcion_archivos']); ?></textarea><br>

        <label for="esquema_diseño">Esquema del diseño: </label>
        <textarea id="esquema_diseño" name="esquema_diseño"><?php echo htmlspecialchars($ticket['esquema_diseño']); ?></textarea><br>

        <label for="comentarios_adicionales">Comentarios adicionales: </label>
        <textarea id="comentarios_adicionales" name="comentarios_adicionales"><?php echo htmlspecialchars($ticket['comentarios_adicionales']); ?></textarea><br>

        <input type="hidden" name="id_ticket" value="<?php echo $ticket['id_ticket']; ?>">

        <button type="submit">Modificar</button>
    </form>
</body>
</html>
