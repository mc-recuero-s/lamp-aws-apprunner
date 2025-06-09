CREATE TABLE `banco` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `colores` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`colores`)),
  `estilos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`estilos`)),
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `por` bigint(20) NOT NULL DEFAULT 0
) ;

--
-- Volcado de datos para la tabla `banco`
--

INSERT INTO `banco` (`id`, `nombre`, `logo`, `colores`, `estilos`, `creado`, `por`) VALUES
(1, 'Saciar', 'bank_681e8573c38ef.png', '{\"primario\":\"#264030\",\"secundario\":\"#8ca94d\",\"iconos\":\"#8c8c8c\",\"fondos\":\"#ffffff\",\"texto\":\"#999999\"}', '\"\\\"\\\\\\\"\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\\"\\\\\\\"\\\"\"', '2025-05-07 11:06:42', 0),
(2, 'Banco 1', 'bank_681e8252a9443.png', '{\"primario\":\"#cc0000\",\"secundario\":\"#fbb1b1\",\"iconos\":\"#ffffff\",\"fondos\":\"#fbc1c1\",\"texto\":\"#000000\"}', '\"\"', '2025-05-09 17:31:46', 0),
(3, 'Banco 2', 'bank_681e827f59a25.png', '{\"primario\":\"#ffb54d\",\"secundario\":\"#0431b9\",\"iconos\":\"#eed744\",\"fondos\":\"#8a8a8a\",\"texto\":\"#ffffff\"}', '\"\"', '2025-05-09 17:32:31', 0),
(4, 'Banco 3', 'bank_681e82ac700a6.png', '{\"primario\":\"#ffda24\",\"secundario\":\"#904e18\",\"iconos\":\"#000000\",\"fondos\":\"#b0b0b0\",\"texto\":\"#000000\"}', '\"\"', '2025-05-09 17:33:16', 0),
(5, 'Banco 4', 'bank_681e82c9147c3.png', '{\"primario\":\"#fc38ff\",\"secundario\":\"#ee70ff\",\"iconos\":\"#a88f8f\",\"fondos\":\"#ffffff\",\"texto\":\"#7d7d7d\"}', '\"\"', '2025-05-09 17:33:45', 0),
(6, 'Banco 5', 'bank_681e82ed880a9.png', '{\"primario\":\"#9f4a04\",\"secundario\":\"#ffd747\",\"iconos\":\"#000000\",\"fondos\":\"#bfad4f\",\"texto\":\"#ffffff\"}', '\"\"', '2025-05-09 17:34:21', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `benefactor`
--

CREATE TABLE `benefactor` (
  `id` int(11) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `proveedor` varchar(100) DEFAULT NULL,
  `sector_publico` tinyint(1) NOT NULL DEFAULT 0,
  `sector_economico` tinyint(1) NOT NULL DEFAULT 0,
  `tipo_institucion` varchar(50) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `banco` bigint(20) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `por` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `benefactor`
--

INSERT INTO `benefactor` (`id`, `tipo_documento`, `documento`, `nombre`, `proveedor`, `sector_publico`, `sector_economico`, `tipo_institucion`, `municipio`, `banco`, `creado`, `por`) VALUES
(1, 'CC', '23432', '3243', 'sdfdsf', 1, 0, '32432', '16', 1, '2025-05-27 14:30:19', 1),
(4, 'CC', '1212424', 'Benefactor 1', 'Benefactor 1', 1, 0, 'publica', '1083', 0, '2025-06-04 07:27:25', 1),
(5, 'CC', '34324324', 'Benefactor Banco 2', 'dfdsfds', 1, 1, 'dsfsdfds', '9', 3, '2025-06-04 13:54:45', 1);

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
-- Estructura de tabla para la tabla `benefactor_sede`
--

CREATE TABLE `benefactor_sede` (
  `id` int(11) NOT NULL,
  `nit` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `benefactor_id` int(11) NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `por` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `benefactor_sede`
--

INSERT INTO `benefactor_sede` (`id`, `nit`, `nombre`, `codigo`, `municipio`, `benefactor_id`, `creado`, `por`) VALUES
(4, '24234423', 'dsfsdfds', 'ASWD', '20', 1, '2025-06-01 16:27:19', 1),
(5, '34324', 'ffsfdsd', 'QWR', '20', 1, '2025-06-01 16:27:27', 1),
(6, '1242432432', 'Sede 1', 'ACD', '200', 4, '2025-06-04 12:16:04', 1),
(7, '324324', 'rerewrew', '324324', '206', 4, '2025-06-04 13:34:39', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiario`
--

