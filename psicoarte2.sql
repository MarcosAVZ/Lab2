-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2024 a las 22:41:21
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
(2, 'juego');

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
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_productos`
--

CREATE TABLE `imagenes_productos` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `url_imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagenes_productos`
--

INSERT INTO `imagenes_productos` (`id`, `producto_id`, `url_imagen`) VALUES
(1, 1, '../uploads/81CNwMcQCLL._AC_UF1000,1000_QL80_.jpg'),
(3, 3, '../uploads/Centro educativo.png'),
(4, 4, '../uploads/IBM_PC_5150.jpg'),
(5, 5, '../uploads/descarga.jpg'),
(6, 6, '../uploads/6172dc1d3fc02.jpg'),
(7, 7, '../uploads/icons8-chart-64.png'),
(8, 8, '../uploads/PhotoMode_2023-06-06-02-09-35.png'),
(9, 9, '../uploads/Juguete.jpeg');

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
(3, 'Producto 3', 'Productos de prueba tatatasddasdadsdadasdsadsadsadadsadasdsa', 123.00, 12, '2024-05-11 19:41:02'),
(4, 'Producto 4', 'gsdsggdsgdsg', 0.04, 1, '2024-05-11 20:58:33'),
(5, 'Producto 5', 'adasdadsadsadads', 123.00, 12, '2024-05-12 23:50:41'),
(6, 'Producto 6', 'The SmartChef Pro revolutionizes cooking with its state-of-the-art technology and user-friendly design, making it the perfect addition to any modern kitchen. This cutting-edge appliance seamlessly integrates with your smart home system to provide a fully automated cooking experience.\r\n\r\nFeatures and Benefits:\r\n\r\nAdvanced Temperature Control: Equipped with precision sensors, the SmartChef Pro ensures your meals are cooked perfectly every time. Whether you are simmering, boiling, or frying, it adjusts the temperature dynamically to match the recipe’s requirements.', 123.00, 12, '2024-05-13 00:39:45'),
(7, 'Producto 7', 'The SmartChef Pro revolutionizes cooking with its state-of-the-art technology and user-friendly design, making it the perfect addition to any modern kitchen. This cutting-edge appliance seamlessly integrates with your smart home system to provide a fully automated cooking experience.\r\n\r\nFeatures and Benefits:\r\n\r\nAdvanced Temperature Control: Equipped with precision sensors, the SmartChef Pro ensures your meals are cooked perfectly every time. Whether you are simmering, boiling, or frying, it adjusts the temperature dynamically to match the recipe’s requirements.', 1231.00, 10, '2024-05-13 00:40:02'),
(8, 'Producto 8', 'The SmartChef Pro revolutionizes cooking with its state-of-the-art technology and user-friendly design, making it the perfect addition to any modern kitchen. This cutting-edge appliance seamlessly integrates with your smart home system to provide a fully automated cooking experience.\r\n\r\nFeatures and Benefits:\r\n\r\nAdvanced Temperature Control: Equipped with precision sensors, the SmartChef Pro ensures your meals are cooked perfectly every time. Whether you are simmering, boiling, or frying, it adjusts the temperature dynamically to match the recipe’s requirements.', 12.00, 7, '2024-05-13 00:40:26'),
(9, 'Producto 9', 'The SmartChef Pro revolutionizes cooking with its state-of-the-art technology and user-friendly design, making it the perfect addition to any modern kitchen. This cutting-edge appliance seamlessly integrates with your smart home system to provide a fully automated cooking experience.\r\n\r\nFeatures and Benefits:\r\n\r\nAdvanced Temperature Control: Equipped with precision sensors, the SmartChef Pro ensures your meals are cooked perfectly every time. Whether you are simmering, boiling, or frying, it adjusts the temperature dynamically to match the recipe’s requirements.', 11.96, 5, '2024-05-13 00:40:48');

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
  ADD KEY `producto_id` (`producto_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `imagenes_productos`
--
ALTER TABLE `imagenes_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `imagenes_productos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
