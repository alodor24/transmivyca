-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-05-2017 a las 22:41:49
-- Versión del servidor: 5.7.17-0ubuntu0.16.04.2
-- Versión de PHP: 7.0.15-0ubuntu0.16.04.4

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
-- Estructura de tabla para la tabla `chofer`
--

CREATE TABLE `chofer` (
  `id_chofer` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `fecha_ingreso` varchar(10) NOT NULL,
  `estatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `chofer`
--

INSERT INTO `chofer` (`id_chofer`, `cedula`, `nombre`, `apellido`, `direccion`, `telefono`, `fecha_ingreso`, `estatus`) VALUES
(2, '19316181', 'JOSE ALEJANDRO', 'MENDEZ SANCHEZ', 'BARCELONA', '02812710887', '21-05-2017', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chuto`
--

CREATE TABLE `chuto` (
  `id_chuto` int(11) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `annio` varchar(4) NOT NULL,
  `serial_motor` varchar(45) NOT NULL,
  `serial_carroceria` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `chuto`
--

INSERT INTO `chuto` (`id_chuto`, `matricula`, `marca`, `modelo`, `color`, `annio`, `serial_motor`, `serial_carroceria`) VALUES
(2, 'MBO-785', 'INTERNATIONAL', 'TRANSTAR', 'NEGRO', '2015', 'A1B2C3D4E5', 'E1R2Y3U4J5');

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
(4, 'J-458799214', 'SERVICE COMPUTEP', 'VIGIA', '02812710888', 'JOSE ALEJANDRO SANCHEZ MENDEZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destino`
--

CREATE TABLE `destino` (
  `id_destino` int(11) NOT NULL,
  `destino` varchar(45) NOT NULL,
  `distancia` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `destino`
--

INSERT INTO `destino` (`id_destino`, `destino`, `distancia`) VALUES
(2, 'CARACAS', '300');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_chuto`
--

CREATE TABLE `mantenimiento_chuto` (
  `id_mantenimiento` int(11) NOT NULL,
  `kilometraje` varchar(45) NOT NULL,
  `falla` varchar(200) NOT NULL,
  `diagnostico` varchar(200) DEFAULT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_egreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 'alodor', 0x24327924313024507856464a527234747158314d3133306e742f43364f6f4c4f6b4e564b5237336f776a465a2f42734c316164754e61555632363061, 'operador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaticos`
--

CREATE TABLE `viaticos` (
  `id_viaticos` int(11) NOT NULL,
  `peaje` double NOT NULL,
  `comida` double NOT NULL,
  `combustible` double NOT NULL,
  `otros` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `viaticos`
--

INSERT INTO `viaticos` (`id_viaticos`, `peaje`, `comida`, `combustible`, `otros`, `total`) VALUES
(3, 2000, 15000, 3000, 5000, 25000);

--
-- Índices para tablas volcadas
--

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
  ADD PRIMARY KEY (`id_mantenimiento`);

--
-- Indices de la tabla `usuario_sistema`
--
ALTER TABLE `usuario_sistema`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `viaticos`
--
ALTER TABLE `viaticos`
  ADD PRIMARY KEY (`id_viaticos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chofer`
--
ALTER TABLE `chofer`
  MODIFY `id_chofer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `chuto`
--
ALTER TABLE `chuto`
  MODIFY `id_chuto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `destino`
--
ALTER TABLE `destino`
  MODIFY `id_destino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `mantenimiento_chuto`
--
ALTER TABLE `mantenimiento_chuto`
  MODIFY `id_mantenimiento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario_sistema`
--
ALTER TABLE `usuario_sistema`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `viaticos`
--
ALTER TABLE `viaticos`
  MODIFY `id_viaticos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
