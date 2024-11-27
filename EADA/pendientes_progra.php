<?php
session_start();
include 'conexion.php';

// Verificar si el usuario está logueado y tiene rol de programador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol_usuario'] != 'Programador') {
    die("No se ha iniciado sesión como programador. Acceso no autorizado.");
}

// Obtener el ID del programador de la sesión
$id_programador = $_SESSION['id_usuario'];

// Consulta para obtener los tickets asignados al programador
$query = "SELECT * FROM tickets WHERE id_programador = '$id_programador'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets Asignados</title>
    <link rel="stylesheet" href="pen_progra.css">
</head>
<body class="body_tabla">
    <h3 class="titulo_tabla">Tickets Asignados</h3>
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($ticket = mysqli_fetch_assoc($result)): ?>
            <div class="ticket_container">
                <table class="tabla_ticket">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Fecha de Asignación</th>
                            <th>Fecha de Finalización</th>
                            <th>Descripción del Pedido</th>
                            <th>Prioridad</th>
                            <th>Estado</th>
                            <th>Paleta de Colores</th>
                            <th>Descripción del Archivo</th>
                            <th>Esquema del Diseño</th>
                            <th>Comentario Adicional</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= htmlspecialchars($ticket['titulo']) ?></td>
                            <td><?= htmlspecialchars($ticket['fecha_asignacion']) ?></td>
                            <td><?= htmlspecialchars($ticket['fecha_finalizacion']) ?></td>
                            <td><?= htmlspecialchars($ticket['descripcion']) ?></td>
                            <td><?= htmlspecialchars($ticket['prioridad']) ?></td>
                            <td><?= htmlspecialchars($ticket['estado']) ?></td>
                            <td><?= htmlspecialchars($ticket['paleta_colores']) ?></td>
                            <td><?= htmlspecialchars($ticket['descripcion_archivos']) ?></td>
                            <td><?= htmlspecialchars($ticket['esquema_diseño']) ?></td>
                            <td><?= htmlspecialchars($ticket['comentarios_adicionales']) ?></td>
                        </tr>
                    </tbody>
                </table>
                <button class="boton_responder">Responder</button>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay tickets asignados a este programador.</p>
    <?php endif; ?>

    <?php mysqli_close($conn); ?>
</body>
</html>
