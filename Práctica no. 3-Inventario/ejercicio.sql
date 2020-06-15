-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2020 a las 02:22:06
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ejercicio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id` int(11) NOT NULL,
  `nombre_carrera` varchar(80) NOT NULL,
  `id_universidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre_carrera`, `id_universidad`) VALUES
(12, 'MECATRONICA', 2),
(14, 'ITI', 7),
(18, 'ITI4', 2),
(19, 'ITI4', 2),
(20, 'POO', 2),
(21, '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description_category` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_category`, `name_category`, `description_category`, `date_added`) VALUES
(1, 'sodas', 'nuevo', '0000-00-00 00:00:00'),
(3, 'papas sabritas', 'nuevas', '0000-00-00 00:00:00'),
(4, 'lacteos', 'lala ', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `rfc` char(12) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `rfc`, `date_added`) VALUES
(1, 'Jesus Cristobal', 'LIG1295MSDSA', '2020-06-12 15:00:41'),
(4, 'comun', '00000000', '2020-06-12 15:35:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id` int(11) NOT NULL,
  `cedula` varchar(120) NOT NULL,
  `contrasena` varchar(120) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `apellidos` varchar(120) NOT NULL,
  `promedio` float NOT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `edad` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id`, `cedula`, `contrasena`, `nombre`, `apellidos`, `promedio`, `id_carrera`, `edad`, `fecha`) VALUES
(10, '1630338', '123', 'jesus', 'limon', 100, 14, 21, '2020-05-20'),
(11, '121', '12', 'sad', 'asd', 12, 20, 12, '2020-05-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id_historial` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` varchar(255) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id_historial`, `id_producto`, `user_id`, `date`, `note`, `reference`, `quantity`) VALUES
(40, 17, 7, '2020-06-08 04:23:04', 'Jojo Jojo agrego nuevo producto', '12', 12),
(41, 18, 7, '2020-06-08 04:24:52', 'Jojo Jojo agrego nuevo producto', 'si', 12),
(45, 1, 7, '2020-06-10 15:58:34', 'Jojo Jojo agrego/compro', 'nuevo', 12),
(46, 12, 7, '2020-06-10 15:58:47', 'Jojo Jojo agrego/compro', 'si', 11),
(47, 1, 7, '2020-06-10 15:59:13', 'Jojo Jojo agrego/compro', 'si', 12),
(48, 18, 7, '2020-06-10 15:59:30', 'Jojo Jojo agrego/compro', 'si', 12),
(49, 1, 7, '2020-06-10 15:59:45', 'Jojo Jojo agrego/compro', 'si', 12),
(50, 19, 7, '2020-06-10 20:36:26', 'Jojo Jojo agrego nuevo producto', 'nuevas', 4),
(51, 20, 7, '2020-06-10 20:38:11', 'Jojo Jojo agrego nuevo producto', 'si', 12),
(52, 21, 7, '2020-06-10 20:38:38', 'Jojo Jojo agrego nuevo producto', 'azul', 20),
(53, 1, 7, '2020-06-12 16:33:24', 'Jojo Jojo quito', 's', 11),
(54, 12, 7, '2020-06-13 15:20:59', 'Jojo Jojo agrego', '', 20),
(55, 17, 7, '2020-06-13 15:21:07', 'Jojo Jojo agrego', '', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_product` int(11) NOT NULL,
  `code_product` char(20) NOT NULL,
  `name_product` char(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price_product` double NOT NULL,
  `stock` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_product`, `code_product`, `name_product`, `date_added`, `price_product`, `stock`, `id_category`) VALUES
(1, 'wqwq', 'pepsi', '2020-06-08 03:59:41', 10, 20, 1),
(12, '123123', 'coca-cola', '2020-06-24 00:00:00', 12, 1, 1),
(17, '21312', 'rancheritos', '2020-06-08 04:23:04', 20, 0, 3),
(18, '123213', 'chetos', '2020-06-08 04:24:52', 15, 2, 1),
(19, '21321', 'zeven-up', '2020-06-10 20:36:26', 8, 1, 1),
(20, '123213', 'Sprite', '2020-06-10 20:38:11', 16, 8, 1),
(21, '123213', 'Powerade', '2020-06-10 20:38:38', 18, 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `universidad`
--

CREATE TABLE `universidad` (
  `id` int(11) NOT NULL,
  `nombre_universidad` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `universidad`
--

INSERT INTO `universidad` (`id`, `nombre_universidad`) VALUES
(2, 'UANL'),
(7, 'UPV2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `firstname`, `lastname`, `user_name`, `user_password`, `user_email`, `date_added`, `tipo`) VALUES
(7, 'Jojo', 'Jojo', 'jojo', '$2y$10$yDpx/S3/Jc7XilXXoHEdkO.FXGAyxZSnHAPZj3crVIy3VvnWa4H3.', 'crisrl@live.com.mx', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `total_venta` int(11) NOT NULL,
  `total_productos` int(11) NOT NULL,
  `productos` varchar(120) CHARACTER SET utf8 NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `total_venta`, `total_productos`, `productos`, `fecha`, `cliente`) VALUES
(29, 37, 2, 'rancheritos,', '2020-06-13 16:46:02', 1),
(32, 55, 3, 'chetos,coca-cola,rancheritos,', '2020-06-13 16:48:44', 1),
(33, 37, 2, 'rancheritos,coca-cola,', '2020-06-13 17:12:04', 4),
(34, 200, 11, 'coca-cola,rancheritos,', '2020-06-13 17:30:34', 1),
(35, 102, 7, 'Sprite,zeven-up,', '2020-06-13 17:31:14', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_universidad` (`id_universidad`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_category`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `code_producto` (`code_product`),
  ADD KEY `id_category` (`id_category`);

--
-- Indices de la tabla `universidad`
--
ALTER TABLE `universidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `cliente` (`cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `universidad`
--
ALTER TABLE `universidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD CONSTRAINT `carrera_ibfk_1` FOREIGN KEY (`id_universidad`) REFERENCES `universidad` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