CREATE TABLE `beneficiario` (
  `id` int(11) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `proveedor` varchar(100) DEFAULT NULL,
  `sector_publico` tinyint(1) NOT NULL DEFAULT 0,
  `sector_economico` tinyint(1) NOT NULL DEFAULT 0,
  `tipo_institucion` varchar(50) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `banco` bigint(20) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `por` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `beneficiario`
--

INSERT INTO `beneficiario` (`id`, `tipo_documento`, `documento`, `nombre`, `proveedor`, `sector_publico`, `sector_economico`, `tipo_institucion`, `municipio`, `banco`, `creado`, `por`) VALUES
(1, 'CC', '123213', '21dsfsdfs', '32432', 1, 1, '0', '205', 0, '2025-05-27 15:04:23', 1),
(2, 'NIT', '234234324', 'Beneficiario Saciar ', 'fdsfsdf', 1, 0, '0', '9', 0, '2025-06-04 13:55:53', 1),
(3, 'CC', '234324', 'Beneficiario Saciar', 'dsfdsf', 1, 0, '2332432', '128', 0, '2025-06-04 14:00:57', 1),
(4, 'CC', '2332', 'dsfsdf', 'sdfdsf', 1, 0, '0', '1081', 1, '2025-06-04 14:01:26', 1),
(5, 'CC', '23423', 'fdsfdsf', 'sdfdsf', 1, 0, '0', '1082', 1, '2025-06-04 14:03:43', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiario_sede`
--

CREATE TABLE `beneficiario_sede` (
  `id` int(11) NOT NULL,
  `nit` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `beneficiario_id` int(11) NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `por` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `beneficiario_sede`
--

INSERT INTO `beneficiario_sede` (`id`, `nit`, `nombre`, `municipio`, `beneficiario_id`, `creado`, `por`) VALUES
(4, '32423432', 'llkliu', '1126', 1, '2025-06-04 13:35:03', 1),
(5, '3423432', 'jhgjghj', '200', 1, '2025-06-04 13:48:16', 1),
(6, '343432', 'dfsfsdf', '6', 1, '2025-06-04 13:52:46', 1);

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

--
-- Volcado de datos para la tabla `bodega`
--

INSERT INTO `bodega` (`id`, `ubicacion`, `capacidad`, `estado`, `creacion`, `id_bodegas`) VALUES
(1, 'A1', NULL, NULL, '2025-04-01', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodegas`
--

CREATE TABLE `bodegas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `banco` bigint(20) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `por` bigint(20) NOT NULL DEFAULT 0
) ;

--
-- Volcado de datos para la tabla `bodegas`
--

INSERT INTO `bodegas` (`id`, `nombre`, `codigo`, `banco`, `creado`, `por`) VALUES
(1, 'Rionegro', '05', 1, '2025-05-07 11:08:38', 0),
(2, 'Bodega 1', 'bodega_1', 2, '2025-05-10 06:47:50', 0),
(3, 'Bodega 2', 'bodega_2', 3, '2025-05-10 06:48:02', 0);

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
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp(),
  `por` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `codigo`, `descripcion`, `creado`, `por`) VALUES
(1, 'Abarrotes', '01', 'Productos de abarrotes en general', '2025-06-03 02:39:12', 0),
(2, '02', '02', '', '2025-06-04 19:22:40', 0),
(3, '03', '03', '', '2025-06-04 19:22:40', 0),
(4, '04', '04', '', '2025-06-04 19:22:40', 0),
(5, '05', '05', '', '2025-06-04 19:22:40', 0),
(6, '06', '06', '', '2025-06-04 19:22:40', 0),
(7, '07', '07', '', '2025-06-04 19:22:40', 0),
(8, '08', '08', '', '2025-06-04 19:22:40', 0),
(9, '09', '09', '', '2025-06-04 19:22:40', 0),
(10, '10', '10', '', '2025-06-04 19:22:40', 0),
(11, '11', '11', '', '2025-06-04 19:22:40', 0),
(12, '12', '12', '', '2025-06-04 19:22:40', 0),
(13, '13', '13', '', '2025-06-04 19:22:40', 0),
(14, '14', '14', '', '2025-06-04 19:22:40', 0),
(15, '15', '15', '', '2025-06-04 19:22:40', 0),
(16, '16', '16', '', '2025-06-04 19:22:40', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorizacion`
--

CREATE TABLE `categorizacion` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `version` bigint(20) NOT NULL,
  `actual` tinyint(1) DEFAULT 0,
  `creado` datetime DEFAULT current_timestamp(),
  `por` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `categorizacion`
--

INSERT INTO `categorizacion` (`id`, `nombre`, `version`, `actual`, `creado`, `por`) VALUES
(3, 'Categorizacion 1', 1, 1, '2025-05-20 15:00:28', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorizacion_item`
--

CREATE TABLE `categorizacion_item` (
  `id` bigint(20) NOT NULL,
  `codigo` bigint(20) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `order` bigint(20) NOT NULL,
  `categorizacion` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `categorizacion_item`
--

INSERT INTO `categorizacion_item` (`id`, `codigo`, `tipo`, `order`, `categorizacion`) VALUES
(13, 13, 'fecha', 2, 3),
(14, 14, 'codigo_subcategoria', 3, 3),
(15, 15, 'codigo_benefactor', 4, 3),
(16, 16, 'codigo_categoria', 1, 3),
(17, 17, 'hgjhk', 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centrodecostos`
--

CREATE TABLE `centrodecostos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `centrodecostos`
--

INSERT INTO `centrodecostos` (`id`, `nombre`) VALUES
(0, 'Centro 1'),
(1, 'Centro 1');

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
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `codigo`, `nombre`) VALUES
(1, '05', 'ANTIOQUIA'),
(2, '08', 'ATLÁNTICO'),
(3, '11', 'BOGOTÁ, D.C.'),
(4, '13', 'BOLÍVAR'),
(5, '15', 'BOYACÁ'),
(6, '17', 'CALDAS'),
(7, '18', 'CAQUETÁ'),
(8, '19', 'CAUCA'),
(9, '20', 'CESAR'),
(10, '23', 'CÓRDOBA'),
(11, '25', 'CUNDINAMARCA'),
(12, '27', 'CHOCÓ'),
(13, '41', 'HUILA'),
(14, '44', 'LA GUAJIRA'),
(15, '47', 'MAGDALENA'),
(16, '50', 'META'),
(17, '52', 'NARIÑO'),
(18, '54', 'NORTE DE SANTANDER'),
(19, '63', 'QUINDÍO'),
(20, '66', 'RISARALDA'),
(21, '68', 'SANTANDER'),
(22, '70', 'SUCRE'),
(23, '73', 'TOLIMA'),
(24, '76', 'VALLE DEL CAUCA'),
(25, '81', 'ARAUCA'),
(26, '85', 'CASANARE'),
(27, '86', 'PUTUMAYO'),
(28, '88', 'ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA'),
(29, '91', 'AMAZONAS'),
(30, '94', 'GUAINÍA'),
(31, '95', 'GUAVIARE'),
(32, '97', 'VAUPÉS'),
(33, '99', 'VICHADA');

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

--
-- Volcado de datos para la tabla `digitadores`
--

INSERT INTO `digitadores` (`id`, `nombre`, `cedula`, `tipo`) VALUES
(1, 'Digitalizador 1', 123213213, 0);

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
-- Estructura de tabla para la tabla `funcionalidad`
--

CREATE TABLE `funcionalidad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `abreviatura` varchar(255) NOT NULL,
  `elemento` varchar(255) NOT NULL,
  `ver` tinyint(1) NOT NULL,
  `editar` tinyint(1) NOT NULL,
  `eliminar` tinyint(1) NOT NULL,
  `modulo` bigint(20) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL,
  `por` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `funcionalidad`
--

INSERT INTO `funcionalidad` (`id`, `nombre`, `abreviatura`, `elemento`, `ver`, `editar`, `eliminar`, `modulo`, `creado`, `por`) VALUES
(10, 'Archivo', 'archivo', 'archivo', 1, 0, 0, 14, '0000-00-00 00:00:00', 0);

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
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `abreviatura` varchar(255) NOT NULL,
  `elemento` varchar(255) NOT NULL,
  `modulo` int(11) DEFAULT NULL,
  `creado` datetime NOT NULL,
  `por` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id`, `nombre`, `abreviatura`, `elemento`, `modulo`, `creado`, `por`) VALUES
(4, 'Crear Salida', 'crearSalida', 'crearSalida', 2, '0000-00-00 00:00:00', 0),
(5, 'Seguridad', 'seguridad', 'seguridad', NULL, '0000-00-00 00:00:00', 0),
(6, 'Usuario', 'usuario', 'usuario', 5, '2025-05-03 08:20:07', 0),
(8, 'Pefil', 'perfil', 'perfil', 5, '2025-05-03 09:29:02', 0),
(9, 'Rol', 'rol', 'rol', 5, '2025-05-03 09:37:48', 0),
(10, 'Modulo', 'modulo', 'modulo', 5, '2025-05-03 09:39:08', 0),
(11, 'Submodulo', 'submodulo', 'submodulo', 5, '2025-05-03 09:39:34', 0),
(12, 'Funcionalidad', 'funcionalidad', 'funcionalidad', 5, '2025-05-03 09:40:00', 0),
(13, 'Entradas', 'entradas', 'entradas', NULL, '0000-00-00 00:00:00', 0),
(14, 'Crear Entrada', 'crear_entrada', 'crear_entrada', 13, '2025-05-03 12:52:32', 0),
(15, 'Salidas', 'salidas', 'salidas', NULL, '0000-00-00 00:00:00', 0),
(16, 'Crear Salida', 'crear_salida', 'crear_salida', 15, '2025-05-03 13:22:43', 0),
(17, 'Historial Entradas', 'historial_entradas', 'historial_entradas', 13, '2025-05-03 15:56:48', 0),
(18, 'Historial Salidas', 'historial_salidas', 'historial_salidas', 15, '2025-05-04 13:53:05', 0),
(19, 'Inicio', 'inicio', 'inicio', NULL, '0000-00-00 00:00:00', 0),
(20, 'Dashboard', 'dashboard', 'dashboard', 19, '2025-05-05 06:48:55', 0),
(21, 'Configuración', 'configuracion', 'configuracion', NULL, '0000-00-00 00:00:00', 0),
(22, 'Benefactores', 'benefactores', 'benefactores', 21, '2025-05-05 07:36:36', 0),
(23, 'Beneficiarios', 'beneficiarios', 'beneficiarios', 21, '2025-05-05 07:37:04', 0),
(24, 'Datos', 'datos', 'datos', 21, '2025-05-05 07:37:26', 0),
(25, 'Bancos', 'bancos', 'bancos', NULL, '0000-00-00 00:00:00', 0),
(26, 'Banco', 'banco', 'banco', 25, '2025-05-06 10:48:40', 0),
(27, 'Bodega', 'bodega', 'bodega', 25, '2025-05-06 10:48:53', 0),
(28, 'Productos', 'productos', 'productos', 21, '2025-05-27 12:02:58', 0),
(29, 'Categorias', 'categorias', 'cat', 21, '2025-06-02 21:36:52', 0),
(30, 'Subcategorias', 'subcategorias', 'subcategorias', 21, '2025-06-03 06:51:50', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `departamento` int(10) UNSIGNED NOT NULL,
  `lon` decimal(10,7) DEFAULT NULL,
  `lat` decimal(10,7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id`, `codigo`, `nombre`, `departamento`, `lon`, `lat`) VALUES
(1, '05001', 'MEDELLÍN', 1, -75.5817750, 6.2466310),
(2, '05002', 'ABEJORRAL', 1, -75.4287390, 5.7893150),
(3, '05003', 'ABRIAQUÍ', 1, -76.0643040, 6.6322820),
(4, '05004', 'ALEJANDRÍA', 1, -75.1413460, 6.3760610),
(5, '05005', 'AMAGÁ', 1, -75.7021880, 6.0387080),
(6, '05006', 'AMALFI', 1, -75.0775010, 6.9096550),
(7, '05007', 'ANDES', 1, -75.8788280, 5.6571940),
(8, '05008', 'ANGELÓPOLIS', 1, -75.7113890, 6.1097190),
(9, '05009', 'ANGOSTURA', 1, -75.3351160, 6.8851750),
(10, '05010', 'ANORÍ', 1, -75.1483550, 7.0747030),
(11, '05011', 'SANTA FÉ DE ANTIOQUIA', 1, -75.8266480, 6.5564840),
(12, '05012', 'ANZÁ', 1, -75.8544420, 6.3026410),
(13, '05013', 'APARTADÓ', 1, -76.6252790, 7.8829680),
(14, '05014', 'ARBOLETES', 1, -76.4267080, 8.8493170),
(15, '05015', 'ARGELIA', 1, -75.1410700, 5.7314740),
(16, '05016', 'ARMENIA', 1, -75.7866470, 6.1556670),
(17, '05017', 'BARBOSA', 1, -75.3316270, 6.4391950),
(18, '05018', 'BELMIRA', 1, -75.6677790, 6.6063190),
(19, '05019', 'BELLO', 1, -75.5552450, 6.3335870),
(20, '05020', 'BETANIA', 1, -75.9767900, 5.7461500),
(21, '05021', 'BETULIA', 1, -75.9844520, 6.1152080),
(22, '05022', 'CIUDAD BOLÍVAR', 1, -76.0215090, 5.8502730),
(23, '05023', 'BRICEÑO', 1, -75.5503600, 7.1128030),
(24, '05024', 'BURITICÁ', 1, -75.9070000, 6.7207590),
(25, '05025', 'CÁCERES', 1, -75.3520500, 7.5783660),
(26, '05026', 'CAICEDO', 1, -75.9829300, 6.4056070),
(27, '05027', 'CALDAS', 1, -75.6336730, 6.0910770),
(28, '05028', 'CAMPAMENTO', 1, -75.2980910, 6.9797710),
(29, '05029', 'CAÑASGORDAS', 1, -76.0282280, 6.7538590),
(30, '05030', 'CARACOLÍ', 1, -74.7574210, 6.4098290),
(31, '05031', 'CARAMANTA', 1, -75.6438680, 5.5485300),
(32, '05032', 'CAREPA', 1, -76.6526520, 7.7551480),
(33, '05033', 'EL CARMEN DE VIBORAL', 1, -75.3339010, 6.0828850),
(34, '05034', 'CAROLINA', 1, -75.2831920, 6.7259950),
(35, '05035', 'CAUCASIA', 1, -75.1979960, 7.9772780),
(36, '05036', 'CHIGORODÓ', 1, -76.6815310, 7.6661470),
(37, '05037', 'CISNEROS', 1, -75.0870470, 6.5378290),
(38, '05038', 'COCORNÁ', 1, -75.1854830, 6.0582950),
(39, '05039', 'CONCEPCIÓN', 1, -75.2575870, 6.3943480),
(40, '05040', 'CONCORDIA', 1, -75.9084480, 6.0457380),
(41, '05041', 'COPACABANA', 1, -75.5093840, 6.3485570),
(42, '05042', 'DABEIBA', 1, -76.2616140, 6.9981120),
(43, '05043', 'DONMATÍAS', 1, -75.3926300, 6.4856030),
(44, '05044', 'EBÉJICO', 1, -75.7664130, 6.3256150),
(45, '05045', 'EL BAGRE', 1, -74.7990970, 7.5975000),
(46, '05046', 'ENTRERRÍOS', 1, -75.5176850, 6.5662730),
(47, '05047', 'ENVIGADO', 1, -75.5821920, 6.1666950),
(48, '05048', 'FREDONIA', 1, -75.6750720, 5.9280390),
(49, '05049', 'FRONTINO', 1, -76.1307650, 6.7760660),
(50, '05050', 'GIRALDO', 1, -75.9521580, 6.6808080),
(51, '05051', 'GIRARDOTA', 1, -75.4442380, 6.3794720),
(52, '05052', 'GÓMEZ PLATA', 1, -75.2200180, 6.6832690),
(53, '05053', 'GRANADA', 1, -75.1844460, 6.1428920),
(54, '05054', 'GUADALUPE', 1, -75.2398620, 6.8150690),
(55, '05055', 'GUARNE', 1, -75.4416120, 6.2778700),
(56, '05056', 'GUATAPÉ', 1, -75.1600410, 6.2324610),
(57, '05057', 'HELICONIA', 1, -75.7343220, 6.2067570),
(58, '05058', 'HISPANIA', 1, -75.9065870, 5.7994610),
(59, '05059', 'ITAGÜÍ', 1, -75.6120560, 6.1750790),
(60, '05060', 'ITUANGO', 1, -75.7646730, 7.1716290),
(61, '05061', 'JARDÍN', 1, -75.8189820, 5.5975420),
(62, '05062', 'JERICÓ', 1, -75.7854990, 5.7897480),
(63, '05063', 'LA CEJA', 1, -75.4294330, 6.0280620),
(64, '05064', 'LA ESTRELLA', 1, -75.6377080, 6.1452380),
(65, '05065', 'LA PINTADA', 1, -75.6078100, 5.7438080),
(66, '05066', 'LA UNIÓN', 1, -75.3608740, 5.9738450),
(67, '05067', 'LIBORINA', 1, -75.8128380, 6.6773160),
(68, '05068', 'MACEO', 1, -74.7871600, 6.5521160),
(69, '05069', 'MARINILLA', 1, -75.3393450, 6.1739950),
(70, '05070', 'MONTEBELLO', 1, -75.5234550, 5.9463130),
(71, '05071', 'MURINDÓ', 1, -76.8174850, 6.9777100),
(72, '05072', 'MUTATÁ', 1, -76.4358750, 7.2428750),
(73, '05073', 'NARIÑO', 1, -75.1762620, 5.6107770),
(74, '05074', 'NECOCLÍ', 1, -76.7872710, 8.4345260),
(75, '05075', 'NECHÍ', 1, -74.7764700, 8.0941290),
(76, '05076', 'OLAYA', 1, -75.8117730, 6.6264920),
(77, '05077', 'PEÑOL', 1, -75.2426930, 6.2193490),
(78, '05078', 'PEQUE', 1, -75.9103570, 7.0210290),
(79, '05079', 'PUEBLORRICO', 1, -75.8399030, 5.7915800),
(80, '05080', 'PUERTO BERRÍO', 1, -74.4100160, 6.4870280),
(81, '05081', 'PUERTO NARE', 1, -74.5830120, 6.1860250),
(82, '05082', 'PUERTO TRIUNFO', 1, -74.6411900, 5.8713180),
(83, '05083', 'REMEDIOS', 1, -74.6981350, 7.0294240),
(84, '05084', 'RETIRO', 1, -75.5013010, 6.0624540),
(85, '05085', 'RIONEGRO', 1, -75.3773160, 6.1471480),
(86, '05086', 'SABANALARGA', 1, -75.8166450, 6.8500280),
(87, '05087', 'SABANETA', 1, -75.6154790, 6.1499030),
(88, '05088', 'SALGAR', 1, -75.9768070, 5.9641980),
(89, '05089', 'SAN ANDRÉS DE CUERQUÍA', 1, -75.6745640, 6.9166760),
(90, '05090', 'SAN CARLOS', 1, -74.9880970, 6.1877460),
(91, '05091', 'SAN FRANCISCO', 1, -75.1015620, 5.9634760),
(92, '05092', 'SAN JERÓNIMO', 1, -75.7269750, 6.4480900),
(93, '05093', 'SAN JOSÉ DE LA MONTAÑA', 1, -75.6833520, 6.8500900),
(94, '05094', 'SAN JUAN DE URABÁ', 1, -76.5285700, 8.7589640),
(95, '05095', 'SAN LUIS', 1, -74.9936190, 6.0430170),
(96, '05096', 'SAN PEDRO DE LOS MILAGROS', 1, -75.5567430, 6.4601200),
(97, '05097', 'SAN PEDRO DE URABÁ', 1, -76.3805670, 8.2768840),
(98, '05098', 'SAN RAFAEL', 1, -75.0284900, 6.2937590),
(99, '05099', 'SAN ROQUE', 1, -75.0191090, 6.4859390),
(100, '05100', 'SAN VICENTE FERRER', 1, -75.3326160, 6.2821640),
(101, '05101', 'SANTA BÁRBARA', 1, -75.5673510, 5.8755270),
(102, '05102', 'SANTA ROSA DE OSOS', 1, -75.4607230, 6.6433660),
(103, '05103', 'SANTO DOMINGO', 1, -75.1649030, 6.4730320),
(104, '05104', 'SANTUARIO', 1, -75.2654650, 6.1368710),
(105, '05105', 'SEGOVIA', 1, -74.7015960, 7.0796480),
(106, '05106', 'SONSÓN', 1, -75.3095960, 5.7148510),
(107, '05107', 'SOPETRÁN', 1, -75.7473780, 6.5007450),
(108, '05108', 'TÁMESIS', 1, -75.7144290, 5.6646450),
(109, '05109', 'TARAZÁ', 1, -75.4014070, 7.5801270),
(110, '05110', 'TARSO', 1, -75.8229560, 5.8645420),
(111, '05111', 'TITIRIBÍ', 1, -75.7918870, 6.0623910),
(112, '05112', 'TOLEDO', 1, -75.6922810, 7.0103280),
(113, '05113', 'TURBO', 1, -76.7288580, 8.0899290),
(114, '05114', 'URAMITA', 1, -76.1732840, 6.8983930),
(115, '05115', 'URRAO', 1, -76.1339510, 6.3173430),
(116, '05116', 'VALDIVIA', 1, -75.4392740, 7.1652000),
(117, '05117', 'VALPARAÍSO', 1, -75.6244520, 5.6145550),
(118, '05118', 'VEGACHÍ', 1, -74.7987140, 6.7735250),
(119, '05119', 'VENECIA', 1, -75.7355440, 5.9646930),
(120, '05120', 'VIGÍA DEL FUERTE', 1, -76.8960040, 6.5881640),
(121, '05121', 'YALÍ', 1, -74.8400590, 6.6765540),
(122, '05122', 'YARUMAL', 1, -75.4188280, 6.9638320),
(123, '05123', 'YOLOMBÓ', 1, -75.0133850, 6.5945110),
(124, '05124', 'YONDÓ', 1, -73.9124450, 7.0039600),
(125, '05125', 'ZARAGOZA', 1, -74.8670750, 7.4885830),
(126, '08001', 'BARRANQUILLA', 2, -74.8155460, 10.9779610),
(127, '08002', 'BARANOA', 2, -74.9160770, 10.7944500),
(128, '08003', 'CAMPO DE LA CRUZ', 2, -74.8808470, 10.3782910),
(129, '08004', 'CANDELARIA', 2, -74.8797170, 10.4619030),
(130, '08005', 'GALAPA', 2, -74.8703850, 10.9190330),
(131, '08006', 'JUAN DE ACOSTA', 2, -75.0410320, 10.8325400),
(132, '08007', 'LURUACO', 2, -75.1419900, 10.6104910),
(133, '08008', 'MALAMBO', 2, -74.7769230, 10.8570860),
(134, '08009', 'MANATÍ', 2, -74.9568670, 10.4490890),
(135, '08010', 'PALMAR DE VARELA', 2, -74.7547650, 10.7385910),
(136, '08011', 'PIOJÓ', 2, -75.1075920, 10.7492160),
(137, '08012', 'POLONUEVO', 2, -74.8529810, 10.7773630),
(138, '08013', 'PONEDERA', 2, -74.7538850, 10.6417790),
(139, '08014', 'PUERTO COLOMBIA', 2, -74.8886270, 11.0153220),
(140, '08015', 'REPELÓN', 2, -75.1255340, 10.4933570),
(141, '08016', 'SABANAGRANDE', 2, -74.7594960, 10.7924530),
(142, '08017', 'SABANALARGA', 2, -74.9212560, 10.6320910),
(143, '08018', 'SANTA LUCÍA', 2, -74.9592040, 10.3243030),
(144, '08019', 'SANTO TOMÁS', 2, -74.7578590, 10.7587350),
(145, '08020', 'SOLEDAD', 2, -74.7860540, 10.9099210),
(146, '08021', 'SUAN', 2, -74.8816870, 10.3354320),
(147, '08022', 'TUBARÁ', 2, -74.9787040, 10.8735860),
(148, '08023', 'USIACURÍ', 2, -74.9769850, 10.7429800),
(149, '11001', 'BOGOTÁ, D.C.', 3, -74.1069920, 4.6492510),
(150, '13001', 'CARTAGENA DE INDIAS', 4, -75.4962690, 10.3851260),
(151, '13002', 'ACHÍ', 4, -74.5576760, 8.5701070),
(152, '13003', 'ALTOS DEL ROSARIO', 4, -74.1649050, 8.7918650),
(153, '13004', 'ARENAL', 4, -73.9410990, 8.4588650),
(154, '13005', 'ARJONA', 4, -75.3443320, 10.2566600),
(155, '13006', 'ARROYOHONDO', 4, -75.0192150, 10.2500750),
(156, '13007', 'BARRANCO DE LOBA', 4, -74.1043910, 8.9477870),
(157, '13008', 'CALAMAR', 4, -74.9161440, 10.2504310),
(158, '13009', 'CANTAGALLO', 4, -73.9146050, 7.3786780),
(159, '13010', 'CICUCO', 4, -74.6459810, 9.2742810),
(160, '13011', 'CÓRDOBA', 4, -74.8273990, 9.5869420),
(161, '13012', 'CLEMENCIA', 4, -75.3284690, 10.5674520),
(162, '13013', 'EL CARMEN DE BOLÍVAR', 4, -75.1211780, 9.7186530),
(163, '13014', 'EL GUAMO', 4, -74.9760840, 10.0309580),
(164, '13015', 'EL PEÑÓN', 4, -73.9492740, 8.9882710),
(165, '13016', 'HATILLO DE LOBA', 4, -74.0779120, 8.9560140),
(166, '13017', 'MAGANGUÉ', 4, -74.7667420, 9.2637990),
(167, '13018', 'MAHATES', 4, -75.1916430, 10.2332850),
(168, '13019', 'MARGARITA', 4, -74.2851370, 9.1578400),
(169, '13020', 'MARÍA LA BAJA', 4, -75.3005160, 9.9824020),
(170, '13021', 'MONTECRISTO', 4, -74.4711760, 8.2979110),
(171, '13022', 'SANTA CRUZ DE MOMPOX', 4, -74.4281800, 9.2442410),
(172, '13023', 'MORALES', 4, -73.8681720, 8.2765580),
(173, '13024', 'NOROSÍ', 4, -74.0380030, 8.5262590),
(174, '13025', 'PINILLOS', 4, -74.4629470, 8.9149470),
(175, '13026', 'REGIDOR', 4, -73.8218360, 8.6662580),
(176, '13027', 'RÍO VIEJO', 4, -73.8404660, 8.5879500),
(177, '13028', 'SAN CRISTÓBAL', 4, -75.0650760, 10.3928360),
(178, '13029', 'SAN ESTANISLAO', 4, -75.1531010, 10.3986020),
(179, '13030', 'SAN FERNANDO', 4, -74.3238310, 9.2141830),
(180, '13031', 'SAN JACINTO', 4, -75.1210500, 9.8302750),
(181, '13032', 'SAN JACINTO DEL CAUCA', 4, -74.7211560, 8.2515800),
(182, '13033', 'SAN JUAN NEPOMUCENO', 4, -75.0816520, 9.9537510),
(183, '13034', 'SAN MARTÍN DE LOBA', 4, -74.0391340, 8.9374850),
(184, '13035', 'SAN PABLO', 4, -73.9246020, 7.4767470),
(185, '13036', 'SANTA CATALINA', 4, -75.2878550, 10.6052940),
(186, '13037', 'SANTA ROSA', 4, -75.3698240, 10.4443960),
(187, '13038', 'SANTA ROSA DEL SUR', 4, -74.0522430, 7.9639380),
(188, '13039', 'SIMITÍ', 4, -73.9472640, 7.9539160),
(189, '13040', 'SOPLAVIENTO', 4, -75.1364050, 10.3883900),
(190, '13041', 'TALAIGUA NUEVO', 4, -74.5676490, 9.3040300),
(191, '13042', 'TIQUISIO', 4, -74.2629220, 8.5586660),
(192, '13043', 'TURBACO', 4, -75.4272490, 10.3483160),
(193, '13044', 'TURBANÁ', 4, -75.4426500, 10.2745850),
(194, '13045', 'VILLANUEVA', 4, -75.2758220, 10.4440890),
(195, '13046', 'ZAMBRANO', 4, -74.8178790, 9.7463060),
(196, '15001', 'TUNJA', 5, -73.3555390, 5.5398800),
(197, '15002', 'ALMEIDA', 5, -73.3789330, 4.9708570),
(198, '15003', 'AQUITANIA', 5, -72.8839900, 5.5186020),
(199, '15004', 'ARCABUCO', 5, -73.4375030, 5.7556730),
(200, '15005', 'BELÉN', 5, -72.9116410, 5.9892300),
(201, '15006', 'BERBEO', 5, -73.1272100, 5.2274510),
(202, '15007', 'BETÉITIVA', 5, -72.8090140, 5.9099780),
(203, '15008', 'BOAVITA', 5, -72.5849050, 6.3307030),
(204, '15009', 'BOYACÁ', 5, -73.3619450, 5.4545780),
(205, '15010', 'BRICEÑO', 5, -73.9232600, 5.6908790),
(206, '15011', 'BUENAVISTA', 5, -73.9421700, 5.5125940),
(207, '15012', 'BUSBANZÁ', 5, -72.8841580, 5.8313930),
(208, '15013', 'CALDAS', 5, -73.8655530, 5.5545800),
(209, '15014', 'CAMPOHERMOSO', 5, -73.1041730, 5.0316760),
(210, '15015', 'CERINZA', 5, -72.9479180, 5.9559390),
(211, '15016', 'CHINAVITA', 5, -73.3684760, 5.1674860),
(212, '15017', 'CHIQUINQUIRÁ', 5, -73.8187450, 5.6137900),
(213, '15018', 'CHISCAS', 5, -72.5009570, 6.5531360),
(214, '15019', 'CHITA', 5, -72.4718920, 6.1870830),
(215, '15020', 'CHITARAQUE', 5, -73.4471000, 6.0274250),
(216, '15021', 'CHIVATÁ', 5, -73.2825290, 5.5589490),
(217, '15022', 'CIÉNEGA', 5, -73.2960490, 5.4086940),
(218, '15023', 'CÓMBITA', 5, -73.3239570, 5.6345450),
(219, '15024', 'COPER', 5, -74.0456360, 5.4750740),
(220, '15025', 'CORRALES', 5, -72.8447950, 5.8280640),
(221, '15026', 'COVARACHÍA', 5, -72.7389780, 6.5001770),
(222, '15027', 'CUBARÁ', 5, -72.1079390, 6.9972750),
(223, '15028', 'CUCAITA', 5, -73.4543380, 5.5444520),
(224, '15029', 'CUÍTIVA', 5, -72.9659230, 5.5803670),
(225, '15030', 'CHÍQUIZA', 5, -73.4494630, 5.6398340),
(226, '15031', 'CHIVOR', 5, -73.3683980, 4.8881730),
(227, '15032', 'DUITAMA', 5, -73.0306300, 5.8229640),
(228, '15033', 'EL COCUY', 5, -72.4445370, 6.4077380),
(229, '15034', 'EL ESPINO', 5, -72.4970070, 6.4830270),
(230, '15035', 'FIRAVITOBA', 5, -72.9933920, 5.6688850),
(231, '15036', 'FLORESTA', 5, -72.9181110, 5.8595190),
(232, '15037', 'GACHANTIVÁ', 5, -73.5490920, 5.7518910),
(233, '15038', 'GÁMEZA', 5, -72.8055300, 5.8023330),
(234, '15039', 'GARAGOA', 5, -73.3644130, 5.0832340),
(235, '15040', 'GUACAMAYAS', 5, -72.5008120, 6.4596670),
(236, '15041', 'GUATEQUE', 5, -73.4712070, 5.0073210),
(237, '15042', 'GUAYATÁ', 5, -73.4896980, 4.9671220),
(238, '15043', 'GÜICÁN DE LA SIERRA', 5, -72.4117630, 6.4628640),
(239, '15044', 'IZA', 5, -72.9795590, 5.6115770),
(240, '15045', 'JENESANO', 5, -73.3637380, 5.3858130),
(241, '15046', 'JERICÓ', 5, -72.5711220, 6.1457350),
(242, '15047', 'LABRANZAGRANDE', 5, -72.5777700, 5.5626870),
(243, '15048', 'LA CAPILLA', 5, -73.4443470, 5.0956870),
(244, '15049', 'LA VICTORIA', 5, -74.2343930, 5.5237920),
(245, '15050', 'LA UVITA', 5, -72.5599820, 6.3161600),
(246, '15051', 'VILLA DE LEYVA', 5, -73.5249480, 5.6324550),
(247, '15052', 'MACANAL', 5, -73.3195930, 4.9724640),
(248, '15053', 'MARIPÍ', 5, -74.0040500, 5.5500910),
(249, '15054', 'MIRAFLORES', 5, -73.1456300, 5.1965150),
(250, '15055', 'MONGUA', 5, -72.7980900, 5.7542420),
(251, '15056', 'MONGUÍ', 5, -72.8492920, 5.7234860),
(252, '15057', 'MONIQUIRÁ', 5, -73.5733740, 5.8763310),
(253, '15058', 'MOTAVITA', 5, -73.3678410, 5.5777000),
(254, '15059', 'MUZO', 5, -74.1026900, 5.5327580),
(255, '15060', 'NOBSA', 5, -72.9370420, 5.7680460),
(256, '15061', 'NUEVO COLÓN', 5, -73.4567590, 5.3553170),
(257, '15062', 'OICATÁ', 5, -73.3083990, 5.5952350),
(258, '15063', 'OTANCHE', 5, -74.1809650, 5.6575360),
(259, '15064', 'PACHAVITA', 5, -73.3969530, 5.1400650),
(260, '15065', 'PÁEZ', 5, -73.0527370, 5.0973190),
(261, '15066', 'PAIPA', 5, -73.1178200, 5.7798940),
(262, '15067', 'PAJARITO', 5, -72.7032310, 5.2937830),
(263, '15068', 'PANQUEBA', 5, -72.4594240, 6.4434160),
(264, '15069', 'PAUNA', 5, -73.9784490, 5.6563230),
(265, '15070', 'PAYA', 5, -72.4237750, 5.6256990),
(266, '15071', 'PAZ DE RÍO', 5, -72.7491370, 5.9876450),
(267, '15072', 'PESCA', 5, -73.0508720, 5.5588080),
(268, '15073', 'PISBA', 5, -72.4860230, 5.7214100),
(269, '15074', 'PUERTO BOYACÁ', 5, -74.5877820, 5.9766460),
(270, '15075', 'QUÍPAMA', 5, -74.1800330, 5.5205500),
(271, '15076', 'RAMIRIQUÍ', 5, -73.3348390, 5.4003030),
(272, '15077', 'RÁQUIRA', 5, -73.6325430, 5.5391360),
(273, '15078', 'RONDÓN', 5, -73.2084740, 5.3573780),
(274, '15079', 'SABOYÁ', 5, -73.7644560, 5.6977560),
(275, '15080', 'SÁCHICA', 5, -73.5425390, 5.5843050),
(276, '15081', 'SAMACÁ', 5, -73.4855890, 5.4921610),
(277, '15082', 'SAN EDUARDO', 5, -73.0777470, 5.2240100),
(278, '15083', 'SAN JOSÉ DE PARE', 5, -73.5453970, 6.0189240),
(279, '15084', 'SAN LUIS DE GACENO', 5, -73.1680760, 4.8197600),
(280, '15085', 'SAN MATEO', 5, -72.5552640, 6.4016830),
(281, '15086', 'SAN MIGUEL DE SEMA', 5, -73.7220090, 5.5180830),
(282, '15087', 'SAN PABLO DE BORBUR', 5, -74.0699630, 5.6507430),
(283, '15088', 'SANTANA', 5, -73.4816390, 6.0568660),
(284, '15089', 'SANTA MARÍA', 5, -73.2635180, 4.8571930),
(285, '15090', 'SANTA ROSA DE VITERBO', 5, -72.9824610, 5.8745470),
(286, '15091', 'SANTA SOFÍA', 5, -73.6027070, 5.7132690),
(287, '15092', 'SATIVANORTE', 5, -72.7084580, 6.1311320),
(288, '15093', 'SATIVASUR', 5, -72.7124350, 6.0931830),
(289, '15094', 'SIACHOQUE', 5, -73.2446600, 5.5118110),
(290, '15095', 'SOATÁ', 5, -72.6840510, 6.3319450),
(291, '15096', 'SOCOTÁ', 5, -72.6366530, 6.0411620),
(292, '15097', 'SOCHA', 5, -72.6919630, 5.9967170),
(293, '15098', 'SOGAMOSO', 5, -72.9243550, 5.7239760),
(294, '15099', 'SOMONDOCO', 5, -73.4333930, 4.9857260),
(295, '15100', 'SORA', 5, -73.4501530, 5.5668400),
(296, '15101', 'SOTAQUIRÁ', 5, -73.2465850, 5.7649860),
(297, '15102', 'SORACÁ', 5, -73.3328040, 5.5008980),
(298, '15103', 'SUSACÓN', 5, -72.6902890, 6.2303320),
(299, '15104', 'SUTAMARCHÁN', 5, -73.6205360, 5.6197810),
(300, '15105', 'SUTATENZA', 5, -73.4523170, 5.0229890),
(301, '15106', 'TASCO', 5, -72.7810110, 5.9098210),
(302, '15107', 'TENZA', 5, -73.4211760, 5.0767810),
(303, '15108', 'TIBANÁ', 5, -73.3964570, 5.3172510),
(304, '15109', 'TIBASOSA', 5, -72.9994490, 5.7472300),
(305, '15110', 'TINJACÁ', 5, -73.6468470, 5.5797130),
(306, '15111', 'TIPACOQUE', 5, -72.6917290, 6.4192030),
(307, '15112', 'TOCA', 5, -73.1847940, 5.5664640),
(308, '15113', 'TOGÜÍ', 5, -73.5136550, 5.9374380),
(309, '15114', 'TÓPAGA', 5, -72.8322450, 5.7682010),
(310, '15115', 'TOTA', 5, -72.9858980, 5.5604970),
(311, '15116', 'TUNUNGUÁ', 5, -73.9331550, 5.7305820),
(312, '15117', 'TURMEQUÉ', 5, -73.4918250, 5.3232610),
(313, '15118', 'TUTA', 5, -73.2302850, 5.6890820),
(314, '15119', 'TUTAZÁ', 5, -72.8560350, 6.0326080),
(315, '15120', 'ÚMBITA', 5, -73.4569170, 5.2211760),
(316, '15121', 'VENTAQUEMADA', 5, -73.5223680, 5.3687390),
(317, '15122', 'VIRACACHÁ', 5, -73.2968940, 5.4368330),
(318, '15123', 'ZETAQUIRA', 5, -73.1709800, 5.2834430),
(319, '17001', 'MANIZALES', 6, -75.4910250, 5.0576570),
(320, '17002', 'AGUADAS', 6, -75.4548700, 5.6102440),
(321, '17003', 'ANSERMA', 6, -75.7843430, 5.2364710),
(322, '17004', 'ARANZAZU', 6, -75.4912900, 5.2711950),
(323, '17005', 'BELALCÁZAR', 6, -75.8119180, 4.9937850),
(324, '17006', 'CHINCHINÁ', 6, -75.6075290, 4.9852270),
(325, '17007', 'FILADELFIA', 6, -75.5624740, 5.2970910),
(326, '17008', 'LA DORADA', 6, -74.6688190, 5.4608330),
(327, '17009', 'LA MERCED', 6, -75.5464860, 5.3964700),
(328, '17010', 'MANZANARES', 6, -75.1528290, 5.2556670),
(329, '17011', 'MARMATO', 6, -75.6000490, 5.4742200),
(330, '17012', 'MARQUETALIA', 6, -75.0530970, 5.2975250),
(331, '17013', 'MARULANDA', 6, -75.2597210, 5.2843040),
(332, '17014', 'NEIRA', 6, -75.5200060, 5.1668950),
(333, '17015', 'NORCASIA', 6, -74.8895430, 5.5747960),
(334, '17016', 'PÁCORA', 6, -75.4596210, 5.5271720),
(335, '17017', 'PALESTINA', 6, -75.6245770, 5.0178790),
(336, '17018', 'PENSILVANIA', 6, -75.1602990, 5.3832810),
(337, '17019', 'RIOSUCIO', 6, -75.7021040, 5.4236730),
(338, '17020', 'RISARALDA', 6, -75.7672200, 5.1645090),
(339, '17021', 'SALAMINA', 6, -75.4872230, 5.4030250),
(340, '17022', 'SAMANÁ', 6, -74.9922630, 5.4130800),
(341, '17023', 'SAN JOSÉ', 6, -75.7920630, 5.0823100),
(342, '17024', 'SUPÍA', 6, -75.6496600, 5.4468430),
(343, '17025', 'VICTORIA', 6, -74.9112390, 5.3174370),
(344, '17026', 'VILLAMARÍA', 6, -75.5024870, 5.0389250),
(345, '17027', 'VITERBO', 6, -75.8706100, 5.0626640),
(346, '18001', 'FLORENCIA', 7, -75.6098310, 1.6181960),
(347, '18002', 'ALBANIA', 7, -75.8783750, 1.3285260),
(348, '18003', 'BELÉN DE LOS ANDAQUÍES', 7, -75.8724050, 1.4158120),
(349, '18004', 'CARTAGENA DEL CHAIRÁ', 7, -74.8478670, 1.3323710),
(350, '18005', 'CURILLO', 7, -75.9192050, 1.0334730),
(351, '18006', 'EL DONCELLO', 7, -75.2836310, 1.6799510),
(352, '18007', 'EL PAUJÍL', 7, -75.3260930, 1.5702260),
(353, '18008', 'LA MONTAÑITA', 7, -75.4364080, 1.4791730),
(354, '18009', 'MILÁN', 7, -75.5069260, 1.2902100),
(355, '18010', 'MORELIA', 7, -75.7241460, 1.4866110),
(356, '18011', 'PUERTO RICO', 7, -75.1576040, 1.9090630),
(357, '18012', 'SAN JOSÉ DEL FRAGUA', 7, -75.9737960, 1.3302660),
(358, '18013', 'SAN VICENTE DEL CAGUÁN', 7, -74.7678940, 2.1194130),
(359, '18014', 'SOLANO', 7, -75.2537020, 0.6990770),
(360, '18015', 'SOLITA', 7, -75.6199020, 0.8765400),
(361, '18016', 'VALPARAÍSO', 7, -75.7067100, 1.1946190),
(362, '19001', 'POPAYÁN', 8, -76.5993770, 2.4596410),
(363, '19002', 'ALMAGUER', 8, -76.8560700, 1.9134290),
(364, '19003', 'ARGELIA', 8, -77.2490500, 2.2574270),
(365, '19004', 'BALBOA', 8, -77.2157730, 2.0409980),
(366, '19005', 'BOLÍVAR', 8, -76.9662150, 1.8375380),
(367, '19006', 'BUENOS AIRES', 8, -76.6422380, 3.0153820),
(368, '19007', 'CAJIBÍO', 8, -76.5706820, 2.6233710),
(369, '19008', 'CALDONO', 8, -76.4843190, 2.7980590),
(370, '19009', 'CALOTO', 8, -76.4089410, 3.0345310),
(371, '19010', 'CORINTO', 8, -76.2618660, 3.1738540),
(372, '19011', 'EL TAMBO', 8, -76.8109110, 2.4514090),
(373, '19012', 'FLORENCIA', 8, -77.0725470, 1.6825350),
(374, '19013', 'GUACHENÉ', 8, -76.3921890, 3.1341530),
(375, '19014', 'GUAPI', 8, -77.8879700, 2.5713370),
(376, '19015', 'INZÁ', 8, -76.0635030, 2.5491830),
(377, '19016', 'JAMBALÓ', 8, -76.3238770, 2.7778340),
(378, '19017', 'LA SIERRA', 8, -76.7632780, 2.1793830),
(379, '19018', 'LA VEGA', 8, -76.7787710, 2.0018030),
(380, '19019', 'LÓPEZ DE MICAY', 8, -77.2478030, 2.8467880),
(381, '19020', 'MERCADERES', 8, -77.1643190, 1.7891930),
(382, '19021', 'MIRANDA', 8, -76.2287220, 3.2546510),
(383, '19022', 'MORALES', 8, -76.6291060, 2.7546840),
(384, '19023', 'PADILLA', 8, -76.3132650, 3.2209840),
(385, '19024', 'PÁEZ', 8, -75.9706850, 2.6457240),
(386, '19025', 'PATÍA', 8, -76.9810750, 2.1158750),
(387, '19026', 'PIAMONTE', 8, -76.3275880, 1.1175400),
(388, '19027', 'PIENDAMÓ - TUNÍA', 8, -76.5286150, 2.6422800),
(389, '19028', 'PUERTO TEJADA', 8, -76.4176730, 3.2332540),
(390, '19029', 'PURACÉ', 8, -76.4966980, 2.3415070),
(391, '19030', 'ROSAS', 8, -76.7403360, 2.2609410),
(392, '19031', 'SAN SEBASTIÁN', 8, -76.7694670, 1.8384510),
(393, '19032', 'SANTANDER DE QUILICHAO', 8, -76.4851410, 3.0150080),
(394, '19033', 'SANTA ROSA', 8, -76.5732520, 1.7009160),
(395, '19034', 'SILVIA', 8, -76.3797530, 2.6119270),
(396, '19035', 'SOTARÁ - PAISPAMBA', 8, -76.6133650, 2.2531560),
(397, '19036', 'SUÁREZ', 8, -76.6935700, 2.9597850),
(398, '19037', 'SUCRE', 8, -76.9262790, 2.0382370),
(399, '19038', 'TIMBÍO', 8, -76.6844760, 2.3496860),
(400, '19039', 'TIMBIQUÍ', 8, -77.6675410, 2.7773120),
(401, '19040', 'TORIBÍO', 8, -76.2702840, 2.9530170),
(402, '19041', 'TOTORÓ', 8, -76.4036280, 2.5102520),
(403, '19042', 'VILLA RICA', 8, -76.4580250, 3.1776200),
(404, '20001', 'VALLEDUPAR', 9, -73.2593980, 10.4604720),
(405, '20002', 'AGUACHICA', 9, -73.6140270, 8.3068110),
(406, '20003', 'AGUSTÍN CODAZZI', 9, -73.2383890, 10.0404540),
(407, '20004', 'ASTREA', 9, -73.9758420, 9.4980620),
(408, '20005', 'BECERRIL', 9, -73.2787070, 9.7044040),
(409, '20006', 'BOSCONIA', 9, -73.8887610, 9.9750980),
(410, '20007', 'CHIMICHAGUA', 9, -73.8132780, 9.2587500),
(411, '20008', 'CHIRIGUANÁ', 9, -73.5999130, 9.3610580),
(412, '20009', 'CURUMANÍ', 9, -73.5408430, 9.2017160),
(413, '20010', 'EL COPEY', 9, -73.9627030, 10.1498830),
(414, '20011', 'EL PASO', 9, -73.7420120, 9.6684610),
(415, '20012', 'GAMARRA', 9, -73.7375580, 8.3247930),
(416, '20013', 'GONZÁLEZ', 9, -73.3800400, 8.3896040),
(417, '20014', 'LA GLORIA', 9, -73.8032100, 8.6192980),
(418, '20015', 'LA JAGUA DE IBIRICO', 9, -73.3341430, 9.5637520),
(419, '20016', 'MANAURE BALCÓN DEL CESAR', 9, -73.0294720, 10.3907760),
(420, '20017', 'PAILITAS', 9, -73.6258250, 8.9593990),
(421, '20018', 'PELAYA', 9, -73.6667350, 8.6894510),
(422, '20019', 'PUEBLO BELLO', 9, -73.5862110, 10.4173210),
(423, '20020', 'RÍO DE ORO', 9, -73.3863930, 8.2922920),
(424, '20021', 'LA PAZ', 9, -73.1713650, 10.3875520),
(425, '20022', 'SAN ALBERTO', 9, -73.3938890, 7.7611100),
(426, '20023', 'SAN DIEGO', 9, -73.1812080, 10.3330390),
(427, '20024', 'SAN MARTÍN', 9, -73.5109140, 7.9998550),
(428, '20025', 'TAMALAMEQUE', 9, -73.8121720, 8.8617250),
(429, '23001', 'MONTERÍA', 10, -75.8730960, 8.7597890),
(430, '23002', 'AYAPEL', 10, -75.1460480, 8.3138380),
(431, '23003', 'BUENAVISTA', 10, -75.4808970, 8.2211870),
(432, '23004', 'CANALETE', 10, -76.2414760, 8.7869390),
(433, '23005', 'CERETÉ', 10, -75.7960930, 8.8885320),
(434, '23006', 'CHIMÁ', 10, -75.6268860, 9.1496980),
(435, '23007', 'CHINÚ', 10, -75.3996330, 9.1054730),
(436, '23008', 'CIÉNAGA DE ORO', 10, -75.6208070, 8.8757940),
(437, '23009', 'COTORRA', 10, -75.7992160, 9.0371630),
(438, '23010', 'LA APARTADA', 10, -75.3360310, 8.0501250),
(439, '23011', 'LORICA', 10, -75.8160840, 9.2407890),
(440, '23012', 'LOS CÓRDOBAS', 10, -76.3551800, 8.8920980),
(441, '23013', 'MOMIL', 10, -75.6779600, 9.2407070),
(442, '23014', 'MONTELÍBANO', 10, -75.4168180, 7.9737770),
(443, '23015', 'MOÑITOS', 10, -76.1291000, 9.2452230),
(444, '23016', 'PLANETA RICA', 10, -75.5832410, 8.4082000),
(445, '23017', 'PUEBLO NUEVO', 10, -75.5080350, 8.5040990),
(446, '23018', 'PUERTO ESCONDIDO', 10, -76.2604110, 9.0053720),
(447, '23019', 'PUERTO LIBERTADOR', 10, -75.6717610, 7.8888590),
(448, '23020', 'PURÍSIMA DE LA CONCEPCIÓN', 10, -75.7249870, 9.2392950),
(449, '23021', 'SAHAGÚN', 10, -75.4458340, 8.9430480),
(450, '23022', 'SAN ANDRÉS DE SOTAVENTO', 10, -75.5087900, 9.1454480),
(451, '23023', 'SAN ANTERO', 10, -75.7611200, 9.3764340),
(452, '23024', 'SAN BERNARDO DEL VIENTO', 10, -75.9551070, 9.3524700),
(453, '23025', 'SAN CARLOS', 10, -75.6987990, 8.7992820),
(454, '23026', 'SAN JOSÉ DE URÉ', 10, -75.5334760, 7.7873030),
(455, '23027', 'SAN PELAYO', 10, -75.8356150, 8.9584360),
(456, '23028', 'TIERRALTA', 10, -76.0597970, 8.1706120),
(457, '23029', 'TUCHÍN', 10, -75.5539620, 9.1866250),
(458, '23030', 'VALENCIA', 10, -76.1507560, 8.2550160),
(459, '25001', 'AGUA DE DIOS', 11, -74.6692210, 4.3753090),
(460, '25002', 'ALBÁN', 11, -74.4382610, 4.8780220),
(461, '25003', 'ANAPOIMA', 11, -74.5286760, 4.5627370),
(462, '25004', 'ANOLAIMA', 11, -74.4638400, 4.7617000),
(463, '25005', 'ARBELÁEZ', 11, -74.4149010, 4.2725340),
(464, '25006', 'BELTRÁN', 11, -74.7416660, 4.8028320),
(465, '25007', 'BITUIMA', 11, -74.5396090, 4.8721710),
(466, '25008', 'BOJACÁ', 11, -74.3445940, 4.7372050),
(467, '25009', 'CABRERA', 11, -74.4845490, 3.9851640),
(468, '25010', 'CACHIPAY', 11, -74.4357110, 4.7309570),
(469, '25011', 'CAJICÁ', 11, -74.0229800, 4.9200090),
(470, '25012', 'CAPARRAPÍ', 11, -74.4910450, 5.3475800),
(471, '25013', 'CÁQUEZA', 11, -73.9464730, 4.4041120),
(472, '25014', 'CARMEN DE CARUPA', 11, -73.9013570, 5.3491190),
(473, '25015', 'CHAGUANÍ', 11, -74.5934550, 4.9489160),
(474, '25016', 'CHÍA', 11, -74.0500000, 4.8665080),
(475, '25017', 'CHIPAQUE', 11, -74.0448760, 4.4426710),
(476, '25018', 'CHOACHÍ', 11, -73.9228940, 4.5270480),
(477, '25019', 'CHOCONTÁ', 11, -73.6835330, 5.1452240),
(478, '25020', 'COGUA', 11, -73.9784970, 5.0618420),
(479, '25021', 'COTA', 11, -74.1025690, 4.8125640),
(480, '25022', 'CUCUNUBÁ', 11, -73.7661130, 5.2497950),
(481, '25023', 'EL COLEGIO', 11, -74.4422610, 4.5779510),
(482, '25024', 'EL PEÑÓN', 11, -74.2902070, 5.2487470),
(483, '25025', 'EL ROSAL', 11, -74.2631030, 4.8505890),
(484, '25026', 'FACATATIVÁ', 11, -74.3500850, 4.8133530),
(485, '25027', 'FÓMEQUE', 11, -73.8925230, 4.4854740),
(486, '25028', 'FOSCA', 11, -73.9390200, 4.3390930),
(487, '25029', 'FUNZA', 11, -74.2015280, 4.7104120),
(488, '25030', 'FÚQUENE', 11, -73.7958550, 5.4039970),
(489, '25031', 'FUSAGASUGÁ', 11, -74.3754300, 4.3367230),
(490, '25032', 'GACHALÁ', 11, -73.5201610, 4.6935790),
(491, '25033', 'GACHANCIPÁ', 11, -73.8734640, 4.9909470),
(492, '25034', 'GACHETÁ', 11, -73.6363770, 4.8164110),
(493, '25035', 'GAMA', 11, -73.6110370, 4.7633250),
(494, '25036', 'GIRARDOT', 11, -74.7982010, 4.3130690),
(495, '25037', 'GRANADA', 11, -74.3507660, 4.5197630),
(496, '25038', 'GUACHETÁ', 11, -73.6869720, 5.3833780),
(497, '25039', 'GUADUAS', 11, -74.6034020, 5.0720760),
(498, '25040', 'GUASCA', 11, -73.8771430, 4.8667190),
(499, '25041', 'GUATAQUÍ', 11, -74.7900580, 4.5175170),
(500, '25042', 'GUATAVITA', 11, -73.8329300, 4.9352110),
(501, '25043', 'GUAYABAL DE SÍQUIMA', 11, -74.4674370, 4.8779680),
(502, '25044', 'GUAYABETAL', 11, -73.8151070, 4.2153060),
(503, '25045', 'GUTIÉRREZ', 11, -74.0030420, 4.2546790),
(504, '25046', 'JERUSALÉN', 11, -74.6954740, 4.5622730),
(505, '25047', 'JUNÍN', 11, -73.6629610, 4.7905700),
(506, '25048', 'LA CALERA', 11, -73.9681610, 4.7211040),
(507, '25049', 'LA MESA', 11, -74.4615880, 4.6310280),
(508, '25050', 'LA PALMA', 11, -74.3910220, 5.3588160),
(509, '25051', 'LA PEÑA', 11, -74.3941050, 5.1989450),
(510, '25052', 'LA VEGA', 11, -74.3368850, 4.9977680),
(511, '25053', 'LENGUAZAQUE', 11, -73.7115120, 5.3061310),
(512, '25054', 'MACHETÁ', 11, -73.6082260, 5.0800700),
(513, '25055', 'MADRID', 11, -74.2658540, 4.7327910),
(514, '25056', 'MANTA', 11, -73.5404440, 5.0090080),
(515, '25057', 'MEDINA', 11, -73.3484490, 4.5062980),
(516, '25058', 'MOSQUERA', 11, -74.2211540, 4.7065300),
(517, '25059', 'NARIÑO', 11, -74.8247320, 4.3998370),
(518, '25060', 'NEMOCÓN', 11, -73.8778880, 5.0687050),
(519, '25061', 'NILO', 11, -74.6200090, 4.3058380),
(520, '25062', 'NIMAIMA', 11, -74.3860400, 5.1259920),
(521, '25063', 'NOCAIMA', 11, -74.3790930, 5.0694660),
(522, '25064', 'VENECIA', 11, -74.4783010, 4.0890560),
(523, '25065', 'PACHO', 11, -74.1561320, 5.1369070),
(524, '25066', 'PAIME', 11, -74.1522130, 5.3704870),
(525, '25067', 'PANDI', 11, -74.4866410, 4.1903930),
(526, '25068', 'PARATEBUENO', 11, -73.2128250, 4.3748320),
(527, '25069', 'PASCA', 11, -74.3022760, 4.3089790),
(528, '25070', 'PUERTO SALGAR', 11, -74.6536950, 5.4654130),
(529, '25071', 'PULÍ', 11, -74.7143800, 4.6820220),
(530, '25072', 'QUEBRADANEGRA', 11, -74.4801400, 5.1180760),
(531, '25073', 'QUETAME', 11, -73.8632140, 4.3298840),
(532, '25074', 'QUIPILE', 11, -74.5337050, 4.7448100),
(533, '25075', 'APULO', 11, -74.5939260, 4.5203040),
(534, '25076', 'RICAURTE', 11, -74.7728610, 4.2821130),
(535, '25077', 'SAN ANTONIO DEL TEQUENDAMA', 11, -74.3514430, 4.6161380),
(536, '25078', 'SAN BERNARDO', 11, -74.4229600, 4.1794330),
(537, '25079', 'SAN CAYETANO', 11, -74.0247540, 5.3329380),
(538, '25080', 'SAN FRANCISCO', 11, -74.2896720, 4.9729170),
(539, '25081', 'SAN JUAN DE RIOSECO', 11, -74.6219190, 4.8475750),
(540, '25082', 'SASAIMA', 11, -74.4326280, 4.9621670),
(541, '25083', 'SESQUILÉ', 11, -73.7960990, 5.0447600),
(542, '25084', 'SIBATÉ', 11, -74.2578740, 4.4926250),
(543, '25085', 'SILVANIA', 11, -74.4055340, 4.3819810),
(544, '25086', 'SIMIJACA', 11, -73.8507030, 5.5052310),
(545, '25087', 'SOACHA', 11, -74.2154630, 4.5792680),
(546, '25088', 'SOPÓ', 11, -73.9433280, 4.9153950),
(547, '25089', 'SUBACHOQUE', 11, -74.1727730, 4.9291180),
(548, '25090', 'SUESCA', 11, -73.7982270, 5.1034950),
(549, '25091', 'SUPATÁ', 11, -74.2354030, 5.0616200),
(550, '25092', 'SUSA', 11, -73.8139380, 5.4552910),
(551, '25093', 'SUTATAUSA', 11, -73.8531590, 5.2474820),
(552, '25094', 'TABIO', 11, -74.0964610, 4.9168320),
(553, '25095', 'TAUSA', 11, -73.8878130, 5.1963330),
(554, '25096', 'TENA', 11, -74.3891930, 4.6552860),
(555, '25097', 'TENJO', 11, -74.1437240, 4.8720140),
(556, '25098', 'TIBACUY', 11, -74.4526620, 4.3486050),
(557, '25099', 'TIBIRITA', 11, -73.5045140, 5.0522780),
(558, '25100', 'TOCAIMA', 11, -74.6362960, 4.4592790),
(559, '25101', 'TOCANCIPÁ', 11, -73.9120700, 4.9646410),
(560, '25102', 'TOPAIPÍ', 11, -74.3006260, 5.3362240),
(561, '25103', 'UBALÁ', 11, -73.5314890, 4.7476200),
(562, '25104', 'UBAQUE', 11, -73.9334770, 4.4837880),
(563, '25105', 'VILLA DE SAN DIEGO DE UBATÉ', 11, -73.8143670, 5.3074630),
(564, '25106', 'UNE', 11, -74.0251830, 4.4024500),
(565, '25107', 'ÚTICA', 11, -74.4831540, 5.1905500),
(566, '25108', 'VERGARA', 11, -74.3461630, 5.1172580),
(567, '25109', 'VIANÍ', 11, -74.5613200, 4.8752080),
(568, '25110', 'VILLAGÓMEZ', 11, -74.1951450, 5.2730240),
(569, '25111', 'VILLAPINZÓN', 11, -73.5957040, 5.2163930),
(570, '25112', 'VILLETA', 11, -74.4696860, 5.0127540),
(571, '25113', 'VIOTÁ', 11, -74.5231310, 4.4393500),
(572, '25114', 'YACOPÍ', 11, -74.3380600, 5.4592720),
(573, '25115', 'ZIPACÓN', 11, -74.3795660, 4.7599320),
(574, '25116', 'ZIPAQUIRÁ', 11, -73.9944440, 5.0254770),
(575, '27001', 'QUIBDÓ', 12, -76.6381440, 5.6821660),
(576, '27002', 'ACANDÍ', 12, -77.2799510, 8.5121780),
(577, '27003', 'ALTO BAUDÓ', 12, -76.9743730, 5.5162210),
(578, '27004', 'ATRATO', 12, -76.6356740, 5.5314190),
(579, '27005', 'BAGADÓ', 12, -76.4160630, 5.4096810),
(580, '27006', 'BAHÍA SOLANO', 12, -77.4013590, 6.2228070),
(581, '27007', 'BAJO BAUDÓ', 12, -77.3657170, 4.9545760),
(582, '27008', 'BOJAYÁ', 12, -76.8867730, 6.5597080),
(583, '27009', 'EL CANTÓN DEL SAN PABLO', 12, -76.7268440, 5.3353210),
(584, '27010', 'CARMEN DEL DARIÉN', 12, -76.9707980, 7.1582940),
(585, '27011', 'CÉRTEGUI', 12, -76.6076190, 5.3713730),
(586, '27012', 'CONDOTO', 12, -76.6506830, 5.0910030),
(587, '27013', 'EL CARMEN DE ATRATO', 12, -76.1421120, 5.8997890),
(588, '27014', 'EL LITORAL DEL SAN JUAN', 12, -77.3637020, 4.2595640),
(589, '27015', 'ISTMINA', 12, -76.6851800, 5.1539460),
(590, '27016', 'JURADÓ', 12, -77.7627510, 7.1036190),
(591, '27017', 'LLORÓ', 12, -76.5451470, 5.4978900),
(592, '27018', 'MEDIO ATRATO', 12, -76.7830420, 5.9949350),
(593, '27019', 'MEDIO BAUDÓ', 12, -76.9508910, 5.1924710),
(594, '27020', 'MEDIO SAN JUAN', 12, -76.6944090, 5.0982910),
(595, '27021', 'NÓVITA', 12, -76.6094670, 4.9560630),
(596, '27022', 'NUEVO BELÉN DE BAJIRÁ', 12, -76.7172700, 7.3719000),
(597, '27023', 'NUQUÍ', 12, -77.2655070, 5.7098120),
(598, '27024', 'RÍO IRÓ', 12, -76.4729250, 5.1863000),
(599, '27025', 'RÍO QUITO', 12, -76.7406840, 5.4836670),
(600, '27026', 'RIOSUCIO', 12, -77.1131560, 7.4367040),
(601, '27027', 'SAN JOSÉ DEL PALMAR', 12, -76.2342270, 4.8969540),
(602, '27028', 'SIPÍ', 12, -76.6434530, 4.6526200),
(603, '27029', 'TADÓ', 12, -76.5585710, 5.2648730),
(604, '27030', 'UNGUÍA', 12, -77.0925380, 8.0440600),
(605, '27031', 'UNIÓN PANAMERICANA', 12, -76.6301430, 5.2811080),
(637, '41001', 'NEIVA', 13, -75.2773270, 2.9354320),
(638, '41002', 'ACEVEDO', 13, -75.8887060, 1.8051730),
(639, '41003', 'AGRADO', 13, -75.7720220, 2.2598700),
(640, '41004', 'AIPE', 13, -75.2390170, 3.2239960),
(641, '41005', 'ALGECIRAS', 13, -75.3153890, 2.5216740),
(642, '41006', 'ALTAMIRA', 13, -75.7884710, 2.0638410),
(643, '41007', 'BARAYA', 13, -75.0548430, 3.1522040),
(644, '41008', 'CAMPOALEGRE', 13, -75.3257480, 2.6867670),
(645, '41009', 'COLOMBIA', 13, -74.8028150, 3.3767450),
(646, '41010', 'ELÍAS', 13, -75.9383010, 2.0128540),
(647, '41011', 'GARZÓN', 13, -75.6270570, 2.1964930),
(648, '41012', 'GIGANTE', 13, -75.5476810, 2.3840310),
(649, '41013', 'GUADALUPE', 13, -75.7571850, 2.0242600),
(650, '41014', 'HOBO', 13, -75.4476970, 2.5808120),
(651, '41015', 'ÍQUIRA', 13, -75.6344970, 2.6493590),
(652, '41016', 'ISNOS', 13, -76.2176370, 1.9294670),
(653, '41017', 'LA ARGENTINA', 13, -75.9797630, 2.1984960),
(654, '41018', 'LA PLATA', 13, -75.8912540, 2.3892630),
(655, '41019', 'NÁTAGA', 13, -75.8087560, 2.5451000),
(656, '41020', 'OPORAPA', 13, -75.9951650, 2.0250880),
(657, '41021', 'PAICOL', 13, -75.7731580, 2.4496510),
(658, '41022', 'PALERMO', 13, -75.4352960, 2.8896490),
(659, '41023', 'PALESTINA', 13, -76.1332510, 1.7237250),
(660, '41024', 'PITAL', 13, -75.8045440, 2.2666180),
(661, '41025', 'PITALITO', 13, -76.0494410, 1.8526310),
(662, '41026', 'RIVERA', 13, -75.2587530, 2.7775860),
(663, '41027', 'SALADOBLANCO', 13, -76.0447470, 1.9934000),
(664, '41028', 'SAN AGUSTÍN', 13, -76.2703600, 1.8810810),
(665, '41029', 'SANTA MARÍA', 13, -75.5862230, 2.9396030),
(666, '41030', 'SUAZA', 13, -75.7952500, 1.9760510),
(667, '41031', 'TARQUI', 13, -75.8239760, 2.1113250),
(668, '41032', 'TESALIA', 13, -75.7302710, 2.4863640),
(669, '41033', 'TELLO', 13, -75.1387730, 3.0675380),
(670, '41034', 'TERUEL', 13, -75.5670340, 2.7409680),
(671, '41035', 'TIMANÁ', 13, -75.9321670, 1.9745390),
(672, '41036', 'VILLAVIEJA', 13, -75.2171740, 3.2188220),
(673, '41037', 'YAGUARÁ', 13, -75.5180230, 2.6646940),
(674, '44001', 'RIOHACHA', 14, -72.9117950, 11.5285880),
(675, '44002', 'ALBANIA', 14, -72.6123200, 11.1516280),
(676, '44003', 'BARRANCAS', 14, -72.7936390, 10.9586690),
(677, '44004', 'DIBULLA', 14, -73.3075980, 11.2715500),
(678, '44005', 'DISTRACCIÓN', 14, -72.8874050, 10.8984140),
(679, '44006', 'EL MOLINO', 14, -72.9267300, 10.6535050),
(680, '44007', 'FONSECA', 14, -72.8463190, 10.8867340),
(681, '44008', 'HATONUEVO', 14, -72.7590400, 11.0688640),
(682, '44009', 'LA JAGUA DEL PILAR', 14, -73.0726380, 10.5118620),
(683, '44010', 'MAICAO', 14, -72.2427380, 11.3785350),
(684, '44011', 'MANAURE', 14, -72.4387390, 11.7737670),
(685, '44012', 'SAN JUAN DEL CESAR', 14, -73.0006290, 10.7695460),
(686, '44013', 'URIBIA', 14, -72.2659060, 11.7119040),
(687, '44014', 'URUMITA', 14, -73.0125070, 10.5601690),
(688, '44015', 'VILLANUEVA', 14, -72.9775830, 10.6087740),
(689, '47001', 'SANTA MARTA', 15, -74.1998290, 11.2046790),
(690, '47002', 'ALGARROBO', 15, -74.0611320, 10.1880590),
(691, '47003', 'ARACATACA', 15, -74.1867020, 10.5897910),
(692, '47004', 'ARIGUANÍ', 15, -74.2365150, 9.8470470),
(693, '47005', 'CERRO DE SAN ANTONIO', 15, -74.8684740, 10.3255310),
(694, '47006', 'CHIVOLO', 15, -74.6222420, 10.0266310),
(695, '47007', 'CIÉNAGA', 15, -74.2412860, 11.0066540),
(696, '47008', 'CONCORDIA', 15, -74.8330300, 10.2573140),
(697, '47009', 'EL BANCO', 15, -73.9743700, 9.0085030),
(698, '47010', 'EL PIÑÓN', 15, -74.8230940, 10.4027810),
(699, '47011', 'EL RETÉN', 15, -74.2684440, 10.6104880),
(700, '47012', 'FUNDACIÓN', 15, -74.1914530, 10.5141460),
(701, '47013', 'GUAMAL', 15, -74.2236890, 9.1443540),
(702, '47014', 'NUEVA GRANADA', 15, -74.3918410, 9.8018600),
(703, '47015', 'PEDRAZA', 15, -74.9154000, 10.1882500),
(704, '47016', 'PIJIÑO DEL CARMEN', 15, -74.4590340, 9.3319220),
(705, '47017', 'PIVIJAY', 15, -74.6133120, 10.4607070),
(706, '47018', 'PLATO', 15, -74.7845490, 9.7967130),
(707, '47019', 'PUEBLOVIEJO', 15, -74.2825300, 10.9947660),
(708, '47020', 'REMOLINO', 15, -74.7161720, 10.7019520),
(709, '47021', 'SABANAS DE SAN ÁNGEL', 15, -74.2139460, 10.0325360),
(710, '47022', 'SALAMINA', 15, -74.7941890, 10.4912290),
(711, '47023', 'SAN SEBASTIÁN DE BUENAVISTA', 15, -74.3514980, 9.2416560),
(712, '47024', 'SAN ZENÓN', 15, -74.4989920, 9.2450610),
(713, '47025', 'SANTA ANA', 15, -74.5668450, 9.3242940),
(714, '47026', 'SANTA BÁRBARA DE PINTO', 15, -74.7046670, 9.4322630),
(715, '47027', 'SITIONUEVO', 15, -74.7200210, 10.7752850),
(716, '47028', 'TENERIFE', 15, -74.8597830, 9.8982730),
(717, '47029', 'ZAPAYÁN', 15, -74.7168780, 10.1682970),
(718, '47030', 'ZONA BANANERA', 15, -74.1400910, 10.7630240),
(719, '50001', 'VILLAVICENCIO', 16, -73.6226010, 4.1263690),
(720, '50002', 'ACACÍAS', 16, -73.7660340, 3.9904130),
(721, '50003', 'BARRANCA DE UPÍA', 16, -72.9610830, 4.5662250),
(722, '50004', 'CABUYARO', 16, -72.7917680, 4.2867050),
(723, '50005', 'CASTILLA LA NUEVA', 16, -73.6873020, 3.8300050),
(724, '50006', 'CUBARRAL', 16, -73.8379990, 3.7936530),
(725, '50007', 'CUMARAL', 16, -73.4870520, 4.2700420),
(726, '50008', 'EL CALVARIO', 16, -73.7133250, 4.3526650),
(727, '50009', 'EL CASTILLO', 16, -73.7942250, 3.5639070),
(728, '50010', 'EL DORADO', 16, -73.8352640, 3.7399840),
(729, '50011', 'FUENTE DE ORO', 16, -73.6181210, 3.4628750),
(730, '50012', 'GRANADA', 16, -73.7058150, 3.5471470),
(731, '50013', 'GUAMAL', 16, -73.7688150, 3.8796570),
(732, '50014', 'MAPIRIPÁN', 16, -72.1355090, 2.8966170),
(733, '50015', 'MESETAS', 16, -74.0443280, 3.3827320),
(734, '50016', 'LA MACARENA', 16, -73.7866100, 2.1771430),
(735, '50017', 'URIBE', 16, -74.3515080, 3.2396340),
(736, '50018', 'LEJANÍAS', 16, -74.0235140, 3.5251150),
(737, '50019', 'PUERTO CONCORDIA', 16, -72.7602090, 2.6240060),
(738, '50020', 'PUERTO GAITÁN', 16, -72.0876490, 4.3149050),
(739, '50021', 'PUERTO LÓPEZ', 16, -72.9573240, 4.0934900),
(740, '50022', 'PUERTO LLERAS', 16, -73.3738500, 3.2721170),
(741, '50023', 'PUERTO RICO', 16, -73.2063140, 2.9396210),
(742, '50024', 'RESTREPO', 16, -73.5654080, 4.2595560),
(743, '50025', 'SAN CARLOS DE GUAROA', 16, -73.2422530, 3.7106500),
(744, '50026', 'SAN JUAN DE ARAMA', 16, -73.8758320, 3.3737280),
(745, '50027', 'SAN JUANITO', 16, -73.6766990, 4.4581810),
(746, '50028', 'SAN MARTÍN', 16, -73.6958120, 3.7018990),
(747, '50029', 'VISTAHERMOSA', 16, -73.7509660, 3.1255790),
(748, '52001', 'PASTO', 17, -77.2787950, 1.2123520),
(749, '52002', 'ALBÁN', 17, -77.0807120, 1.4749780),
(750, '52003', 'ALDANA', 17, -77.7005640, 0.8823810),
(751, '52004', 'ANCUYA', 17, -77.5145120, 1.2632760),
(752, '52005', 'ARBOLEDA', 17, -77.1354670, 1.5034180),
(753, '52006', 'BARBACOAS', 17, -78.1376500, 1.6717330),
(754, '52007', 'BELÉN', 17, -77.0156190, 1.5956810),
(755, '52008', 'BUESACO', 17, -77.1564630, 1.3814530),
(756, '52009', 'COLÓN', 17, -77.0197770, 1.6438780),
(757, '52010', 'CONSACÁ', 17, -77.4661360, 1.2078540),
(758, '52011', 'CONTADERO', 17, -77.5494090, 0.9104580),
(759, '52012', 'CÓRDOBA', 17, -77.5178970, 0.8545640),
(760, '52013', 'CUASPUD CARLOSAMA', 17, -77.7289470, 0.8629780),
(761, '52014', 'CUMBAL', 17, -77.7925050, 0.9063670),
(762, '52015', 'CUMBITARA', 17, -77.5786160, 1.6471630),
(763, '52016', 'CHACHAGÜÍ', 17, -77.2818690, 1.3605450),
(764, '52017', 'EL CHARCO', 17, -78.1102170, 2.4796880),
(765, '52018', 'EL PEÑOL', 17, -77.4385220, 1.4535670),
(766, '52019', 'EL ROSARIO', 17, -77.3341700, 1.7453090),
(767, '52020', 'EL TABLÓN DE GÓMEZ', 17, -77.0971010, 1.4272770),
(768, '52021', 'EL TAMBO', 17, -77.3907720, 1.4079130),
(769, '52022', 'FUNES', 17, -77.4489130, 1.0011590),
(770, '52023', 'GUACHUCAL', 17, -77.7315890, 0.9597440),
(771, '52024', 'GUAITARILLA', 17, -77.5498240, 1.1295740),
(772, '52025', 'GUALMATÁN', 17, -77.5687010, 0.9196520),
(773, '52026', 'ILES', 17, -77.5212270, 0.9695200),
(774, '52027', 'IMUÉS', 17, -77.4963390, 1.0550600),
(775, '52028', 'IPIALES', 17, -77.6463670, 0.8277320),
(776, '52029', 'LA CRUZ', 17, -76.9705040, 1.6013180),
(777, '52030', 'LA FLORIDA', 17, -77.4028820, 1.2975300),
(778, '52031', 'LA LLANADA', 17, -77.5809100, 1.4728920),
(779, '52032', 'LA TOLA', 17, -78.1897250, 2.3989990),
(780, '52033', 'LA UNIÓN', 17, -77.1313160, 1.6002190),
(781, '52034', 'LEIVA', 17, -77.3061350, 1.9344530),
(782, '52035', 'LINARES', 17, -77.5239530, 1.3508140),
(783, '52036', 'LOS ANDES', 17, -77.5213030, 1.4945870),
(784, '52037', 'MAGÜÍ', 17, -78.1829240, 1.7656330),
(785, '52038', 'MALLAMA', 17, -77.8645490, 1.1410370),
(786, '52039', 'MOSQUERA', 17, -78.4529920, 2.5071390),
(787, '52040', 'NARIÑO', 17, -77.3579720, 1.2889790),
(788, '52041', 'OLAYA HERRERA', 17, -78.3258140, 2.3474570),
(789, '52042', 'OSPINA', 17, -77.5660820, 1.0584330),
(790, '52043', 'FRANCISCO PIZARRO', 17, -78.6583610, 2.0406290),
(791, '52044', 'POLICARPA', 17, -77.4586860, 1.6271960),
(792, '52045', 'POTOSÍ', 17, -77.5730030, 0.8066390),
(793, '52046', 'PROVIDENCIA', 17, -77.5967940, 1.2378140),
(794, '52047', 'PUERRES', 17, -77.5042110, 0.8851250),
(795, '52048', 'PUPIALES', 17, -77.6360420, 0.8704420),
(796, '52049', 'RICAURTE', 17, -77.9951530, 1.2124920),
(797, '52050', 'ROBERTO PAYÁN', 17, -78.2457160, 1.6974920),
(798, '52051', 'SAMANIEGO', 17, -77.5943410, 1.3354380),
(799, '52052', 'SANDONÁ', 17, -77.4731300, 1.2834380),
(800, '52053', 'SAN BERNARDO', 17, -77.0475000, 1.5137620),
(801, '52054', 'SAN LORENZO', 17, -77.2154200, 1.5033620),
(802, '52055', 'SAN PABLO', 17, -77.0139840, 1.6694290),
(803, '52056', 'SAN PEDRO DE CARTAGO', 17, -77.1194100, 1.5515720),
(804, '52057', 'SANTA BÁRBARA', 17, -77.9799160, 2.4496530),
(805, '52058', 'SANTACRUZ', 17, -77.6770350, 1.2225890),
(806, '52059', 'SAPUYES', 17, -77.6202800, 1.0375360),
(807, '52060', 'TAMINANGO', 17, -77.2808000, 1.5703580),
(808, '52061', 'TANGUA', 17, -77.3937350, 1.0948200),
(809, '52062', 'SAN ANDRÉS DE TUMACO', 17, -78.7640730, 1.8073990),
(810, '52063', 'TÚQUERRES', 17, -77.6167200, 1.0850440),
(811, '52064', 'YACUANQUER', 17, -77.4001690, 1.1159370),
(812, '54001', 'SAN JOSÉ DE CÚCUTA', 18, -72.5081780, 7.9057250),
(813, '54002', 'ÁBREGO', 18, -73.2217220, 8.0816160),
(814, '54003', 'ARBOLEDAS', 18, -72.7989520, 7.6429850),
(815, '54004', 'BOCHALEMA', 18, -72.6470100, 7.6121920),
(816, '54005', 'BUCARASICA', 18, -72.8682310, 8.0412990),
(817, '54006', 'CÁCOTA', 18, -72.6420590, 7.2687050),
(818, '54007', 'CÁCHIRA', 18, -73.0489830, 7.7412480),
(819, '54008', 'CHINÁCOTA', 18, -72.6011620, 7.6031120),
(820, '54009', 'CHITAGÁ', 18, -72.6654680, 7.1381870),
(821, '54010', 'CONVENCIÓN', 18, -73.3372000, 8.4703740),
(822, '54011', 'CUCUTILLA', 18, -72.7728160, 7.5396330),
(823, '54012', 'DURANIA', 18, -72.6584910, 7.7148040),
(824, '54013', 'EL CARMEN', 18, -73.4466870, 8.5105790),
(825, '54014', 'EL TARRA', 18, -73.0961400, 8.5742810),
(826, '54015', 'EL ZULIA', 18, -72.6047170, 7.9385720),
(827, '54016', 'GRAMALOTE', 18, -72.7872330, 7.9169460),
(828, '54017', 'HACARÍ', 18, -73.1459970, 8.3215060),
(829, '54018', 'HERRÁN', 18, -72.4835190, 7.5065410),
(830, '54019', 'LABATECA', 18, -72.4959830, 7.2984140),
(831, '54020', 'LA ESPERANZA', 18, -73.3281260, 7.6398390),
(832, '54021', 'LA PLAYA', 18, -73.2399860, 8.2112400),
(833, '54022', 'LOS PATIOS', 18, -72.5056120, 7.8331860),
(834, '54023', 'LOURDES', 18, -72.8323760, 7.9456310),
(835, '54024', 'MUTISCUA', 18, -72.7471690, 7.3004690),
(836, '54025', 'OCAÑA', 18, -73.3560700, 8.2485740),
(837, '54026', 'PAMPLONA', 18, -72.6477140, 7.3728020),
(838, '54027', 'PAMPLONITA', 18, -72.6391110, 7.4367450),
(839, '54028', 'PUERTO SANTANDER', 18, -72.4113630, 8.3599930),
(840, '54029', 'RAGONVALIA', 18, -72.4767080, 7.5778610),
(841, '54030', 'SALAZAR', 18, -72.8130640, 7.7736830),
(842, '54031', 'SAN CALIXTO', 18, -73.2086220, 8.4021400),
(843, '54032', 'SAN CAYETANO', 18, -72.6254590, 7.8756950),
(844, '54033', 'SANTIAGO', 18, -72.7162030, 7.8658560),
(845, '54034', 'SARDINATA', 18, -72.8005770, 8.0821050),
(846, '54035', 'SILOS', 18, -72.7571280, 7.2047360),
(847, '54036', 'TEORAMA', 18, -73.2870700, 8.4381340),
(848, '54037', 'TIBÚ', 18, -72.7344960, 8.6398910),
(849, '54038', 'TOLEDO', 18, -72.4819150, 7.3076920),
(850, '54039', 'VILLA CARO', 18, -72.9736010, 7.9142440),
(851, '54040', 'VILLA DEL ROSARIO', 18, -72.4697580, 7.8476720),
(852, '63001', 'ARMENIA', 19, -75.6807860, 4.5359800),
(853, '63002', 'BUENAVISTA', 19, -75.7395720, 4.3600290),
(854, '63003', 'CALARCÁ', 19, -75.6460850, 4.5209820),
(855, '63004', 'CIRCASIA', 19, -75.6365330, 4.6177590),
(856, '63005', 'CÓRDOBA', 19, -75.6878660, 4.3924850),
(857, '63006', 'FILANDIA', 19, -75.6583870, 4.6743380),
(858, '63007', 'GÉNOVA', 19, -75.7904020, 4.2066410),
(859, '63008', 'LA TEBAIDA', 19, -75.7868870, 4.4537550),
(860, '63009', 'MONTENEGRO', 19, -75.7498270, 4.5650570),
(861, '63010', 'PIJAO', 19, -75.7033290, 4.3350360),
(862, '63011', 'QUIMBAYA', 19, -75.7650740, 4.6243870),
(863, '63012', 'SALENTO', 19, -75.5708440, 4.6371570),
(864, '66001', 'PEREIRA', 20, -75.7197110, 4.8049850),
(865, '66002', 'APÍA', 20, -75.9423560, 5.1065260),
(866, '66003', 'BALBOA', 20, -75.9586630, 4.9490960),
(867, '66004', 'BELÉN DE UMBRÍA', 20, -75.8683340, 5.2007930),
(868, '66005', 'DOSQUEBRADAS', 20, -75.6753710, 4.8331310),
(869, '66006', 'GUÁTICA', 20, -75.7990050, 5.3153670),
(870, '66007', 'LA CELIA', 20, -76.0032000, 5.0027870),
(871, '66008', 'LA VIRGINIA', 20, -75.8803940, 4.8966240),
(872, '66009', 'MARSELLA', 20, -75.7387900, 4.9357710),
(873, '66010', 'MISTRATÓ', 20, -75.8828860, 5.2970390),
(874, '66011', 'PUEBLO RICO', 20, -76.0308010, 5.2220430),
(875, '66012', 'QUINCHÍA', 20, -75.7304310, 5.3404560),
(876, '66013', 'SANTA ROSA DE CABAL', 20, -75.6232680, 4.8762710),
(877, '66014', 'SANTUARIO', 20, -75.9646280, 5.0749110),
(878, '68001', 'BUCARAMANGA', 21, -73.1325620, 7.1164700),
(879, '68002', 'AGUADA', 21, -73.5231320, 6.1623550),
(880, '68003', 'ALBANIA', 21, -73.9133600, 5.7591660),
(881, '68004', 'ARATOCA', 21, -73.0178600, 6.6944180),
(882, '68005', 'BARBOSA', 21, -73.6159650, 5.9325310),
(883, '68006', 'BARICHARA', 21, -73.2230470, 6.6341110),
(884, '68007', 'BARRANCABERMEJA', 21, -73.8492430, 7.0648570),
(885, '68008', 'BETULIA', 21, -73.2836690, 6.8995250),
(886, '68009', 'BOLÍVAR', 21, -73.7713460, 5.9889530),
(887, '68010', 'CABRERA', 21, -73.2464750, 6.5921180),
(888, '68011', 'CALIFORNIA', 21, -72.9464910, 7.3479890),
(889, '68012', 'CAPITANEJO', 21, -72.6954270, 6.5273940),
(890, '68013', 'CARCASÍ', 21, -72.6270990, 6.6290160),
(891, '68014', 'CEPITÁ', 21, -72.9735360, 6.7535180),
(892, '68015', 'CERRITO', 21, -72.6948510, 6.8404050),
(893, '68016', 'CHARALÁ', 21, -73.1468730, 6.2843390),
(894, '68017', 'CHARTA', 21, -72.9687980, 7.2808200),
(895, '68018', 'CHIMA', 21, -73.3736560, 6.3443480),
(896, '68019', 'CHIPATÁ', 21, -73.6371110, 6.0625210),
(897, '68020', 'CIMITARRA', 21, -73.9530110, 6.3208860),
(898, '68021', 'CONCEPCIÓN', 21, -72.6945670, 6.7689080),
(899, '68022', 'CONFINES', 21, -73.2405540, 6.3573270),
(900, '68023', 'CONTRATACIÓN', 21, -73.4744260, 6.2905610),
(901, '68024', 'COROMORO', 21, -73.0408160, 6.2949990),
(902, '68025', 'CURITÍ', 21, -73.0693830, 6.6050990),
(903, '68026', 'EL CARMEN DE CHUCURÍ', 21, -73.5106600, 6.7000380),
(904, '68027', 'EL GUACAMAYO', 21, -73.4969080, 6.2451110),
(905, '68028', 'EL PEÑÓN', 21, -73.8155320, 6.0553700),
(906, '68029', 'EL PLAYÓN', 21, -73.2028700, 7.4707150),
(907, '68030', 'ENCINO', 21, -73.0987490, 6.1374290),
(908, '68031', 'ENCISO', 21, -72.6996470, 6.6680340),
(909, '68032', 'FLORIÁN', 21, -73.9714300, 5.8046590),
(910, '68033', 'FLORIDABLANCA', 21, -73.0991040, 7.0723290),
(911, '68034', 'GALÁN', 21, -73.2877690, 6.6384230),
(912, '68035', 'GÁMBITA', 21, -73.3441850, 5.9459980),
(913, '68036', 'GIRÓN', 21, -73.1668320, 7.0704320),
(914, '68037', 'GUACA', 21, -72.8563220, 6.8765630),
(915, '68038', 'GUADALUPE', 21, -73.4192920, 6.2458470),
(916, '68039', 'GUAPOTÁ', 21, -73.3207320, 6.3086350),
(917, '68040', 'GUAVATÁ', 21, -73.7009060, 5.9543480),
(918, '68041', 'GÜEPSA', 21, -73.5751460, 6.0250130),
(919, '68042', 'HATO', 21, -73.3083990, 6.5439570),
(920, '68043', 'JESÚS MARÍA', 21, -73.7833960, 5.8764970),
(921, '68044', 'JORDÁN', 21, -73.0960530, 6.7327270),
(922, '68045', 'LA BELLEZA', 21, -73.9654940, 5.8592500),
(923, '68046', 'LANDÁZURI', 21, -73.8113590, 6.2188120),
(924, '68047', 'LA PAZ', 21, -73.5895900, 6.1785090),
(925, '68048', 'LEBRIJA', 21, -73.2195240, 7.1133510),
(926, '68049', 'LOS SANTOS', 21, -73.1027390, 6.7552030),
(927, '68050', 'MACARAVITA', 21, -72.5931050, 6.5065800),
(928, '68051', 'MÁLAGA', 21, -72.7320890, 6.7030810),
(929, '68052', 'MATANZA', 21, -73.0155660, 7.3231750),
(930, '68053', 'MOGOTES', 21, -72.9698070, 6.4752460),
(931, '68054', 'MOLAGAVITA', 21, -72.8091750, 6.6743200),
(932, '68055', 'OCAMONTE', 21, -73.1225630, 6.3399880),
(933, '68056', 'OIBA', 21, -73.2997910, 6.2652100),
(934, '68057', 'ONZAGA', 21, -72.8167660, 6.3441040),
(935, '68058', 'PALMAR', 21, -73.2910900, 6.5377890),
(936, '68059', 'PALMAS DEL SOCORRO', 21, -73.2877640, 6.4061390),
(937, '68060', 'PÁRAMO', 21, -73.1702200, 6.4168110),
(938, '68061', 'PIEDECUESTA', 21, -73.0547950, 6.9972450),
(939, '68062', 'PINCHOTE', 21, -73.1742090, 6.5315520),
(940, '68063', 'PUENTE NACIONAL', 21, -73.6775670, 5.8783810),
(941, '68064', 'PUERTO PARRA', 21, -74.0561290, 6.6507850),
(942, '68065', 'PUERTO WILCHES', 21, -73.8999090, 7.3440570),
(943, '68066', 'RIONEGRO', 21, -73.1501770, 7.2650140),
(944, '68067', 'SABANA DE TORRES', 21, -73.4990600, 7.3919190),
(945, '68068', 'SAN ANDRÉS', 21, -72.8488640, 6.8115110),
(946, '68069', 'SAN BENITO', 21, -73.5090700, 6.1266560),
(947, '68070', 'SAN GIL', 21, -73.1347760, 6.5519520),
(948, '68071', 'SAN JOAQUÍN', 21, -72.8676380, 6.4275480);
INSERT INTO `municipio` (`id`, `codigo`, `nombre`, `departamento`, `lon`, `lat`) VALUES
(949, '68072', 'SAN JOSÉ DE MIRANDA', 21, -72.7336160, 6.6589950),
(950, '68073', 'SAN MIGUEL', 21, -72.6441230, 6.5753150),
(951, '68074', 'SAN VICENTE DE CHUCURÍ', 21, -73.4110240, 6.8803830),
(952, '68075', 'SANTA BÁRBARA', 21, -72.9074450, 6.9909960),
(953, '68076', 'SANTA HELENA DEL OPÓN', 21, -73.6167160, 6.3395650),
(954, '68077', 'SIMACOTA', 21, -73.3373680, 6.4434690),
(955, '68078', 'SOCORRO', 21, -73.2611980, 6.4638700),
(956, '68079', 'SUAITA', 21, -73.4416500, 6.1013290),
(957, '68080', 'SUCRE', 21, -73.7909750, 5.9187430),
(958, '68081', 'SURATÁ', 21, -72.9842320, 7.3665800),
(959, '68082', 'TONA', 21, -72.9670230, 7.2014170),
(960, '68083', 'VALLE DE SAN JOSÉ', 21, -73.1435070, 6.4480280),
(961, '68084', 'VÉLEZ', 21, -73.6724470, 6.0092750),
(962, '68085', 'VETAS', 21, -72.8710410, 7.3098100),
(963, '68086', 'VILLANUEVA', 21, -73.1743070, 6.6700780),
(964, '68087', 'ZAPATOCA', 21, -73.2680340, 6.8143870),
(965, '70001', 'SINCELEJO', 22, -75.3954450, 9.3023220),
(966, '70002', 'BUENAVISTA', 22, -74.9728270, 9.3197940),
(967, '70003', 'CAIMITO', 22, -75.1171410, 8.7893240),
(968, '70004', 'COLOSÓ', 22, -75.3532560, 9.4941920),
(969, '70005', 'COROZAL', 22, -75.2930480, 9.3187490),
(970, '70006', 'COVEÑAS', 22, -75.6801580, 9.4027790),
(971, '70007', 'CHALÁN', 22, -75.3126970, 9.5453520),
(972, '70008', 'EL ROBLE', 22, -75.1983780, 9.1006470),
(973, '70009', 'GALERAS', 22, -75.0495900, 9.1603790),
(974, '70010', 'GUARANDA', 22, -74.5377490, 8.4685560),
(975, '70011', 'LA UNIÓN', 22, -75.2760560, 8.8539750),
(976, '70012', 'LOS PALMITOS', 22, -75.2687160, 9.3802690),
(977, '70013', 'MAJAGUAL', 22, -74.6280770, 8.5411630),
(978, '70014', 'MORROA', 22, -75.3059490, 9.3313950),
(979, '70015', 'OVEJAS', 22, -75.2290370, 9.5271760),
(980, '70016', 'PALMITO', 22, -75.5412640, 9.3331570),
(981, '70017', 'SAMPUÉS', 22, -75.3802220, 9.1831930),
(982, '70018', 'SAN BENITO ABAD', 22, -75.0310890, 8.9301080),
(983, '70019', 'SAN JUAN DE BETULIA', 22, -75.2435650, 9.2730660),
(984, '70020', 'SAN MARCOS', 22, -75.1338310, 8.6617740),
(985, '70021', 'SAN ONOFRE', 22, -75.5223980, 9.7369550),
(986, '70022', 'SAN PEDRO', 22, -75.0636470, 9.3962500),
(987, '70023', 'SAN LUIS DE SINCÉ', 22, -75.1459990, 9.2443080),
(988, '70024', 'SUCRE', 22, -74.7231750, 8.8117370),
(989, '70025', 'SANTIAGO DE TOLÚ', 22, -75.5811120, 9.5253870),
(990, '70026', 'SAN JOSÉ DE TOLUVIEJO', 22, -75.4408500, 9.4518190),
(991, '73001', 'IBAGUÉ', 23, -75.1942500, 4.4322480),
(992, '73002', 'ALPUJARRA', 23, -74.9329000, 3.3915480),
(993, '73003', 'ALVARADO', 23, -74.9534180, 4.5673560),
(994, '73004', 'AMBALEMA', 23, -74.7644290, 4.7826820),
(995, '73005', 'ANZOÁTEGUI', 23, -75.0937720, 4.6317560),
(996, '73006', 'ARMERO', 23, -74.8844380, 5.0307440),
(997, '73007', 'ATACO', 23, -75.3825450, 3.5905910),
(998, '73008', 'CAJAMARCA', 23, -75.4319710, 4.4388120),
(999, '73009', 'CARMEN DE APICALÁ', 23, -74.7176330, 4.1523340),
(1000, '73010', 'CASABIANCA', 23, -75.1209660, 5.0781040),
(1001, '73011', 'CHAPARRAL', 23, -75.4807650, 3.7229180),
(1002, '73012', 'COELLO', 23, -74.8984640, 4.2872760),
(1003, '73013', 'COYAIMA', 23, -75.1938620, 3.7980360),
(1004, '73014', 'CUNDAY', 23, -74.6922270, 4.0592590),
(1005, '73015', 'DOLORES', 23, -74.8967610, 3.5390720),
(1006, '73016', 'ESPINAL', 23, -74.8854460, 4.1513140),
(1007, '73017', 'FALAN', 23, -74.9530070, 5.1231040),
(1008, '73018', 'FLANDES', 23, -74.8187630, 4.2763730),
(1009, '73019', 'FRESNO', 23, -75.0357220, 5.1535760),
(1010, '73020', 'GUAMO', 23, -74.9681350, 4.0309920),
(1011, '73021', 'HERVEO', 23, -75.1771510, 5.0802280),
(1012, '73022', 'HONDA', 23, -74.7569900, 5.2118160),
(1013, '73023', 'ICONONZO', 23, -74.5319690, 4.1764870),
(1014, '73024', 'LÉRIDA', 23, -74.9107160, 4.8620460),
(1015, '73025', 'LÍBANO', 23, -75.0619590, 4.9204200),
(1016, '73026', 'SAN SEBASTIÁN DE MARIQUITA', 23, -74.8892760, 5.1997080),
(1017, '73027', 'MELGAR', 23, -74.6413170, 4.2036550),
(1018, '73028', 'MURILLO', 23, -75.1710220, 4.8743410),
(1019, '73029', 'NATAGAIMA', 23, -75.0931820, 3.6243240),
(1020, '73030', 'ORTEGA', 23, -75.2226010, 3.9349160),
(1021, '73031', 'PALOCABILDO', 23, -75.0221670, 5.1209180),
(1022, '73032', 'PIEDRAS', 23, -74.8781060, 4.5439510),
(1023, '73033', 'PLANADAS', 23, -75.6441630, 3.1979110),
(1024, '73034', 'PRADO', 23, -74.9274470, 3.7509390),
(1025, '73035', 'PURIFICACIÓN', 23, -74.9355550, 3.8572460),
(1026, '73036', 'RIOBLANCO', 23, -75.6440690, 3.5299320),
(1027, '73037', 'RONCESVALLES', 23, -75.6059590, 4.0115670),
(1028, '73038', 'ROVIRA', 23, -75.2406480, 4.2390190),
(1029, '73039', 'SALDAÑA', 23, -75.0168520, 3.9298150),
(1030, '73040', 'SAN ANTONIO', 23, -75.4800740, 3.9141460),
(1031, '73041', 'SAN LUIS', 23, -75.0958040, 4.1337210),
(1032, '73042', 'SANTA ISABEL', 23, -75.0979340, 4.7136060),
(1033, '73043', 'SUÁREZ', 23, -74.8318850, 4.0488910),
(1034, '73044', 'VALLE DE SAN JUAN', 23, -75.1156690, 4.1974940),
(1035, '73045', 'VENADILLO', 23, -74.9293330, 4.7178780),
(1036, '73046', 'VILLAHERMOSA', 23, -75.1177290, 5.0304520),
(1037, '73047', 'VILLARRICA', 23, -74.6002850, 3.9369020),
(1038, '76001', 'SANTIAGO DE CALI', 24, -76.5213300, 3.4136860),
(1039, '76002', 'ALCALÁ', 24, -75.7797920, 4.6749940),
(1040, '76003', 'ANDALUCÍA', 24, -76.1679250, 4.1717130),
(1041, '76004', 'ANSERMANUEVO', 24, -75.9920030, 4.7949840),
(1042, '76005', 'ARGELIA', 24, -76.1199050, 4.7269450),
(1043, '76006', 'BOLÍVAR', 24, -76.1835830, 4.3378460),
(1044, '76007', 'BUENAVENTURA', 24, -77.0107400, 3.8757080),
(1045, '76008', 'GUADALAJARA DE BUGA', 24, -76.2989790, 3.9007360),
(1046, '76009', 'BUGALAGRANDE', 24, -76.1568200, 4.2083580),
(1047, '76010', 'CAICEDONIA', 24, -75.8305940, 4.3348080),
(1048, '76011', 'CALIMA', 24, -76.4841320, 3.9336640),
(1049, '76012', 'CANDELARIA', 24, -76.3465190, 3.4083540),
(1050, '76013', 'CARTAGO', 24, -75.9243740, 4.7421920),
(1051, '76014', 'DAGUA', 24, -76.6888600, 3.6573180),
(1052, '76015', 'EL ÁGUILA', 24, -76.0427790, 4.9060620),
(1053, '76016', 'EL CAIRO', 24, -76.2216110, 4.7608740),
(1054, '76017', 'EL CERRITO', 24, -76.3119720, 3.6842290),
(1055, '76018', 'EL DOVIO', 24, -76.2370840, 4.5104520),
(1056, '76019', 'FLORIDA', 24, -76.2341990, 3.3241180),
(1057, '76020', 'GINEBRA', 24, -76.2680680, 3.7241810),
(1058, '76021', 'GUACARÍ', 24, -76.3309110, 3.7618150),
(1059, '76022', 'JAMUNDÍ', 24, -76.5384720, 3.2587510),
(1060, '76023', 'LA CUMBRE', 24, -76.5680500, 3.6492680),
(1061, '76024', 'LA UNIÓN', 24, -76.0996610, 4.5338690),
(1062, '76025', 'LA VICTORIA', 24, -76.0365290, 4.5236030),
(1063, '76026', 'OBANDO', 24, -75.9747090, 4.5757120),
(1064, '76027', 'PALMIRA', 24, -76.2988460, 3.5315440),
(1065, '76028', 'PRADERA', 24, -76.2417990, 3.4197930),
(1066, '76029', 'RESTREPO', 24, -76.5233290, 3.8213510),
(1067, '76030', 'RIOFRÍO', 24, -76.2883130, 4.1569080),
(1068, '76031', 'ROLDANILLO', 24, -76.1522770, 4.4136010),
(1069, '76032', 'SAN PEDRO', 24, -76.2286920, 3.9950730),
(1070, '76033', 'SEVILLA', 24, -75.9316290, 4.2707140),
(1071, '76034', 'TORO', 24, -76.0768590, 4.6080850),
(1072, '76035', 'TRUJILLO', 24, -76.3188180, 4.2120370),
(1073, '76036', 'TULUÁ', 24, -76.1977310, 4.0853990),
(1074, '76037', 'ULLOA', 24, -75.7378080, 4.7036230),
(1075, '76038', 'VERSALLES', 24, -76.1992030, 4.5750190),
(1076, '76039', 'VIJES', 24, -76.4418040, 3.6986860),
(1077, '76040', 'YOTOCO', 24, -76.3826980, 3.8612410),
(1078, '76041', 'YUMBO', 24, -76.4998930, 3.5400970),
(1079, '76042', 'ZARZAL', 24, -76.0707950, 4.3926580),
(1080, '81001', 'ARAUCA', 25, -70.7474080, 7.0727260),
(1081, '81002', 'ARAUQUITA', 25, -71.4267330, 7.0270200),
(1082, '81003', 'CRAVO NORTE', 25, -70.2042860, 6.3039130),
(1083, '81004', 'FORTUL', 25, -71.7687700, 6.7966950),
(1084, '81005', 'PUERTO RONDÓN', 25, -71.1033900, 6.2814610),
(1085, '81006', 'SARAVENA', 25, -71.8728120, 6.9539260),
(1086, '81007', 'TAME', 25, -71.7544270, 6.4533240),
(1087, '85001', 'YOPAL', 26, -72.3961320, 5.3271020),
(1088, '85002', 'AGUAZUL', 26, -72.5468380, 5.1726410),
(1089, '85003', 'CHÁMEZA', 26, -72.8701600, 5.2145270),
(1090, '85004', 'HATO COROZAL', 26, -71.7642130, 6.1540990),
(1091, '85005', 'LA SALINA', 26, -72.3349780, 6.1277620),
(1092, '85006', 'MANÍ', 26, -72.2813840, 4.8168100),
(1093, '85007', 'MONTERREY', 26, -72.8940650, 4.8770170),
(1094, '85008', 'NUNCHÍA', 26, -72.1953230, 5.6364740),
(1095, '85009', 'OROCUÉ', 26, -71.3385330, 4.7902580),
(1096, '85010', 'PAZ DE ARIPORO', 26, -71.8903480, 5.8798270),
(1097, '85011', 'PORE', 26, -71.9928600, 5.7277300),
(1098, '85012', 'RECETOR', 26, -72.7609910, 5.2291810),
(1099, '85013', 'SABANALARGA', 26, -73.0386960, 4.8547870),
(1100, '85014', 'SÁCAMA', 26, -72.2501570, 6.0967380),
(1101, '85015', 'SAN LUIS DE PALENQUE', 26, -71.7321980, 5.4223970),
(1102, '85016', 'TÁMARA', 26, -72.1616500, 5.8295430),
(1103, '85017', 'TAURAMENA', 26, -72.7466200, 5.0189770),
(1104, '85018', 'TRINIDAD', 26, -71.6628120, 5.4121780),
(1105, '85019', 'VILLANUEVA', 26, -72.9277970, 4.6103500),
(1106, '86001', 'MOCOA', 27, -76.6542380, 1.1511720),
(1107, '86002', 'COLÓN', 27, -76.9725660, 1.1901330),
(1108, '86003', 'ORITO', 27, -76.8732760, 0.6635930),
(1109, '86004', 'PUERTO ASÍS', 27, -76.4968870, 0.5056270),
(1110, '86005', 'PUERTO CAICEDO', 27, -76.6061180, 0.6877840),
(1111, '86006', 'PUERTO GUZMÁN', 27, -76.4076630, 0.9628540),
(1112, '86007', 'PUERTO LEGUÍZAMO', 27, -74.7818420, -0.1923180),
(1113, '86008', 'SIBUNDOY', 27, -76.9178140, 1.2002600),
(1114, '86009', 'SAN FRANCISCO', 27, -76.8792830, 1.1741940),
(1115, '86010', 'SAN MIGUEL', 27, -76.9121700, 0.3434600),
(1116, '86011', 'SANTIAGO', 27, -77.0026410, 1.1470760),
(1117, '86012', 'VALLE DEL GUAMUEZ', 27, -76.9067510, 0.4235060),
(1118, '86013', 'VILLAGARZÓN', 27, -76.6172100, 1.0288210),
(1119, '88001', 'SAN ANDRÉS', 28, -81.7071810, 12.5781080),
(1120, '88002', 'PROVIDENCIA', 28, -81.3683860, 13.3731850),
(1121, '91001', 'LETICIA', 29, -69.9417210, -4.1989500),
(1122, '91002', 'EL ENCANTO', 29, -73.2071140, -1.7480600),
(1123, '91003', 'LA CHORRERA', 29, -72.7918890, -1.4426170),
(1124, '91004', 'LA PEDRERA', 29, -69.5854990, -1.3203010),
(1125, '91005', 'LA VICTORIA', 29, -71.2232080, 0.0549360),
(1126, '91006', 'MIRITÍ - PARANÁ', 29, -70.9889300, -0.8888330),
(1127, '91007', 'PUERTO ALEGRÍA', 29, -74.0144610, -1.0056740),
(1128, '91008', 'PUERTO ARICA', 29, -71.7521860, -2.1470390),
(1129, '91009', 'PUERTO NARIÑO', 29, -70.3649370, -3.7799340),
(1130, '91010', 'PUERTO SANTANDER', 29, -72.3842130, -0.6211840),
(1131, '91011', 'TARAPACÁ', 29, -69.7417450, -2.8901260),
(1132, '94001', 'INÍRIDA', 30, -67.9186130, 3.8667640),
(1133, '94002', 'BARRANCOMINAS', 30, -69.8140660, 3.4941780),
(1134, '94003', 'SAN FELIPE', 30, -67.0678480, 1.9124950),
(1135, '94004', 'PUERTO COLOMBIA', 30, -67.5667740, 2.7264380),
(1136, '94005', 'LA GUADALUPE', 30, -66.9636920, 1.6324640),
(1137, '94006', 'CACAHUAL', 30, -67.4133120, 3.5261700),
(1138, '94007', 'PANA PANA', 30, -69.0099000, 1.8656680),
(1139, '94008', 'MORICHAL', 30, -69.9194040, 2.2651320),
(1140, '95001', 'SAN JOSÉ DEL GUAVIARE', 31, -72.6392540, 2.5659320),
(1141, '95002', 'CALAMAR', 31, -72.6551970, 1.9609820),
(1142, '95003', 'EL RETORNO', 31, -72.6273040, 2.3301640),
(1143, '95004', 'MIRAFLORES', 31, -71.9504160, 1.3375390),
(1144, '97001', 'MITÚ', 32, -70.2326410, 1.2531510),
(1145, '97002', 'CARURÚ', 32, -71.3022100, 1.0161160),
(1146, '97003', 'PACOA', 32, -71.0043390, 0.0206980),
(1147, '97004', 'TARAIRA', 32, -69.6354970, -0.5649840),
(1148, '97005', 'PAPUNAHUA', 32, -70.7609100, 1.9081240),
(1149, '97006', 'YAVARATÉ', 32, -69.2033370, 0.6091420),
(1150, '99001', 'PUERTO CARREÑO', 33, -67.4870950, 6.1866360),
(1151, '99002', 'LA PRIMAVERA', 33, -70.4105150, 5.4863090),
(1152, '99003', 'SANTA ROSALÍA', 33, -70.8594990, 5.1363930),
(1153, '99004', 'CUMARIBO', 33, -69.7955330, 4.4463520);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `creado` datetime NOT NULL,
  `por` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `nombre`, `codigo`, `creado`, `por`) VALUES
(1, 'Superadmin', 'superadmin', '0000-00-00 00:00:00', 0),
(3, 'Banco', 'banco', '0000-00-00 00:00:00', 0),
(4, 'Bodega', 'bodega', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_rol`
--

CREATE TABLE `perfil_rol` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perfil` bigint(20) UNSIGNED NOT NULL,
  `rol` bigint(20) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL,
  `por` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `perfil_rol`
--

INSERT INTO `perfil_rol` (`id`, `perfil`, `rol`, `creado`, `por`) VALUES
(3, 1, 2, '2025-04-28 08:07:30', 0),
(10, 1, 6, '2025-05-05 06:51:44', 0),
(11, 4, 3, '2025-05-05 17:11:36', 0),
(12, 4, 4, '2025-05-05 17:11:44', 0),
(17, 3, 6, '2025-05-06 11:13:11', 0),
(18, 3, 9, '2025-05-15 15:58:38', 0),
(20, 1, 9, '2025-05-18 17:22:13', 0),
(21, 1, 10, '2025-05-18 17:25:14', 0),
(22, 3, 7, '2025-05-18 19:59:30', 0),
(24, 4, 8, '2025-05-18 21:05:34', 0),
(25, 1, 7, '2025-05-18 21:07:20', 0),
(26, 3, 10, '2025-05-19 10:38:34', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `placas`
--

CREATE TABLE `placas` (
  `id` int(11) NOT NULL,
  `placa` varchar(50) NOT NULL,
  `creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `placas`
--

INSERT INTO `placas` (`id`, `placa`, `creacion`) VALUES
(1, 'Placa 1', '2025-05-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `unidad` varchar(50) NOT NULL,
  `subcategoria` varchar(50) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `valor_comercial` decimal(10,2) NOT NULL,
  `etiqueta` varchar(100) DEFAULT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `por` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `codigo`, `nombre`, `unidad`, `subcategoria`, `observaciones`, `valor_comercial`, `etiqueta`, `creado`, `por`) VALUES
(2, 'AR', 'Arroz', 'kg', '1', 'producto de arroz2', 800000.00, '123213', '2025-05-27 12:34:43', 1),
(3, 'PA', 'PAPA', 'kg', '1', 'Libra de papa', 800000.00, NULL, '2025-06-03 18:24:05', 1),
(4, 'PA', 'PAPA', 'kg', '1', 'Libra de papa', 800000.00, NULL, '2025-06-03 18:24:43', 1),
(5, 'PT', 'Pastas', 'kg', '1', 'Bolsa de pastas', 10000.00, NULL, '2025-06-03 18:25:38', 1),
(6, 'SA', 'Salsa', 'kg', '1', 'Salsa fruko', 9000.00, NULL, '2025-06-03 18:26:17', 1),
(7, 'JA', 'Jabon', 'kg', '1', 'Jabon ', 12342.00, '0', '2025-06-03 18:27:29', 1),
(8, 'LE', 'Legumbre', 'kg', '1', 'La legumbre', 30000.00, '0', '2025-06-03 18:49:38', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_institucion`
--

CREATE TABLE `producto_institucion` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `institucion` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `por` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_institucion`
--

INSERT INTO `producto_institucion` (`id`, `producto_id`, `institucion`, `tipo`, `creado`, `por`) VALUES
(8, 2, 0, 'abaco', '2025-06-03 18:23:25', 1),
(9, 3, 0, 'abaco', '2025-06-03 18:24:05', 1),
(10, 4, 0, 'abaco', '2025-06-03 18:24:43', 1),
(11, 5, 0, 'abaco', '2025-06-03 18:25:38', 1),
(12, 6, 0, 'abaco', '2025-06-03 18:26:17', 1),
(13, 7, 0, 'abaco', '2025-06-03 18:27:29', 1),
(14, 8, 1, 'banco', '2025-06-03 18:49:38', 1);

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

--
-- Volcado de datos para la tabla `recibido`
--

INSERT INTO `recibido` (`id`, `nombre`, `documento`, `tipo`, `creacion`) VALUES
(1, 'Entregado1', '123213213', 1, '2025-05-12'),
(2, 'Recibido1 ', '324432432', 2, '2025-05-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `categoria` bigint(20) NOT NULL,
  `creado` datetime NOT NULL,
  `por` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `categoria`, `creado`, `por`) VALUES
(2, 'Seguridad', 0, '0000-00-00 00:00:00', 0),
(3, 'Control de entradas', 0, '0000-00-00 00:00:00', 0),
(4, 'Control de Salidas', 0, '0000-00-00 00:00:00', 0),
(6, 'General', 0, '0000-00-00 00:00:00', 0),
(7, 'Banco Administrador', 0, '0000-00-00 00:00:00', 0),
(8, 'Bodega Administrador', 0, '0000-00-00 00:00:00', 0),
(9, 'Historial Entradas', 0, '0000-00-00 00:00:00', 0),
(10, 'Historial Salidas', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_funcionalidad`
--

CREATE TABLE `rol_funcionalidad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rol` bigint(20) UNSIGNED NOT NULL,
  `funcionalidad` bigint(20) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL,
  `por` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_modulo`
--

CREATE TABLE `rol_modulo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rol` bigint(20) UNSIGNED NOT NULL,
  `modulo` bigint(20) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL,
  `por` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `rol_modulo`
--

INSERT INTO `rol_modulo` (`id`, `rol`, `modulo`, `creado`, `por`) VALUES
(7, 2, 8, '2025-05-03 09:35:10', 0),
(8, 2, 9, '2025-05-03 09:41:09', 0),
(9, 2, 6, '2025-05-03 09:55:10', 0),
(10, 2, 10, '2025-05-03 09:55:16', 0),
(11, 2, 11, '2025-05-03 09:55:19', 0),
(12, 2, 12, '2025-05-03 09:55:23', 0),
(14, 3, 14, '2025-05-03 14:02:34', 0),
(15, 4, 16, '2025-05-03 14:19:09', 0),
(17, 3, 17, '2025-05-03 15:57:25', 0),
(18, 4, 18, '2025-05-04 21:31:44', 0),
(19, 6, 20, '2025-05-05 06:51:33', 0),
(20, 6, 22, '2025-05-05 07:37:42', 0),
(21, 6, 23, '2025-05-05 07:37:46', 0),
(22, 6, 24, '2025-05-05 07:37:49', 0),
(23, 7, 26, '2025-05-06 10:49:48', 0),
(24, 7, 27, '2025-05-06 10:49:51', 0),
(25, 8, 27, '2025-05-06 11:09:31', 0),
(26, 9, 17, '2025-05-15 15:58:24', 0),
(27, 10, 18, '2025-05-18 17:25:04', 0),
(28, 6, 28, '2025-05-27 12:03:34', 0),
(29, 6, 29, '2025-06-02 21:37:06', 0),
(30, 6, 30, '2025-06-03 06:52:04', 0);

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
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoria` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `creado` timestamp NOT NULL DEFAULT current_timestamp(),
  `por` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `categoria`, `nombre`, `codigo`, `descripcion`, `creado`, `por`) VALUES
(1, 1, 'Cereales', 'CER', 'Cereales y granos', '2025-06-03 11:56:47', 0),
(5, 1, 'Panadería', 'PAN', 'Panadería', '2025-06-04 19:23:06', 0),
(6, 1, 'Tubérculos y Raíces', 'TUB', 'Tubérculos y Raíces', '2025-06-04 19:23:06', 0),
(7, 2, 'Plátanos', 'PLA', 'Plátanos', '2025-06-04 19:23:06', 0),
(8, 2, 'Frutas', 'FRU', 'Frutas', '2025-06-04 19:23:06', 0),
(9, 3, 'Verduras', 'VER', 'Verduras', '2025-06-04 19:23:06', 0),
(10, 3, 'Carnes', 'CAR', 'Carnes', '2025-06-04 19:23:06', 0),
(11, 3, 'Huevos', 'HUE', 'Huevos', '2025-06-04 19:23:06', 0),
(12, 4, 'Leguminosas', 'LEG', 'Leguminosas', '2025-06-04 19:23:06', 0),
(13, 4, 'Leches', 'LEC', 'Leches', '2025-06-04 19:23:06', 0),
(14, 5, 'Lácteos', 'LAC', 'Lácteos', '2025-06-04 19:23:06', 0),
(15, 5, 'Grasas tipo 1', 'GRA1', 'Grasas tipo 1', '2025-06-04 19:23:06', 0),
(16, 6, 'Grasas tipo 2', 'GRA2', 'Grasas tipo 2', '2025-06-04 19:23:06', 0),
(17, 6, 'Azúcares', 'AZU', 'Azúcares', '2025-06-04 19:23:06', 0),
(18, 7, 'Dulces y postres', 'DUL', 'Dulces y postres', '2025-06-04 19:23:06', 0),
(19, 7, 'Agua', 'AGU', 'Agua', '2025-06-04 19:23:06', 0),
(20, 8, 'Otras Bebidas', 'OBB', 'Otras Bebidas', '2025-06-04 19:23:06', 0),
(21, 9, 'Bebidas Alcohólicas', 'BBAL', 'Bebidas Alcohólicas', '2025-06-04 19:23:06', 0),
(22, 9, 'Paquetes /Snacks', 'SNA', 'Paquetes /Snacks', '2025-06-04 19:23:06', 0),
(23, 10, 'Fórmulas infantiles', 'FORI', 'Fórmulas infantiles', '2025-06-04 19:23:06', 0),
(24, 11, 'Otras fórmulas', 'FORE', 'Otras fórmulas', '2025-06-04 19:23:06', 0),
(25, 11, 'Comidas preparadas', 'COMP', 'Comidas preparadas', '2025-06-04 19:23:06', 0),
(26, 12, 'Otros alimentos', 'OTR', 'Otros alimentos', '2025-06-04 19:23:06', 0),
(27, 13, 'Alimentos para mascotas', 'APM', 'Alimentos para mascotas', '2025-06-04 19:23:06', 0),
(28, 14, 'Accesorios mascotas', 'ACM', 'Accesorios mascotas', '2025-06-04 19:23:06', 0),
(29, 14, 'Aseo', 'ASE', 'Aseo', '2025-06-04 19:23:06', 0),
(30, 15, 'Electrodomésticos', 'ELEC', 'Electrodomésticos', '2025-06-04 19:23:06', 0),
(31, 16, 'Equipos Tecnología', 'EQT', 'Equipos Tecnología', '2025-06-04 19:23:06', 0),
(32, 16, 'Muebles', 'MUE', 'Muebles', '2025-06-04 19:23:06', 0),
(33, 16, 'Papelería', 'PAP', 'Papelería', '2025-06-04 19:23:06', 0),
(34, 16, 'Textiles', 'TEX', 'Textiles', '2025-06-04 19:23:06', 0),
(35, 16, 'Cosméticos y bisutería', 'CBI', 'Cosméticos y bisutería', '2025-06-04 19:23:06', 0),
(36, 16, 'Medicamentos', 'MED', 'Medicamentos', '2025-06-04 19:23:06', 0);

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

--
-- Volcado de datos para la tabla `tipo_benefactor`
--

INSERT INTO `tipo_benefactor` (`id`, `nombre`, `nit`, `codigo`, `creacion`) VALUES
(1, 'Beneficiario1', '12321321', 'b1', '2025-05-12');

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

--
-- Volcado de datos para la tabla `tipo_beneficiado`
--

INSERT INTO `tipo_beneficiado` (`id`, `nombre`, `nit`, `municipio`, `poblacion`, `creacion`, `idZona`, `nombreLaborSocial`, `dv`, `contactoInstitucional`, `cargo`, `telefono`, `celular`, `email`, `departamento`, `subRegion`, `comuna`, `barrio`, `zonaUrbanaORural`, `direccion`, `recomienda`, `protocoloBio`, `fechaEntrega`, `frecuenciaDonacion`, `diaDonacion`, `semanaDonacion`, `frecuenciaServicioC`, `diaServicioC`, `semanaServicioC`, `jornadaServicioC`, `adultoMayor`, `proteccionNin`, `proteccionNinias`, `proteccionNinios`, `hogarDePaso`, `comedor`, `comunidadReligiosaOLaicos`, `SeminaristasOreligiosos`, `familiasVulnerables`, `capacitacionFormacion`, `arteCultura`, `deporte`, `EnfermosYDesvalidos`, `educacion`, `nutricion`, `legal`, `espiritual`, `salud`, `recreacion`, `vivienda`, `artes`, `artesaniasYManualidades`, `biblioteca`, `computadores`, `costuraYCofeccion`, `consutorioYDispensario`, `culinariaYPanaderia`, `ludoteca`, `musica`, `pintura`, `peluqueriaYBelleza`, `ventasDeRopero`, `otros`, `cuales`, `aniosUltimaVisita`, `estado`) VALUES
(1, 'Benefactor2', '12321321321', 'medellin', NULL, '2025-05-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id`, `nombre`, `codigo`, `creacion`) VALUES
(1, 'FRUVER', 'FRU', '2025-05-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `token` varchar(64) DEFAULT NULL,
  `tipo` bigint(20) NOT NULL,
  `categoria` bigint(20) NOT NULL,
  `creado` datetime NOT NULL,
  `por` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `correo`, `usuario`, `contrasena`, `token`, `tipo`, `categoria`, `creado`, `por`) VALUES
(1, 'Admin', 'Admin', 'Admin@Admin.org.co', 'admin', '$2y$10$AmX882/6S4dVwFJYgHIloORhPYsd6VS7LtMvNNTc0MXsn7ZZDkHl2', 'b90156d73cbdd918fa64eac6cbff273c648a2fda28ec5f2d809b4a2409e08876', 1, 0, '2020-08-27 00:00:00', 0),
(12, 'Saciar ', 'Banco de alimentos', 'Saciar@saciar.com', 'saciar', '$2y$10$AmX882/6S4dVwFJYgHIloORhPYsd6VS7LtMvNNTc0MXsn7ZZDkHl2', '853d3e4a8ed4b463be4b28dafa1f84d6f7f4144e600c02125c0ac0cca9533127', 0, 0, '0000-00-00 00:00:00', 0),
(13, 'Saciar', 'Bodega 5', 'Saciar@saciar.com', 'saciar_bodega_5', '$2y$10$AmX882/6S4dVwFJYgHIloORhPYsd6VS7LtMvNNTc0MXsn7ZZDkHl2', NULL, 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_banco`
--

CREATE TABLE `usuario_banco` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` bigint(20) UNSIGNED NOT NULL,
  `banco` bigint(20) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `por` bigint(20) NOT NULL DEFAULT 0
) ;

--
-- Volcado de datos para la tabla `usuario_banco`
--

INSERT INTO `usuario_banco` (`id`, `usuario`, `banco`, `creado`, `por`) VALUES
(5, 12, 1, '2025-05-09 13:40:16', 0),
(6, 1, 1, '2025-05-09 13:50:19', 0),
(8, 1, 4, '2025-05-10 08:47:09', 0),
(9, 1, 3, '2025-05-10 08:50:08', 0),
(10, 1, 5, '2025-05-10 08:50:20', 0),
(11, 1, 6, '2025-05-10 08:50:35', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_bodega`
--

CREATE TABLE `usuario_bodega` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` bigint(20) UNSIGNED NOT NULL,
  `bodega` bigint(20) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `por` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_bodega`
--

INSERT INTO `usuario_bodega` (`id`, `usuario`, `bodega`, `creado`, `por`) VALUES
(4, 12, 1, '2025-05-09 18:28:51', 0),
(8, 13, 1, '2025-05-09 18:38:17', 0),
(9, 1, 1, '2025-05-09 18:38:25', 0),
(10, 1, 2, '2025-05-10 06:48:11', 0),
(11, 1, 3, '2025-05-10 06:48:17', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_funcionalidad`
--

CREATE TABLE `usuario_funcionalidad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` bigint(20) UNSIGNED NOT NULL,
  `funcionalidad` bigint(20) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL,
  `por` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_perfil`
--

CREATE TABLE `usuario_perfil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` bigint(20) UNSIGNED NOT NULL,
  `perfil` bigint(20) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL,
  `por` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario_perfil`
--

INSERT INTO `usuario_perfil` (`id`, `usuario`, `perfil`, `creado`, `por`) VALUES
(1, 1, 1, '2025-04-26 15:52:36', 0),
(6, 12, 3, '2025-05-06 10:51:29', 0),
(7, 13, 4, '2025-05-09 18:47:10', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` bigint(20) UNSIGNED NOT NULL,
  `rol` bigint(20) UNSIGNED NOT NULL,
  `creado` datetime NOT NULL,
  `por` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

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
-- Indices de la tabla `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `benefactor`
--
ALTER TABLE `benefactor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `benefactor_efectivo`
--
ALTER TABLE `benefactor_efectivo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `benefactor_sede`
--
ALTER TABLE `benefactor_sede`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_benefactor_sede_benefactor` (`benefactor_id`);

--
-- Indices de la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `beneficiario_sede`
--
ALTER TABLE `beneficiario_sede`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_beneficiario_sede_beneficiario` (`beneficiario_id`);

--
-- Indices de la tabla `bodega`
--
ALTER TABLE `bodega`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_bodegas_codigo` (`codigo`),
  ADD KEY `idx_bodegas_banco` (`banco`);

--
-- Indices de la tabla `bodega_lote`
--
ALTER TABLE `bodega_lote`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `categorizacion`
--
ALTER TABLE `categorizacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorizacion_item`
--
ALTER TABLE `categorizacion_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorizacion` (`categorizacion`);

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
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

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
-- Indices de la tabla `funcionalidad`
--
ALTER TABLE `funcionalidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulo` (`modulo`);

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
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `fk_municipio_departamento` (`departamento`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfil_rol`
--
ALTER TABLE `perfil_rol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perfil` (`perfil`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `placas`
--
ALTER TABLE `placas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_institucion`
--
ALTER TABLE `producto_institucion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prod_inst_prod` (`producto_id`);

--
-- Indices de la tabla `recibido`
--
ALTER TABLE `recibido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol_funcionalidad`
--
ALTER TABLE `rol_funcionalidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`rol`),
  ADD KEY `funcionalidad` (`funcionalidad`);

--
-- Indices de la tabla `rol_modulo`
--
ALTER TABLE `rol_modulo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`rol`),
  ADD KEY `modulo` (`modulo`);

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
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoria` (`categoria`,`codigo`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indices de la tabla `usuario_banco`
--
ALTER TABLE `usuario_banco`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_usuario_banco` (`usuario`,`banco`),
  ADD KEY `idx_usuario` (`usuario`),
  ADD KEY `idx_banco` (`banco`);

--
-- Indices de la tabla `usuario_bodega`
--
ALTER TABLE `usuario_bodega`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_usuario` (`usuario`),
  ADD KEY `idx_bodega` (`bodega`);

--
-- Indices de la tabla `usuario_funcionalidad`
--
ALTER TABLE `usuario_funcionalidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `funcionalidad` (`funcionalidad`);

--
-- Indices de la tabla `usuario_perfil`
--
ALTER TABLE `usuario_perfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `perfil` (`perfil`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banco`
--
ALTER TABLE `banco`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `benefactor`
--
ALTER TABLE `benefactor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `benefactor_efectivo`
--
ALTER TABLE `benefactor_efectivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `benefactor_sede`
--
ALTER TABLE `benefactor_sede`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `beneficiario_sede`
--
ALTER TABLE `beneficiario_sede`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `bodega`
--
ALTER TABLE `bodega`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `bodegas`
--
ALTER TABLE `bodegas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bodega_lote`
--
ALTER TABLE `bodega_lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `categorizacion`
--
ALTER TABLE `categorizacion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorizacion_item`
--
ALTER TABLE `categorizacion_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `digitadores`
--
ALTER TABLE `digitadores`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT de la tabla `funcionalidad`
--
ALTER TABLE `funcionalidad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `lote_salida`
--
ALTER TABLE `lote_salida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1154;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `perfil_rol`
--
ALTER TABLE `perfil_rol`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `placas`
--
ALTER TABLE `placas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto_institucion`
--
ALTER TABLE `producto_institucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `recibido`
--
ALTER TABLE `recibido`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rol_funcionalidad`
--
ALTER TABLE `rol_funcionalidad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol_modulo`
--
ALTER TABLE `rol_modulo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `tipo_benefactor`
--
ALTER TABLE `tipo_benefactor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_beneficiado`
--
ALTER TABLE `tipo_beneficiado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario_banco`
--
ALTER TABLE `usuario_banco`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario_bodega`
--
ALTER TABLE `usuario_bodega`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario_funcionalidad`
--
ALTER TABLE `usuario_funcionalidad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario_perfil`
--
ALTER TABLE `usuario_perfil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `benefactor_sede`
--
ALTER TABLE `benefactor_sede`
  ADD CONSTRAINT `fk_benefactor_sede_benefactor` FOREIGN KEY (`benefactor_id`) REFERENCES `benefactor` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `beneficiario_sede`
--
ALTER TABLE `beneficiario_sede`
  ADD CONSTRAINT `fk_beneficiario_sede_beneficiario` FOREIGN KEY (`beneficiario_id`) REFERENCES `beneficiario` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `bodegas`
--
ALTER TABLE `bodegas`
  ADD CONSTRAINT `fk_bodegas_banco` FOREIGN KEY (`banco`) REFERENCES `banco` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `categorizacion_item`
--
ALTER TABLE `categorizacion_item`
  ADD CONSTRAINT `categorizacion_item_ibfk_1` FOREIGN KEY (`categorizacion`) REFERENCES `categorizacion` (`id`);

--
-- Filtros para la tabla `funcionalidad`
--
ALTER TABLE `funcionalidad`
  ADD CONSTRAINT `funcionalidad_modulo_foreign` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`id`);

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `fk_municipio_departamento` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `perfil_rol`
--
ALTER TABLE `perfil_rol`
  ADD CONSTRAINT `perfil_rol_perfil_foreign` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`id`),
  ADD CONSTRAINT `perfil_rol_rol_foreign` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `producto_institucion`
--
ALTER TABLE `producto_institucion`
  ADD CONSTRAINT `fk_prod_inst_prod` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_funcionalidad`
--
ALTER TABLE `rol_funcionalidad`
  ADD CONSTRAINT `rol_funcionalidad_funcionalidad_foreign` FOREIGN KEY (`funcionalidad`) REFERENCES `funcionalidad` (`id`),
  ADD CONSTRAINT `rol_funcionalidad_rol_foreign` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `rol_modulo`
--
ALTER TABLE `rol_modulo`
  ADD CONSTRAINT `rol_modulo_modulo_foreign` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`id`),
  ADD CONSTRAINT `rol_modulo_rol_foreign` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `fk_subcat_categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_banco`
--
ALTER TABLE `usuario_banco`
  ADD CONSTRAINT `fk_usuario_banco_banco` FOREIGN KEY (`banco`) REFERENCES `banco` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_banco_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_bodega`
--
ALTER TABLE `usuario_bodega`
  ADD CONSTRAINT `fk_ub_bodega` FOREIGN KEY (`bodega`) REFERENCES `bodegas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ub_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_funcionalidad`
--
ALTER TABLE `usuario_funcionalidad`
  ADD CONSTRAINT `usuario_funcionalidad_funcionalidad_foreign` FOREIGN KEY (`funcionalidad`) REFERENCES `funcionalidad` (`id`),
  ADD CONSTRAINT `usuario_funcionalidad_usuario_foreign` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `usuario_perfil`
--
ALTER TABLE `usuario_perfil`
  ADD CONSTRAINT `usuario_perfil_perfil_foreign` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`id`),
  ADD CONSTRAINT `usuario_perfil_usuario_foreign` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `usuario_rol_rol_foreign` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `usuario_rol_usuario_foreign` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`);
COMMIT;
