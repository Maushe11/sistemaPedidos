-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2020 a las 04:23:41
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `simple`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `email` text NOT NULL,
  `foto` text NOT NULL,
  `password` text NOT NULL,
  `perfil` text NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombre`, `email`, `foto`, `password`, `perfil`, `estado`, `fecha`) VALUES
(1, 'admin', 'admin', '', 'admin123', 'superadministrador', 1, '2020-04-19 02:16:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombres` text NOT NULL,
  `apellidos` text NOT NULL,
  `distrito` text NOT NULL,
  `direccion` text NOT NULL,
  `telefono` text NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombres`, `apellidos`, `distrito`, `direccion`, `telefono`, `fechaRegistro`) VALUES
(1, 'Juan', 'Ruiz Sanchez', 'Surco', 'Calle Boulebar 701', '933159753', '2020-04-23 02:16:11'),
(2, 'Luis', 'Torres Cáceres', 'La Molina', 'Av. Frutales 802', '987654321', '2020-04-23 02:13:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`idPedido`, `idProducto`, `cantidad`) VALUES
(1, 2, 2),
(1, 1, 5),
(2, 4, 2),
(2, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `precioTotal` float(10,2) NOT NULL,
  `fechaRegistrada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `idCliente`, `precioTotal`, `fechaRegistrada`) VALUES
(1, 1, 79.50, '2020-04-21 04:00:38'),
(2, 2, 82.50, '2020-04-21 05:55:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `sku` int(11) NOT NULL,
  `nombreProducto` text NOT NULL,
  `temperatura` text NOT NULL,
  `precioCompra` float(10,2) NOT NULL,
  `precioVenta` float(10,2) NOT NULL,
  `cantidadPedida` int(11) NOT NULL,
  `fechaRegistrada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `sku`, `nombreProducto`, `temperatura`, `precioCompra`, `precioVenta`, `cantidadPedida`, `fechaRegistrada`) VALUES
(1, 12467, 'POLLO ENTERO MERCADO SF FR PRECIO X KG', 'Refrigerado', 0.00, 7.50, 0, '2020-04-20 04:48:25'),
(2, 270023, 'FILETE PECHUGA S/P SF FR X KG', 'Refrigerado', 18.99, 21.00, 0, '2020-04-20 04:48:39'),
(3, 129239, 'FILETE DE PECHUGA MK CG IQF X1KG', 'Congelado', 11.99, 13.50, 0, '2020-04-20 04:48:51'),
(4, 103617, 'GUISO ECON TNZ PRO EV X KG', 'Refrigerado', 0.00, 22.00, 0, '2020-04-18 21:17:24'),
(5, 103614, 'CARNE MOLIDA TNZ EC FR X KG', 'Refrigerado', 0.00, 15.50, 0, '2020-04-21 06:36:52'),
(6, 109667, 'FILETE DE TILAPIA ARO 5 A 7 X 1KG', 'Congelado', 0.00, 15.50, 0, '2020-04-21 06:43:21'),
(7, 117527, 'TROZOS PERICO NOVA X1KG', 'Congelado', 0.00, 15.99, 0, '2020-04-21 06:44:26'),
(8, 122354, 'FILETE DE PERICO FROZEN S/P X KG', 'Congelado', 0.00, 17.99, 0, '2020-04-21 06:45:12'),
(9, 123456, 'FILETE BASA EASY PREMIUM 1KG', 'Congelado', 0.00, 15.50, 0, '2020-04-21 06:45:31'),
(10, 109000, 'NARANJA EXTRA PARA JUGO MLL X 2.5 KG APROX', 'Fresco', 0.00, 9.00, 0, '2020-04-21 06:45:50'),
(11, 107911, 'LIMON 1RA VERDE CEVICHERO MLL X 2 KG APX', 'Fresco', 0.00, 8.00, 0, '2020-04-21 06:46:19'),
(12, 107964, 'PAPA AMARILLA MEDIANA LAVADA X 2 KG APROX', 'Fresco', 0.00, 10.00, 0, '2020-04-21 06:47:32'),
(13, 105822, 'TOMATE MENU MALLA X 2 KG APROX', 'Fresco', 0.00, 8.50, 0, '2020-04-21 06:48:02'),
(14, 4537, 'CEBOLLA ROJA MALLA X KG APROX', 'Fresco', 0.00, 3.00, 0, '2020-04-21 06:48:20'),
(15, 100193, 'MANZANA ROYAL GALA IMPORTADA BDJX6UN', 'Fresco', 0.00, 7.50, 0, '2020-04-21 06:48:50'),
(16, 368953, 'CHOCLO ENTERO X 1UND', 'Fresco', 0.00, 2.00, 0, '2020-04-21 06:49:12'),
(17, 7397, 'CHAMPINON ENTERO PACCU X 0.4KG', 'Refrigerado', 0.00, 12.00, 0, '2020-04-21 06:49:31'),
(18, 162461, 'PLATANO DE SEDA BOLSA X 6 UN', 'Fresco', 0.00, 2.50, 0, '2020-04-21 06:50:11'),
(19, 100109, 'AGUA ARO CAJA 20 LT', 'Ambiente', 0.00, 15.99, 0, '2020-04-21 06:50:39'),
(20, 100110, 'AGUA ARO PET S/GAS 6X2.5LT', 'Ambiente', 0.00, 10.50, 0, '2020-04-21 06:50:56');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
