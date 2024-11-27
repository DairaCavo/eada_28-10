<?php
session_start();
include('conexion.php');

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) { // Cambiado a id_usuario
    die("No se ha iniciado sesión. Acceso no autorizado.");
}

// Verificar conexión a la base de datos
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Asegurar entrada limpia y evitar inyección SQL
    $titulo = $conn->real_escape_string(trim($_POST['titulo']));
    $fecha_asignacion = $conn->real_escape_string(trim($_POST['fecha_asignacion']));
    $fecha_finalizacion = $conn->real_escape_string(trim($_POST['fecha_finalizacion']));
    $descripcion = $conn->real_escape_string(trim($_POST['descripcion']));
    $descripcion_archivos = $conn->real_escape_string(trim($_POST['descripcion_archivos']));
    $paleta_colores = $conn->real_escape_string(trim($_POST['paleta_colores']));
    $esquema_diseño = $conn->real_escape_string(trim($_POST['esquema_diseño']));
    $prioridad = $conn->real_escape_string(trim($_POST['prioridad']));
    $comentarios_adicionales = $conn->real_escape_string(trim($_POST['comentarios_adicionales']));
    
    // Usar el id_usuario de la sesión
    $id_usuario = $_SESSION['id_usuario']; // Cambiado a id_usuario

    // Consulta para guardar el ticket
    $sql = "INSERT INTO tickets (titulo, fecha_asignacion, fecha_finalizacion, descripcion, descripcion_archivos, paleta_colores, esquema_diseño, prioridad, comentarios_adicionales, id_usuario)
            VALUES ('$titulo', '$fecha_asignacion', '$fecha_finalizacion', '$descripcion', '$descripcion_archivos', '$paleta_colores', '$esquema_diseño', '$prioridad', '$comentarios_adicionales', '$id_usuario')";

    if ($conn->query($sql) === TRUE) {
        // Obtener el ID del ticket recién creado
        $id_ticket = $conn->insert_id;

        // Encontrar al programador con menos tickets asignados
        $query_programador = "
            SELECT u.id_usuario
            FROM usuarios u
            LEFT JOIN tickets t ON u.id_usuario = t.id_programador
            WHERE u.rol = 'programador'
            GROUP BY u.id_usuario
            ORDER BY COUNT(t.id_ticket) ASC
            LIMIT 1
        ";
        
        $result = $conn->query($query_programador);
        if ($result && $result->num_rows > 0) {
            $programador = $result->fetch_assoc();
            $id_programador = $programador['id_usuario'];

            // Asignar el ticket al programador
            $sql_asignar = "UPDATE tickets SET id_programador = $id_programador WHERE id_ticket = $id_ticket";
            if ($conn->query($sql_asignar) === TRUE) {
            } else {
                echo "Error al asignar el ticket: " . $conn->error . "<br>";
            }
        } else {
            echo "No hay programadores disponibles para asignar el ticket.<br>";
        }

        // Mostrar boton y msj
        echo "Ticket cargado exitosamente<br>";
        echo '<form action="principal.php" method="get">
                <button type="submit">Volver</button>
              </form>';
        exit();
    } else {
        echo "Error al guardar el ticket: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
