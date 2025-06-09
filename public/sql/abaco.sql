-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-03-2025 a las 20:21:59
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
-- Base de datos: `saciar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `benefactor_efectivo`
--

CREATE TABLE `benefactor_efectivo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `tipo_documento` varchar(10) DEFAULT NULL,
  `documento` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `correo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `codigo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `creacion` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega`
--

CREATE TABLE `bodega` (
  `id` int(11) NOT NULL,
  `ubicacion` varchar(45) NOT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `creacion` date DEFAULT NULL,
  `id_bodegas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodegas`
--

CREATE TABLE `bodegas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega_lote`
--

CREATE TABLE `bodega_lote` (
  `id` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `creado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centrodecostos`
--

CREATE TABLE `centrodecostos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificacion`
--

CREATE TABLE `certificacion` (
  `id` int(10) NOT NULL,
  `institucion` int(10) NOT NULL,
  `tipo` int(10) NOT NULL,
  `monto` int(20) NOT NULL,
  `destinatario` varchar(50) DEFAULT NULL,
  `fecha_donacion` datetime(6) DEFAULT NULL,
  `remitente` varchar(30) DEFAULT NULL,
  `asignacion` varchar(50) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `factura` varchar(10) DEFAULT NULL,
  `expedicion_factura` datetime(6) DEFAULT NULL,
  `id_anual` varchar(10) NOT NULL,
  `anio` int(11) DEFAULT NULL,
  `expedicion` datetime(6) NOT NULL,
  `archivos` varchar(150) NOT NULL,
  `fecha_envio` datetime(6) DEFAULT NULL,
  `estado` int(5) NOT NULL,
  `categoria` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificacion_entradas`
--

