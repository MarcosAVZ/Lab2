-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2024 a las 18:46:07
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
-- Base de datos: `psicoarte2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`id`, `nombre`) VALUES
(1, 'niños'),
(2, 'juego'),
(3, 'Cartas'),
(4, 'bloques');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta_producto`
--

CREATE TABLE `etiqueta_producto` (
  `producto_id` int(11) NOT NULL,
  `etiqueta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `etiqueta_producto`
--

INSERT INTO `etiqueta_producto` (`producto_id`, `etiqueta_id`) VALUES
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(18, 3),
(18, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_productos`
--

CREATE TABLE `imagenes_productos` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `url_imagen` varchar(255) NOT NULL,
  `noticia_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes_productos`
--

INSERT INTO `imagenes_productos` (`id`, `producto_id`, `url_imagen`, `noticia_id`) VALUES
(6, 6, '../uploads/6172dc1d3fc02.jpg', NULL),
(8, 8, '../uploads/PhotoMode_2023-06-06-02-09-35.png', NULL),
(15, 5, '../uploads/abeja.jpg', NULL),
(16, 9, '../uploads/Captura de pantalla 2024-02-16 194101.png', NULL),
(17, 18, '../uploads/Captura de pantalla 2024-02-16 194250.png', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Descripcion` text NOT NULL,
  `Fecha_Creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `Titulo`, `Descripcion`, `Fecha_Creacion`) VALUES
(2, 'Título de la Noticia', 'Descripción detallada de la noticia.', '2024-05-15 03:00:00'),
(3, 'Título de la Noticia', 'Descripción detallada de la noticia.', '2024-05-16 03:00:00'),
(4, 'Novedad 2', 'Descripcion minima', '2024-05-15 23:14:44'),
(5, 'Novedad Nueva', 'Descripcion Minima ', '2024-05-15 23:15:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `nombre_Usuario` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `Correo`, `nombre_Usuario`, `contraseña`, `nombre`) VALUES
(2, 'marcosavanzaatti@gmail.com', 'Marcos123', '$2y$10$aDwXeX.sNN7U3Z5BFEqHpOxg67uBpQq41EvJDRvJ8rD4rBHQFl.By', 'Marcos Avanzatti'),
(3, 'marcosavanzatti@gmail.com', 'marcos', '$2y$10$J37mEbcRlWgvVJ85ytjZY.cmEFtz9fKmPGe8tMs9mHwA7TtuT0K9u', 'marcos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `fechaCreacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `cantidad`, `fechaCreacion`) VALUES
(1, 'Producto 1', 'primer imagen', 100.00, 2, '2024-05-11 18:30:34'),
(5, 'Producto 5', 'adasdadsadsadads', 123.00, 12, '2024-05-12 23:50:41'),
(6, 'Producto 6', 'The SmartChef Pro revolutionizes cooking with its state-of-the-art technology and user-friendly design, making it the perfect addition to any modern kitchen. This cutting-edge appliance seamlessly integrates with your smart home system to provide a fully automated cooking experience.\r\n\r\nFeatures and Benefits:\r\n\r\nAdvanced Temperature Control: Equipped with precision sensors, the SmartChef Pro ensures your meals are cooked perfectly every time. Whether you are simmering, boiling, or frying, it adjusts the temperature dynamically to match the recipe’s requirements.', 123.00, 12, '2024-05-13 00:39:45'),
(8, 'Producto 8', 'The SmartChef Pro revolutionizes cooking with its state-of-the-art technology and user-friendly design, making it the perfect addition to any modern kitchen. This cutting-edge appliance seamlessly integrates with your smart home system to provide a fully automated cooking experience.\r\n\r\nFeatures and Benefits:\r\n\r\nAdvanced Temperature Control: Equipped with precision sensors, the SmartChef Pro ensures your meals are cooked perfectly every time. Whether you are simmering, boiling, or frying, it adjusts the temperature dynamically to match the recipe’s requirements.', 12.00, 7, '2024-05-13 00:40:26'),
(9, 'Producto 9', 'The SmartChef Pro revolutionizes cooking with its state-of-the-art technology and user-friendly design, making it the perfect addition to any modern kitchen. This cutting-edge appliance seamlessly integrates with your smart home system to provide a fully automated cooking experience.\r\n\r\nFeatures and Benefits:\r\n\r\nAdvanced Temperature Control: Equipped with precision sensors, the SmartChef Pro ensures your meals are cooked perfectly every time. Whether you are simmering, boiling, or frying, it adjusts the temperature dynamically to match the recipe’s requirements.', 11.96, 5, '2024-05-13 00:40:48'),
(18, 'Producto 11', '123', 123.00, 1, '2024-05-15 19:16:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `etiqueta_producto`
--
ALTER TABLE `etiqueta_producto`
  ADD PRIMARY KEY (`producto_id`,`etiqueta_id`),
  ADD KEY `etiqueta_id` (`etiqueta_id`);

--
-- Indices de la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `fk_noticia` (`noticia_id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_Usuario` (`nombre_Usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `etiqueta_producto`
--
ALTER TABLE `etiqueta_producto`
  ADD CONSTRAINT `etiqueta_producto_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `etiqueta_producto_ibfk_2` FOREIGN KEY (`etiqueta_id`) REFERENCES `etiquetas` (`id`);

--
-- Filtros para la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  ADD CONSTRAINT `fk_noticia` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `imagenes_productos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
