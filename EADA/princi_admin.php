<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: inicio.html"); // Redirigir si no está autenticado
    exit();
}

// Contenido de la página principal
echo "<h1 class='titulo-bienvenida'>Bienvenido/a, " . htmlspecialchars($_SESSION['nombre_usuario']) . "!</h1>";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="ticket.css">
</head>
<body class="fondo-pagina">
    <h2 class="subtitulo-accion">¿Qué deseas hacer hoy?</h2>
    <h4 class="texto-secundario">Seleccione la opción que prefieras</h4>
    <br>
    <form method="post" action="" class="formulario-botones">
        <button class="boton-animado" name="boton1" type="submit" formaction="programa_tickets.php">Revisar programadores</button>
        <button class="boton-animado" name="boton2" type="submit" formaction="tickets_admin.php">Tickets sin asignar</button>
        <button class="boton-animado" name="boton3" type="submit" formaction="">Solicitudes</button>
        <button class="boton-animado" name="boton4" type="submit" formaction="integrantes.php">Agregar o modificar integrantes</button>
    </form>
</body>
</html>