CREATE TABLE `certificacion_entradas` (
  `id` int(11) NOT NULL,
  `id_certificacion` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `categoria` int(11) NOT NULL DEFAULT 1,
  `creado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificacion_historial`
--

CREATE TABLE `certificacion_historial` (
  `id` int(10) NOT NULL,
  `certificacion` int(10) NOT NULL,
  `estado` int(10) NOT NULL,
  `observacion` varchar(300) NOT NULL,
  `creado` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `banco` varchar(50) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `numero` varchar(30) NOT NULL,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `digitadores`
--

CREATE TABLE `digitadores` (
  `id` int(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cedula` int(20) NOT NULL,
  `tipo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `id` int(11) NOT NULL,
  `factura` varchar(20) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `institucion` varchar(50) DEFAULT NULL,
  `persona` varchar(50) DEFAULT NULL,
  `documento` varchar(50) DEFAULT NULL,
  `placa` varchar(10) DEFAULT NULL,
  `personaDigitado` varchar(50) DEFAULT NULL,
  `documentoDigitado` int(20) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `idCentroCostos` int(11) NOT NULL,
  `certificadoDonacion` varchar(20) DEFAULT NULL,
  `valorCertificadoDonacion` varchar(20) DEFAULT NULL,
  `bodega` int(11) DEFAULT NULL,
  `archivos` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `editado` int(10) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada2`
--

CREATE TABLE `entrada2` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `institucion` varchar(50) DEFAULT NULL,
  `persona` varchar(50) DEFAULT NULL,
  `documento` varchar(50) DEFAULT NULL,
  `archivos` varchar(100) DEFAULT NULL,
  `id_entrada` int(11) NOT NULL,
  `causa` varchar(50) DEFAULT NULL,
  `justificacion` varchar(500) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE `formulario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `correo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit_rut` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `frecuencia` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mesReportado` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipoPrograma` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `atencionVene` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidadVene` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hombresRUno` int(11) NOT NULL,
  `hombresRDos` int(11) NOT NULL,
  `hombresRTres` int(11) NOT NULL,
  `hombresRCua` int(11) NOT NULL,
  `hombresRCin` int(11) NOT NULL,
  `hombresRSeis` int(11) NOT NULL,
  `mujeresRUno` int(11) NOT NULL,
  `mujeresRDos` int(11) NOT NULL,
  `mujeresRTres` int(11) NOT NULL,
  `mujeresRCua` int(11) NOT NULL,
  `mujeresRCin` int(11) NOT NULL,
  `mujeresRSeis` int(11) NOT NULL,
  `mujeresGestantes` int(11) NOT NULL,
  `personasBeneficiadas` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `id_bodega` int(11) DEFAULT NULL,
  `individual` int(11) DEFAULT NULL,
  `individual_cantidad` decimal(11,2) DEFAULT NULL,
  `cantidad` decimal(11,2) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  `categoria` varchar(10) DEFAULT NULL,
  `lote` varchar(50) DEFAULT NULL,
  `producto` varchar(50) DEFAULT NULL,
  `valorUnitario` int(10) DEFAULT 0,
  `valorIva` int(10) DEFAULT 0,
  `vencimiento` date DEFAULT NULL,
  `estado` int(10) DEFAULT NULL,
  `estado2` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote_salida`
--

CREATE TABLE `lote_salida` (
  `id` int(11) NOT NULL,
  `id_salida` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL,
  `cantidad` decimal(11,2) NOT NULL,
  `estado` int(10) DEFAULT 0,
  `estado2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `placas`
--

CREATE TABLE `placas` (
  `id` int(11) NOT NULL,
  `placa` varchar(50) NOT NULL,
  `creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibido`
--

CREATE TABLE `recibido` (
  `id` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `tipo` int(2) NOT NULL,
  `creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida`
--

CREATE TABLE `salida` (
  `id` int(11) NOT NULL,
  `factura` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `institucion` varchar(50) DEFAULT NULL,
  `persona` varchar(50) DEFAULT NULL,
  `documento` varchar(50) DEFAULT NULL,
  `archivos` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `estado2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida2`
--

CREATE TABLE `salida2` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `institucion` varchar(50) DEFAULT NULL,
  `persona` varchar(50) DEFAULT NULL,
  `documento` varchar(50) DEFAULT NULL,
  `archivos` varchar(100) DEFAULT NULL,
  `id_salida` int(11) NOT NULL,
  `causa` varchar(50) DEFAULT NULL,
  `justificacion` varchar(500) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_benefactor`
--

CREATE TABLE `tipo_benefactor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `nit` varchar(30) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_beneficiado`
--

CREATE TABLE `tipo_beneficiado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `nit` varchar(30) DEFAULT NULL,
  `municipio` varchar(30) DEFAULT NULL,
  `poblacion` varchar(50) DEFAULT NULL,
  `creacion` date DEFAULT NULL,
  `idZona` int(11) DEFAULT NULL,
  `nombreLaborSocial` varchar(255) DEFAULT NULL,
  `dv` varchar(50) DEFAULT NULL,
  `contactoInstitucional` varchar(255) DEFAULT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `departamento` varchar(255) DEFAULT NULL,
  `subRegion` varchar(255) DEFAULT NULL,
  `comuna` varchar(255) DEFAULT NULL,
  `barrio` varchar(255) DEFAULT NULL,
  `zonaUrbanaORural` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `recomienda` varchar(255) DEFAULT NULL,
  `protocoloBio` varchar(255) DEFAULT NULL,
  `fechaEntrega` varchar(255) DEFAULT NULL,
  `frecuenciaDonacion` varchar(255) DEFAULT NULL,
  `diaDonacion` varchar(255) DEFAULT NULL,
  `semanaDonacion` varchar(255) DEFAULT NULL,
  `frecuenciaServicioC` varchar(255) DEFAULT NULL,
  `diaServicioC` varchar(255) DEFAULT NULL,
  `semanaServicioC` varchar(255) DEFAULT NULL,
  `jornadaServicioC` varchar(255) DEFAULT NULL,
  `adultoMayor` varchar(255) DEFAULT NULL,
  `proteccionNin` varchar(10) DEFAULT NULL,
  `proteccionNinias` varchar(10) DEFAULT NULL,
  `proteccionNinios` varchar(10) DEFAULT NULL,
  `hogarDePaso` varchar(10) DEFAULT NULL,
  `comedor` varchar(10) DEFAULT NULL,
  `comunidadReligiosaOLaicos` varchar(10) DEFAULT NULL,
  `SeminaristasOreligiosos` varchar(10) DEFAULT NULL,
  `familiasVulnerables` varchar(10) DEFAULT NULL,
  `capacitacionFormacion` varchar(10) DEFAULT NULL,
  `arteCultura` varchar(10) DEFAULT NULL,
  `deporte` varchar(10) DEFAULT NULL,
  `EnfermosYDesvalidos` varchar(10) DEFAULT NULL,
  `educacion` varchar(10) DEFAULT NULL,
  `nutricion` varchar(10) DEFAULT NULL,
  `legal` varchar(10) DEFAULT NULL,
  `espiritual` varchar(10) DEFAULT NULL,
  `salud` varchar(10) DEFAULT NULL,
  `recreacion` varchar(10) DEFAULT NULL,
  `vivienda` varchar(10) DEFAULT NULL,
  `artes` varchar(10) DEFAULT NULL,
  `artesaniasYManualidades` varchar(10) DEFAULT NULL,
  `biblioteca` varchar(10) DEFAULT NULL,
  `computadores` varchar(10) DEFAULT NULL,
  `costuraYCofeccion` varchar(10) DEFAULT NULL,
  `consutorioYDispensario` varchar(10) DEFAULT NULL,
  `culinariaYPanaderia` varchar(10) DEFAULT NULL,
  `ludoteca` varchar(10) DEFAULT NULL,
  `musica` varchar(10) DEFAULT NULL,
  `pintura` varchar(10) DEFAULT NULL,
  `peluqueriaYBelleza` varchar(10) DEFAULT NULL,
  `ventasDeRopero` varchar(10) DEFAULT NULL,
  `otros` varchar(255) DEFAULT NULL,
  `cuales` varchar(255) DEFAULT NULL,
  `aniosUltimaVisita` varchar(10) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `contrasena` varchar(30) NOT NULL,
  `tipo` int(11) NOT NULL,
  `categoria` int(11) DEFAULT NULL,
  `creacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `correo`, `usuario`, `contrasena`, `tipo`, `categoria`, `creacion`) VALUES
(1, 'DIEGO', 'PULIDO', 'administracion@saciar.org.co', 'Admin', 'Saciar2024**', 1, 0, '2020-08-27'),
(2, 'MANUELA', 'ARENAS', 'lideradministracion@saciar.org', 'Tesoreria', 'Mart2405m', 101, 0, '2024-06-03'),
(3, 'PAOLA', 'RODRIGUEZ', 'paolagutierrez@saciar.org.co', 'Mercadeo', 'MERCADE054C14R', 102, 0, '2024-06-03'),
(4, 'NATAHALY ', 'RODRIGUEZ', 'lidercontable@saciar.org.co', 'Contabilidad', '54c14rContable2024', 103, 0, '2024-06-03'),
(5, 'GYC', 'GERENCIAYCONTROL', 'laura.blandon@gerenciaycontrol.com.co', 'Revisoria', 'Geyco*', 104, 0, '2024-06-03'),
(6, 'entradas', 'entradas', 'entradas@gmail.com', 'entradas', 'Saciar.2024', 2, 1, '0000-00-00'),
(7, 'salidas', 'salidas', 'salidas@gmail.com', 'salidas', 'Saciar_2024', 3, 1, '0000-00-00'),
(8, 'YEISON', 'BARRIOS', 'cuartosfrios@saciar.org.co', 'cuartosfrios', 'fr1052024', 3, 0, '0000-00-00'),
(9, 'DEINER', 'SEPULVEDA', 'alistamiento@saciar.org.co', 'alistamiento', '54c14r2024+', 3, 0, '0000-00-00'),
(10, 'ELBER', 'MORALES', 'fruver@saciar.org.co', 'fruver', 'fruv3r2024*', 3, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(11) NOT NULL,
  `zona` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `benefactor_efectivo`
--
ALTER TABLE `benefactor_efectivo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bodega`
--
ALTER TABLE `bodega`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bodega_lote`
--
ALTER TABLE `bodega_lote`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `centrodecostos`
--
ALTER TABLE `centrodecostos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `certificacion`
--
ALTER TABLE `certificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `certificacion_entradas`
--
ALTER TABLE `certificacion_entradas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `certificacion_historial`
--
ALTER TABLE `certificacion_historial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`);

--
-- Indices de la tabla `digitadores`
--
ALTER TABLE `digitadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrada2`
--
ALTER TABLE `entrada2`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formulario`
--
ALTER TABLE `formulario`
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
-- Indices de la tabla `placas`
--
ALTER TABLE `placas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recibido`
--
ALTER TABLE `recibido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salida`
--
ALTER TABLE `salida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salida2`
--
ALTER TABLE `salida2`
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
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `benefactor_efectivo`
--
ALTER TABLE `benefactor_efectivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bodega`
--
ALTER TABLE `bodega`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bodega_lote`
--
ALTER TABLE `bodega_lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `certificacion`
--
ALTER TABLE `certificacion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `certificacion_entradas`
--
ALTER TABLE `certificacion_entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `certificacion_historial`
--
ALTER TABLE `certificacion_historial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `digitadores`
--
ALTER TABLE `digitadores`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrada2`
--
ALTER TABLE `entrada2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formulario`
--
ALTER TABLE `formulario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote_salida`
--
ALTER TABLE `lote_salida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `placas`
--
ALTER TABLE `placas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recibido`
--
ALTER TABLE `recibido`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salida`
--
ALTER TABLE `salida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salida2`
--
ALTER TABLE `salida2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_benefactor`
--
ALTER TABLE `tipo_benefactor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_beneficiado`
--
ALTER TABLE `tipo_beneficiado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
