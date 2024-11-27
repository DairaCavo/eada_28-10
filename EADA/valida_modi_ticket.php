<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: inicio.html"); // Redirigir si no está autenticado
    exit();
}

// Verificar si los datos han sido enviados correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_ticket'])) {
    $id_ticket = $_POST['id_ticket'];
    $titulo = $_POST['titulo'];
    $fecha_asignacion = $_POST['fecha_asignacion'];
    $fecha_finalizacion = $_POST['fecha_finalizacion'];
    $descripcion = $_POST['descripcion'];
    $prioridad = $_POST['prioridad'];
    $estado = $_POST['estado'];
    $paleta_colores = $_POST['paleta_colores'];
    $descripcion_archivos = $_POST['descripcion_archivos'];
    $esquema_diseño = $_POST['esquema_diseño'];
    $comentarios_adicionales = $_POST['comentarios_adicionales'];

    include('conexion.php');

    // Actualizar los datos en la base de datos
    $sql = "UPDATE tickets 
            SET titulo = ?, 
                fecha_asignacion = ?, 
                fecha_finalizacion = ?, 
                descripcion = ?, 
                prioridad = ?, 
                estado = ?, 
                paleta_colores = ?, 
                descripcion_archivos = ?, 
                esquema_diseño = ?, 
                comentarios_adicionales = ? 
            WHERE id_ticket = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssssi", 
        $titulo, 
        $fecha_asignacion, 
        $fecha_finalizacion, 
        $descripcion, 
        $prioridad, 
        $estado, 
        $paleta_colores, 
        $descripcion_archivos, 
        $esquema_diseño, 
        $comentarios_adicionales, 
        $id_ticket
    );

    if ($stmt->execute()) {
        echo "Ticket modificado con éxito.";
        // Redirigir a una página de confirmación o al listado de tickets
        echo '<form action="tickets_admin.php" method="get">
        <button type="submit">Volver</button>
      </form>';
    } else {
        echo "Error al modificar el ticket: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Datos incompletos o inválidos.";
    exit();
}
?>
