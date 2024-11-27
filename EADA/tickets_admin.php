<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    die("No se ha iniciado sesión. Acceso no autorizado.");
}

$id_usuario = $_SESSION['id_usuario'];

// Filtrar solo los tickets con estado 'Abierto'
$sql = "SELECT * FROM tickets WHERE estado = 'abierto'";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de tickets</title>
    <link rel="stylesheet" href="pendientes.css">
</head>
<body class="body_tabla">
    <h1 class="titulo_tabla">Tickets mandados</h1>
    <table class="tabla_tickets">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Fecha de asignacion</th>
                <th>Fecha de finalizacion</th>
                <th>Descripcion del pedido</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Paleta de colores</th>
                <th>Descripcion del archivo</th>
                <th>Esquema del diseño</th>
                <th>Comentario adicional</th>
                <th>Modificar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificar si hay resultados
            if ($resultado && $resultado->num_rows > 0) {
                // Mostrar cada fila como una fila de la tabla
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr class='fila'>";
                    echo "<td>" . htmlspecialchars($fila['titulo']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['fecha_asignacion']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['fecha_finalizacion']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['descripcion']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['prioridad']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['estado']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['paleta_colores']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['descripcion_archivos']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['esquema_diseño']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['comentarios_adicionales']) . "</td>";

                    // Enlace para modificar, pasando el id del ticket como parámetro GET
                    echo "<td><a href='modi_ticket.php?id_ticket=" . htmlspecialchars($fila['id_ticket']) . "'>Modificar</a></td>";

                    echo "</tr>";
                }
            } else {
                // Mostrar mensaje si no hay tickets abiertos
                echo "<tr class='fila'><td colspan='11'>No hay tickets abiertos.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
