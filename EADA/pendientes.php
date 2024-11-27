<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    die("No se ha iniciado sesión. Acceso no autorizado.");
}

$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT * FROM tickets WHERE id_usuario = '$id_usuario'";
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
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificar si hay resultados
            if ($resultado->num_rows > 0) {
                // Mostrar cada fila como una fila de la tabla
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr class='fila'>";
                    echo "<td>" . $fila['titulo'] . "</td>";
                    echo "<td>" . $fila['fecha_asignacion'] . "</td>";
                    echo "<td>" . $fila['fecha_finalizacion'] . "</td>";
                    echo "<td>" . $fila['descripcion'] . "</td>";
                    echo "<td>" . $fila['prioridad'] . "</td>";
                    echo "<td>" . $fila['estado'] . "</td>";
                    echo "<td>" . $fila['paleta_colores'] . "</td>";
                    echo "<td>" . $fila['descripcion_archivos'] . "</td>";
                    echo "<td>" . $fila['esquema_diseño'] . "</td>";
                    echo "<td>" . $fila['comentarios_adicionales'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr class='fila'><td colspan='5'>No hay datos disponibles</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
