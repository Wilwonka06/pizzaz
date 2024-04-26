-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2023 a las 06:12:44
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizzas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `idtransaccion` varchar(30) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `correo` varchar(20) NOT NULL,
  `idcliente` varchar(20) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `idcompra` int(11) NOT NULL,
  `idproductos` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_producto_ingredientes`
--

CREATE TABLE `detalle_producto_ingredientes` (
  `idproducto` int(11) NOT NULL,
  `idingrediente` int(11) NOT NULL,
  `cantidad` varchar(50) NOT NULL,
  `un_medida` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

CREATE TABLE `ingredientes` (
  `idingredientes` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cantidad` varchar(50) NOT NULL,
  `un_medida` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombrep` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `descuento` tinyint(2) NOT NULL DEFAULT 0,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombrep`, `descripcion`, `precio`, `descuento`, `activo`) VALUES
(10, 'Pizza Mozzarella', 'Es una delicia italiana con una base crujiente, cubierta de queso mozzarella derretido y salsa de tomate.', 25000, 0, 1),
(11, 'Pizza Pesto', 'Combina una masa fina y crujiente con una deliciosa salsa pesto, hecha con albahaca fresca, aceite de oliva y piñones.', 25000, 0, 1),
(12, 'Pizza Italiana', 'Es una pizza que te transportará a las auténticas tradiciones culinarias de Italia. Con una masa fina y crujiente, Atrevete a probarla.', 27500, 0, 1),
(13, 'Pizza Burrata', 'La burrata, un exquisito queso italiano conocido por su cremosidad, se combina en armonía con los jugosos tomates cherry.', 30000, 0, 1),
(14, 'Pizza Vegetariana', 'Pimentón, cebolla, tomate, champiñones y maíz se mezclan en una deliciosa combinación junto con queso crema y una triple capa de quesos.\r\n                                    ', 26000, 0, 1),
(15, 'Pizza PIZZAZ', 'Con una base crujiente, salsa de tomate fresca y una combinación de champiñones, jamón y pimientos, todo cubierto con queso mozzarella derretido.', 28000, 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD KEY `detalles_compra_compra` (`idcompra`),
  ADD KEY `detalle_compra_productos` (`idproductos`);

--
-- Indices de la tabla `detalle_producto_ingredientes`
--
ALTER TABLE `detalle_producto_ingredientes`
  ADD KEY `detalle_producto_ingredientes_productos` (`idproducto`),
  ADD KEY `detalle_producto_ingredientes_ingredientes` (`idingrediente`);

--
-- Indices de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`idingredientes`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `idingredientes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`idproductos`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_producto_ingredientes`
--
ALTER TABLE `detalle_producto_ingredientes`
  ADD CONSTRAINT `detalle_producto_ingredientes_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_producto_ingredientes_ibfk_2` FOREIGN KEY (`idingrediente`) REFERENCES `ingredientes` (`idingredientes`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
