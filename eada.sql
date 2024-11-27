-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2024 a las 13:38:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eada`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id_ticket` int(8) NOT NULL,
  `Id_usuario` int(8) DEFAULT NULL,
  `id_programador` int(8) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `fecha_asignacion` datetime DEFAULT NULL,
  `fecha_finalizacion` datetime DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `comentarios` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id_ticket` int(8) NOT NULL,
  `id_usuario` int(8) NOT NULL,
  `id_programador` varchar(100) DEFAULT NULL,
  `titulo` varchar(100) NOT NULL,
  `fecha_asignacion` datetime NOT NULL,
  `fecha_finalizacion` datetime NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `prioridad` enum('baja','media','alta') NOT NULL,
  `estado` enum('abierto','en proceso','finalizado') NOT NULL,
  `paleta_colores` varchar(100) NOT NULL,
  `descripcion_archivos` text NOT NULL,
  `esquema_diseño` varchar(100) NOT NULL,
  `comentarios_adicionales` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id_ticket`, `id_usuario`, `id_programador`, `titulo`, `fecha_asignacion`, `fecha_finalizacion`, `descripcion`, `prioridad`, `estado`, `paleta_colores`, `descripcion_archivos`, `esquema_diseño`, `comentarios_adicionales`) VALUES
(22, 40, '39', 'estrella', '2024-11-13 00:00:00', '2024-11-04 00:00:00', 'eeeeeeeeeeeeeeee', 'alta', '', 'eeeeeeeeee', 'eeeeeeeeee', 'eeeeeeeeeee', 'eeeeeeeeeeee'),
(23, 40, '44', 'augustos', '2024-10-28 00:00:00', '2024-11-15 00:00:00', 'ssssssssss', 'baja', 'abierto', 'sssssssss', 'ssssssssss', 'sssssssss', 'sssssssss'),
(24, 40, '39', 'estre', '2024-10-28 00:00:00', '2024-11-15 00:00:00', 'ssssssssss', 'baja', 'abierto', 'sssssssss', 'ssssssssss', 'sssssssss', 'sssssssss'),
(25, 40, '44', 'august', '2024-10-28 00:00:00', '2024-11-15 00:00:00', 'ssssssssss', 'baja', 'abierto', 'sssssssss', 'ssssssssss', 'sssssssss', 'sssssssss');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(8) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Contraseña` varchar(50) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Rol` enum('Cliente','Admin','Programador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `Nombre`, `Apellido`, `Email`, `Contraseña`, `Telefono`, `Fecha_Registro`, `Rol`) VALUES
(38, 'daira', 'cavo', 'dairacala@gmail.com', '2', '2246585212', '2024-11-27 11:38:01', 'Admin'),
(39, 'estrella', 'di claudio', 'estredicla123@gmail.com', 'zantinololo', '1121798677', '2024-11-22 14:00:33', 'Programador'),
(40, 'anny', 'villalobos', 'annyvillallobos6@gmail.com', '123456', '2257548355', '2024-11-22 14:02:24', 'Cliente'),
(41, 'aylen', 'almiron', 'almironaylen29@gmail.com', 'almiron', '2246535380', '2024-11-22 14:18:13', 'Cliente'),
(44, 'augus', 'leon', 'augusleon@gmail.com', '2', '22222222222', '2024-11-27 14:32:35', 'Programador'),
(45, 'rgs', 'sgsr', 'dairacsrhala@gmail.com', 'srh', '7', '2024-11-27 11:37:05', 'Programador'),
(46, 'sdfg', 'dfgh', 'dairacalaff@gmail.comf', 'ff', '44', '2024-11-27 11:37:13', 'Programador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id_ticket`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_ticket`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id_ticket` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
