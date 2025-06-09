-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-06-2020 a las 15:27:24
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `saciar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `id` int(11) NOT NULL,
  `factura` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `institucion` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `persona` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `documento` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `archivos` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`id`, `factura`, `fecha`, `institucion`, `persona`, `documento`, `archivos`, `estado`, `categoria`) VALUES
(26, '2020-5', '2020-05-14 00:00:00', '3', 'Albany', '89698798698', NULL, NULL, NULL),
(27, '2020-', '2020-05-05 22:05:04', '2', 'Ruth Rendon', '10890709890', '2020-_27_1.png;2020-_27_2.png;2020-_27_3.jpeg;', 1, 1),
(28, '2020-100', '2020-05-06 18:05:03', '2', 'Ruth Rendon', '10890709890', '2020-100_28_1.png;2020-100_28_2.png;2020-100_28_3.jpeg;', 1, 1),
(29, '2020-', '2020-05-06 19:05:06', '1', 'Ruth Rendon', '10890709890', '', 1, 1),
(30, '2020-', '2020-05-06 19:05:04', '2', 'Ruth Rendon', '10890709890', '', 1, 1),
(31, '100', '2020-05-06 00:05:00', '1', 'Ruth', '987489237', '', 1, 1),
(32, '2020-20', '2020-05-06 00:05:00', '3', 'Dario', '18979878', '20_32_1.jpeg;20_32_2.png;', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `unidad` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `categoria` varchar(10) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `lote` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `producto` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `vencimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `lote`
--
(42, 32, 60, 'kl', 'COC', '070520', 'Tomate', '2020-05-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_salida`
--

CREATE TABLE `lote_salida` (
  `id` int(11) NOT NULL,
  `id_salida` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lote_salida`
--
(49, 12, 12, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida`
--

CREATE TABLE `salida` (
  `id` int(11) NOT NULL,
  `factura` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `institucion` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `persona` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `documento` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `archivos` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `salida`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_benefactor`
--

CREATE TABLE `tipo_benefactor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `nit` varchar(30) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_benefactor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_beneficiado`
--

CREATE TABLE `tipo_beneficiado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `nit` varchar(30) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `municipio` varchar(30) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_beneficiado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_producto`
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote_salida`
--
ALTER TABLE `lote_salida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salida`
--
ALTER TABLE `salida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_benefactor`
--
ALTER TABLE `tipo_benefactor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_beneficiado`
--
ALTER TABLE `tipo_beneficiado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `lote_salida`
--
ALTER TABLE `lote_salida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `salida`
--
ALTER TABLE `salida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tipo_benefactor`
--
ALTER TABLE `tipo_benefactor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_beneficiado`
--
ALTER TABLE `tipo_beneficiado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
