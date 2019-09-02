-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-06-2017 a las 18:34:11
-- Versión del servidor: 5.7.18-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `transmivyca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignar_chuto`
--

CREATE TABLE `asignar_chuto` (
  `id_asignar` int(11) NOT NULL,
  `id_chofer` int(11) NOT NULL,
  `id_chuto` int(11) NOT NULL,
  `id_batea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignar_chuto`
--

INSERT INTO `asignar_chuto` (`id_asignar`, `id_chofer`, `id_chuto`, `id_batea`) VALUES
(3, 4, 4, 3),
(4, 5, 5, 4),
(5, 6, 6, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignar_viaje`
--

CREATE TABLE `asignar_viaje` (
  `id_viaje` int(11) NOT NULL,
  `numero_guia` int(11) NOT NULL,
  `id_chofer` int(11) NOT NULL,
  `id_destino` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `salida` varchar(20) NOT NULL,
  `llegada` varchar(20) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignar_viaje`
--

INSERT INTO `asignar_viaje` (`id_viaje`, `numero_guia`, `id_chofer`, `id_destino`, `id_cliente`, `fecha`, `salida`, `llegada`, `status`) VALUES
(1, 1, 5, 2, 2, '2017-06-20', '07:35:25 pm', NULL, 'EN PROGRESO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batea`
--

CREATE TABLE `batea` (
  `id_batea` int(11) NOT NULL,
  `matricula_batea` varchar(10) NOT NULL,
  `serial` varchar(45) NOT NULL,
  `eje` varchar(1) NOT NULL,
  `fecha_registro` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `batea`
--

INSERT INTO `batea` (`id_batea`, `matricula_batea`, `serial`, `eje`, `fecha_registro`) VALUES
(3, 'TYY-885', 'RESDA65698', '4', '2017-06-19'),
(4, 'MNO-054', 'CXZSF20369', '4', '2017-06-19'),
(5, 'GHI-564', 'FGDHY25988', '2', '2017-06-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chofer`
--

CREATE TABLE `chofer` (
  `id_chofer` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `fecha_vencimiento_licencia` date NOT NULL,
  `fecha_vencimiento_certificado_medico` date NOT NULL,
  `fecha_ingreso` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `chofer`
--

INSERT INTO `chofer` (`id_chofer`, `cedula`, `nombre`, `apellido`, `direccion`, `telefono`, `fecha_vencimiento_licencia`, `fecha_vencimiento_certificado_medico`, `fecha_ingreso`) VALUES
(4, '19316181', 'ALEJANDRO', 'MENDEZ', 'BARCELONA', '04128352721', '2018-10-25', '2018-10-24', '2017-06-19'),
(5, '20080123', 'WILFREDO', 'MENDEZ', 'PUERTO LA CRUZ', '04261597894', '2018-09-25', '2018-10-24', '2017-06-19'),
(6, '8215334', 'PEDRO', 'BRITO', 'BARCELONA', '04245692287', '2020-05-13', '2021-06-23', '2017-06-19'),
(7, '15789456', 'YUBEL', 'ROJAS', 'BARCELONA', '04245698978', '2019-06-13', '2018-06-21', '2017-06-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chuto`
--

CREATE TABLE `chuto` (
  `id_chuto` int(11) NOT NULL,
  `matricula_chuto` varchar(10) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `eje` int(11) NOT NULL,
  `annio` varchar(4) NOT NULL,
  `serial_motor` varchar(45) NOT NULL,
  `serial_carroceria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `chuto`
--

INSERT INTO `chuto` (`id_chuto`, `matricula_chuto`, `marca`, `modelo`, `color`, `eje`, `annio`, `serial_motor`, `serial_carroceria`) VALUES
(4, 'MBO-456', 'MACK', 'GRANITE', 'ROJO', 3, '2002', 'ASDFR48989', 'GHTYR49856'),
(5, 'AIO-002', 'MERCEDES-BENZ', 'ZETROS', 'VERDE', 4, '2006', 'QWERT12345', 'ZXCVB78945'),
(6, 'KML-666', 'INTERNATIONAL', 'DURASTAR', 'NEGRO', 5, '2016', 'TRDSC46207', 'AXCEF45781'),
(7, 'TRO-789', 'IVECO', 'STRALIS', 'BLANCO', 3, '2010', 'RWEWWE5454', 'DGFT654454');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `rif` varchar(20) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `responsable` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `rif`, `razon_social`, `direccion`, `telefono`, `responsable`) VALUES
(2, 'J-404123456', 'POLAR', 'CUMANA', '02812710887', 'ERNESTO UZCATEGUI'),
(3, 'G-789456522', 'PDVSA', 'GUARAGUAO', '02812684591', 'HUMBERTO PETRICA'),
(4, 'J-565989463', 'MATERIALES CARABOBO', 'VALENCIA', '04245979656', 'SARAY MAZA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destino`
--

CREATE TABLE `destino` (
  `id_destino` int(11) NOT NULL,
  `origen` varchar(45) NOT NULL,
  `destino` varchar(45) NOT NULL,
  `distancia` varchar(10) NOT NULL,
  `peaje` double NOT NULL,
  `comida` double NOT NULL,
  `combustible` double NOT NULL,
  `otros` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `destino`
--

INSERT INTO `destino` (`id_destino`, `origen`, `destino`, `distancia`, `peaje`, `comida`, `combustible`, `otros`, `total`) VALUES
(2, 'BARCELONA', 'CARACAS', '300', 500, 2000, 1000, 3000, 6500),
(3, 'BARCELONA', 'VALENCIA', '500', 3000, 5000, 3000, 5000, 16000),
(4, 'BARCELONA', 'CUMANA', '160', 1000, 2000, 3000, 3000, 9000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_chuto`
--

CREATE TABLE `mantenimiento_chuto` (
  `id_mantenimiento` int(11) NOT NULL,
  `id_chuto` int(11) NOT NULL,
  `kilometraje` varchar(45) NOT NULL,
  `falla` varchar(200) NOT NULL,
  `tipo_mantenimiento` varchar(200) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_egreso` date DEFAULT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mantenimiento_chuto`
--

INSERT INTO `mantenimiento_chuto` (`id_mantenimiento`, `id_chuto`, `kilometraje`, `falla`, `tipo_mantenimiento`, `fecha_ingreso`, `fecha_egreso`, `status`) VALUES
(6, 4, '10000', 'TRANSMISION', 'PREVENTIVO', '2017-06-19', '2017-06-20', 'ACTIVO'),
(8, 4, '4545', 'CIGUEÃ‘AL', 'PREDICTIVO', '2017-06-20', '2017-06-20', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_sistema`
--

CREATE TABLE `usuario_sistema` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` blob NOT NULL,
  `privilegio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_sistema`
--

INSERT INTO `usuario_sistema` (`id_usuario`, `usuario`, `password`, `privilegio`) VALUES
(1, 'administrador', 0x243279243130245538355238505531437065524c5a6a52734a76422e4f476b436a6c723569544d792e53494b5a6d4a6373576e356a4d6e5059395a4b, 'administrador'),
(2, 'alodor', 0x2432792431302465686e476b557a534c7836456d3459596b697a57544f546c36327930345258663358574a34544978564a4436453830334f506d4e32, 'OPERADOR');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignar_chuto`
--
ALTER TABLE `asignar_chuto`
  ADD PRIMARY KEY (`id_asignar`),
  ADD KEY `fk_asignar_chuto_chofer_idx` (`id_chofer`),
  ADD KEY `fk_asignar_chuto_chuto1_idx` (`id_chuto`),
  ADD KEY `fk_asignar_chuto_batea1_idx` (`id_batea`);

--
-- Indices de la tabla `asignar_viaje`
--
ALTER TABLE `asignar_viaje`
  ADD PRIMARY KEY (`id_viaje`),
  ADD KEY `fk_asignar_viaje_chofer1_idx` (`id_chofer`),
  ADD KEY `fk_asignar_viaje_destino1_idx` (`id_destino`),
  ADD KEY `fk_asignar_viaje_cliente1_idx` (`id_cliente`);

--
-- Indices de la tabla `batea`
--
ALTER TABLE `batea`
  ADD PRIMARY KEY (`id_batea`);

--
-- Indices de la tabla `chofer`
--
ALTER TABLE `chofer`
  ADD PRIMARY KEY (`id_chofer`);

--
-- Indices de la tabla `chuto`
--
ALTER TABLE `chuto`
  ADD PRIMARY KEY (`id_chuto`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `destino`
--
ALTER TABLE `destino`
  ADD PRIMARY KEY (`id_destino`);

--
-- Indices de la tabla `mantenimiento_chuto`
--
ALTER TABLE `mantenimiento_chuto`
  ADD PRIMARY KEY (`id_mantenimiento`),
  ADD KEY `fk_mantenimiento_chuto_chuto1_idx` (`id_chuto`);

--
-- Indices de la tabla `usuario_sistema`
--
ALTER TABLE `usuario_sistema`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignar_chuto`
--
ALTER TABLE `asignar_chuto`
  MODIFY `id_asignar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `asignar_viaje`
--
ALTER TABLE `asignar_viaje`
  MODIFY `id_viaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `batea`
--
ALTER TABLE `batea`
  MODIFY `id_batea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `chofer`
--
ALTER TABLE `chofer`
  MODIFY `id_chofer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `chuto`
--
ALTER TABLE `chuto`
  MODIFY `id_chuto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `destino`
--
ALTER TABLE `destino`
  MODIFY `id_destino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `mantenimiento_chuto`
--
ALTER TABLE `mantenimiento_chuto`
  MODIFY `id_mantenimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `usuario_sistema`
--
ALTER TABLE `usuario_sistema`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignar_chuto`
--
ALTER TABLE `asignar_chuto`
  ADD CONSTRAINT `fk_asignar_chuto_batea1` FOREIGN KEY (`id_batea`) REFERENCES `batea` (`id_batea`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asignar_chuto_chofer` FOREIGN KEY (`id_chofer`) REFERENCES `chofer` (`id_chofer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asignar_chuto_chuto1` FOREIGN KEY (`id_chuto`) REFERENCES `chuto` (`id_chuto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asignar_viaje`
--
ALTER TABLE `asignar_viaje`
  ADD CONSTRAINT `fk_asignar_viaje_chofer1` FOREIGN KEY (`id_chofer`) REFERENCES `chofer` (`id_chofer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asignar_viaje_cliente1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asignar_viaje_destino1` FOREIGN KEY (`id_destino`) REFERENCES `destino` (`id_destino`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mantenimiento_chuto`
--
ALTER TABLE `mantenimiento_chuto`
  ADD CONSTRAINT `fk_mantenimiento_chuto_chuto1` FOREIGN KEY (`id_chuto`) REFERENCES `chuto` (`id_chuto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
