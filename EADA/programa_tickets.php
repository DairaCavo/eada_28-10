<?php
session_start();
include 'conexion.php';

// Verificar si la sesión está activa
if (!isset($_SESSION['id_usuario'])) {
    die("No se ha iniciado sesión. Acceso no autorizado.");
}

// Obtener todos los programadores (usuarios)
$sql_programadores = "SELECT id_usuario, nombre FROM usuarios";
$resultado_programadores = $conn->query($sql_programadores);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programadores y Tareas</title>
    <link rel="stylesheet" href="pendientes.css">
</head>
<body class="body_tabla">
    <h1 class="titulo_tabla">Programadores y sus Tareas Asignadas</h1>

    <?php if ($resultado_programadores && $resultado_programadores->num_rows > 0): ?>
        <table class="tabla_tickets">
            <thead>
                <tr>
                    <th>Programador</th>
                    <th>Tareas Asignadas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Iterar sobre cada programador
                while ($programador = $resultado_programadores->fetch_assoc()) {
                    $id_programador = $programador['id_usuario'];
                    $nombre_programador = htmlspecialchars($programador['nombre']);

                    // Obtener los tickets asignados al programador
                    $sql_tickets = "SELECT * FROM tickets WHERE id_programador = '$id_programador' AND estado = 'abierto'";
                    $resultado_tickets = $conn->query($sql_tickets);

                    // Verificar si tiene tickets
                    if ($resultado_tickets && $resultado_tickets->num_rows > 0) {
                        echo "<tr>";
                        echo "<td>" . $nombre_programador . "</td>";
                        echo "<td><ul>";

                        // Mostrar los tickets asignados
                        while ($ticket = $resultado_tickets->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($ticket['titulo']) . "</li>";
                        }

                        echo "</ul></td>";
                        echo "</tr>";
                    } else {
                        // Si el programador no tiene tickets, mostrarlo
                        echo "<tr>";
                        echo "<td>" . $nombre_programador . "</td>";
                        echo "<td>No tiene tareas pendientes</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay programadores registrados.</p>
    <?php endif; ?>

</body>
</html>
