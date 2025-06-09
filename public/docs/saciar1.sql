-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-05-2020 a las 16:08:16
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
(27, '2020-', '2020-05-05 22:05:04', '2', 'Ruth Rendon', '10890709890', '2020-_27_1.png;2020-_27_2.png;2020-_27_3.jpeg;', 1, 1),
(28, '2020-100', '2020-05-06 18:05:03', '2', 'Ruth Rendon', '10890709890', '2020-100_28_1.png;2020-100_28_2.png;2020-100_28_3.jpeg;', 1, 1),
(29, '2020-', '2020-05-06 19:05:06', '1', 'Ruth Rendon', '10890709890', '', 1, 1),
(30, '2020-', '2020-05-06 19:05:04', '2', 'Ruth Rendon', '10890709890', '', 1, 1),
(31, '100', '2020-05-06 00:05:00', '1', 'Ruth', '987489237', '', 1, 1),
(32, '20', '2020-05-06 00:05:00', '3', 'Dario', '18979878', '20_32_1.jpeg;20_32_2.png;', 1, 1);

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

INSERT INTO `lote` (`id`, `id_entrada`, `cantidad`, `unidad`, `categoria`, `lote`, `producto`, `vencimiento`) VALUES
(11, 27, 12, 'lt', 'ABR', '040520', 'Leche', '2020-05-20'),
(12, 27, 13, 'kg', 'LCT', '130520', 'Huevos', '2020-05-13'),
(13, 27, 20, 'kg', 'ABR', '050520', 'Mantequilla', '2020-05-06'),
(14, 27, 50, 'lt', 'ABR', '050520', 'Aceite', '2020-05-22'),
(15, 27, 22, 'kg', 'ABR', '060520', 'Almendras', '2020-05-06'),
(16, 28, 12, 'lt', 'ABR', '040520', 'Leche', '2020-05-20'),
(17, 28, 13, 'kg', 'ABR', '130520', 'Huevos', '2020-05-13'),
(18, 28, 20, 'kg', 'ABR', '050520', 'Mantequilla', '2020-05-06'),
(19, 28, 50, 'lt', 'LCT', '050520', 'Aceite', '2020-05-22'),
(20, 28, 22, 'kg', 'ABR', '060520', 'Almendras', '2020-05-06'),
(21, 29, 12, 'lt', 'LCT', '040520', 'Leche', '2020-05-20'),
(22, 29, 13, 'kg', 'LCT', '130520', 'Huevos', '2020-05-13'),
(23, 29, 20, 'kg', 'LCT', '050520', 'Mantequilla', '2020-05-06'),
(24, 29, 50, 'lt', 'ABR', '050520', 'Aceite', '2020-05-22'),
(25, 29, 22, 'kg', 'LCT', '060520', 'Almendras', '2020-05-06'),
(26, 30, 12, 'lt', 'ABR', '040520', 'Leche', '2020-05-20'),
(27, 30, 13, 'kg', 'ABR', '130520', 'Huevos', '2020-05-13'),
(28, 30, 20, 'kg', 'ABR', '050520', 'Mantequilla', '2020-05-06'),
(29, 30, 50, 'lt', 'ABR', '050520', 'Aceite', '2020-05-22'),
(30, 30, 22, 'kg', 'LCT', '060520', 'Almendras', '2020-05-06'),
(31, 31, 12, 'lt', 'ZNU', '040520', 'Leche', '2020-05-20'),
(32, 31, 13, 'kg', 'ABR', '130520', 'Huevos', '2020-05-13'),
(33, 31, 20, 'kg', 'ZNU', '050520', 'Mantequilla', '2020-05-06'),
(34, 31, 50, 'lt', 'ZNU', '050520', 'Aceite', '2020-05-22'),
(35, 31, 22, 'kg', 'ZNU', '060520', 'Almendras', '2020-05-06'),
(36, 31, 60, 'kl', 'ZNU', '070520', 'Tomate', '2020-05-15'),
(37, 32, 12, 'lt', 'COC', '040520', 'Leche', '2020-05-20'),
(38, 32, 13, 'kg', 'COC', '130520', 'Huevos', '2020-05-13'),
(39, 32, 20, 'kg', 'COC', '050520', 'Mantequilla', '2020-05-06'),
(40, 32, 50, 'lt', 'COC', '050520', 'Aceite', '2020-05-22'),
(41, 32, 22, 'kg', 'COC', '060520', 'Almendras', '2020-05-06'),
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

INSERT INTO `lote_salida` (`id`, `id_salida`, `id_lote`, `cantidad`, `categoria`) VALUES
(1, 1, 11, 2, 1),
(2, 1, 11, 3, 1),
(3, 1, 14, 4, 1),
(4, 1, 14, 3, 1);

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

INSERT INTO `tipo_benefactor` (`id`, `nombre`, `nit`, `codigo`, `creacion`) VALUES
(1, 'ZENU', '986986986', 'ZNU', '2020-05-05'),
(2, 'BIMBO', '986999080', 'BMB', '2020-05-05'),
(3, 'COCA COLA', '9812123228', 'COC', '2020-05-06');

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

INSERT INTO `tipo_beneficiado` (`id`, `nombre`, `nit`, `municipio`, `creacion`) VALUES
(1, 'guardería', '897987099', 'Rionegro', '2020-05-05'),
(2, 'Escuela', '9876798698', 'Rionegro', '2020-05-05');

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

INSERT INTO `tipo_producto` (`id`, `nombre`, `codigo`, `creacion`) VALUES
(1, 'Abarrotes', 'ABR', '2020-05-05'),
(2, 'Lacteos', 'LCT', '2020-05-05');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `salida`
--
ALTER TABLE `salida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
