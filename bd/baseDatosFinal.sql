-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-12-2017 a las 14:21:30
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `curso_symfony_3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acuerdos_pre`
--

CREATE TABLE `acuerdos_pre` (
  `id` int(11) NOT NULL,
  `fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `acuerdos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nroAcuerdo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plazoEntrega` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `areaIpd_id` int(11) DEFAULT NULL,
  `comite` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `acuerdos_pre`
--

INSERT INTO `acuerdos_pre` (`id`, `fecha`, `acuerdos`, `nroAcuerdo`, `estado`, `plazoEntrega`, `areaIpd_id`, `comite`) VALUES
(23, '2017-12-08', 'asdads', '44', 'En Proceso', '2017-12-21', 1, '44'),
(24, '2017-12-09', 'wdwe', '23323', 'En Proceso', '2017-12-08', 1, '33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acuerdos_s_g`
--

CREATE TABLE `acuerdos_s_g` (
  `id` int(11) NOT NULL,
  `sesion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agenda` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `acuerdos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plazoEntrega` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `areaIpd_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `acuerdos_s_g`
--

INSERT INTO `acuerdos_s_g` (`id`, `sesion`, `fecha`, `agenda`, `acuerdos`, `estado`, `plazoEntrega`, `areaIpd_id`) VALUES
(1, '22', '2017-12-09', 'hsdhshd', 'hasdhashd', 'En Proceso', '2017-12-14', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_ipd`
--

CREATE TABLE `area_ipd` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `area_ipd`
--

INSERT INTO `area_ipd` (`id`, `nombre`) VALUES
(1, 'Direccion de Seguridad Deportiva'),
(2, 'Direccion Nacional de Recreacion y Promocion del Deporte'),
(3, 'Oficina General de Administracion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_indicador`
--

CREATE TABLE `detalle_indicador` (
  `id` int(11) NOT NULL,
  `indicador_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enero` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `febrero` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marzo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `abril` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mayo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `junio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `julio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agosto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `septiembre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `octubre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noviembre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diciembre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_indicador`
--

INSERT INTO `detalle_indicador` (`id`, `indicador_id`, `nombre`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre`) VALUES
(1, 4, 'N° de planes de seguridad presentados', '7', '44', '43', '55', '72', '77', '90', '57', '72', '50', '0', '0'),
(2, 4, 'N° de planes de seguridad evaluados', '7', '44', '43', '55', '72', '77', '90', '57', '72', '30', '0', '0'),
(11, 7, 'N° de enventos realizados', '7', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(12, 7, 'N° de eventos cubiertos', '7', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador`
--

CREATE TABLE `indicador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `areaIpd_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `indicador`
--

INSERT INTO `indicador` (`id`, `nombre`, `areaIpd_id`) VALUES
(4, 'N° de planes de seguridad presentados y N° de planes de seguridad evaluados', 1),
(7, 'N° de eventos realizados y N° de eventos cubiertos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leyenda`
--

CREATE TABLE `leyenda` (
  `id` int(11) NOT NULL,
  `rojo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amarillo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verde` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `indicador_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `leyenda`
--

INSERT INTO `leyenda` (`id`, `rojo`, `amarillo`, `verde`, `indicador_id`) VALUES
(34, '85 <', '100 <', '100 >=', 4),
(37, '75 <', '90 <=', '90 >', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_pre`
--

CREATE TABLE `observaciones_pre` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `acuerdoPre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `observaciones_pre`
--

INSERT INTO `observaciones_pre` (`id`, `descripcion`, `fecha`, `acuerdoPre_id`) VALUES
(16, 'dsdsd', '2017-12-29', 23),
(17, 'saas', '2017-12-29', 24),
(18, 'nueva observacion', '2017-12-30', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_s_g`
--

CREATE TABLE `observaciones_s_g` (
  `id` int(11) NOT NULL,
  `fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `acuerdoSG_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `observaciones_s_g`
--

INSERT INTO `observaciones_s_g` (`id`, `fecha`, `descripcion`, `acuerdoSG_id`) VALUES
(1, '2017-12-29', 'hshshd', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenido` longtext COLLATE utf8_unicode_ci NOT NULL,
  `autor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `titulo`, `contenido`, `autor`, `fecha`) VALUES
(1, 'Top Framework PHP 2017', 'Symfony es el framework mas poderoso', 'Carlos Javier Majerhua Nuñez', '2017-12-14'),
(2, 'Top Framework PHP 2017', 'Symfony es el framework mas poderoso', 'Carlos Javier Majerhua Nuñez', '2017-12-14'),
(3, 'python', 'django es el mejor', 'majerhua', '2012-01-01'),
(4, 'asdas', 'ad', 'dsd', '2012-01-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `total_indicadores`
--

CREATE TABLE `total_indicadores` (
  `id` int(11) NOT NULL,
  `indicador_id` int(11) DEFAULT NULL,
  `enero` int(11) NOT NULL,
  `febrero` int(11) NOT NULL,
  `marzo` int(11) NOT NULL,
  `abril` int(11) NOT NULL,
  `mayo` int(11) NOT NULL,
  `junio` int(11) NOT NULL,
  `julio` int(11) NOT NULL,
  `agosto` int(11) NOT NULL,
  `septiembre` int(11) NOT NULL,
  `octubre` int(11) NOT NULL,
  `noviembre` int(11) NOT NULL,
  `diciembre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `total_indicadores`
--

INSERT INTO `total_indicadores` (`id`, `indicador_id`, `enero`, `febrero`, `marzo`, `abril`, `mayo`, `junio`, `julio`, `agosto`, `septiembre`, `octubre`, `noviembre`, `diciembre`) VALUES
(31, 4, 100, 100, 100, 100, 100, 100, 100, 100, 100, 60, 0, 0),
(32, 7, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `areaIpd_id` int(11) DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `areaIpd_id`, `roles`) VALUES
(22, 'majerhua', 'majerhua123@gmail.com', '$2y$13$yMtydqKLkZ4CuzO0Bf7u5.4uH3zM3aETiI018KdnB8qzJ0Q3Dd6U.', 1, '[\"ROLE_USER\"]'),
(23, 'aurora', 'aurora@gmail.com', '$2y$13$2nEmGop5dqJp/.U6Xr7K1eQhOpTb9nL.sdkmAvEv98gd1OgNodYPi', 1, '[\"ROLE_ADMIN\"]'),
(24, 'carlos', 'majerhua123@gmail.com', '$2y$13$VMsOjakRy5voBs3tIAVS1ef9KzdN.lyjwtoWJreCppmTde6EDWSUO', 1, '[\"ROLE_ADMIN\"]'),
(25, 'fatima', 'asd', '$2y$13$dNkjccHP5cL5Ojy8FZIaTu3gV8toUSGuC6ZoCWFTQ9D8XwJpKLPc6', 1, '[\"ROLE_USER\"]');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acuerdos_pre`
--
ALTER TABLE `acuerdos_pre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3692BC8A4AF1C2F8` (`areaIpd_id`);

--
-- Indices de la tabla `acuerdos_s_g`
--
ALTER TABLE `acuerdos_s_g`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FAF039104AF1C2F8` (`areaIpd_id`);

--
-- Indices de la tabla `area_ipd`
--
ALTER TABLE `area_ipd`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_indicador`
--
ALTER TABLE `detalle_indicador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EC7E8F8347D487D1` (`indicador_id`);

--
-- Indices de la tabla `indicador`
--
ALTER TABLE `indicador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CD123EC34AF1C2F8` (`areaIpd_id`);

--
-- Indices de la tabla `leyenda`
--
ALTER TABLE `leyenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_814FBCE47D487D1` (`indicador_id`);

--
-- Indices de la tabla `observaciones_pre`
--
ALTER TABLE `observaciones_pre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_44E438E2D6081371` (`acuerdoPre_id`);

--
-- Indices de la tabla `observaciones_s_g`
--
ALTER TABLE `observaciones_s_g`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8886BD788FDE162F` (`acuerdoSG_id`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `total_indicadores`
--
ALTER TABLE `total_indicadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F4C2CDB747D487D1` (`indicador_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8D93D6494AF1C2F8` (`areaIpd_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acuerdos_pre`
--
ALTER TABLE `acuerdos_pre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `acuerdos_s_g`
--
ALTER TABLE `acuerdos_s_g`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `area_ipd`
--
ALTER TABLE `area_ipd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_indicador`
--
ALTER TABLE `detalle_indicador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `indicador`
--
ALTER TABLE `indicador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `leyenda`
--
ALTER TABLE `leyenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `observaciones_pre`
--
ALTER TABLE `observaciones_pre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `observaciones_s_g`
--
ALTER TABLE `observaciones_s_g`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `total_indicadores`
--
ALTER TABLE `total_indicadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acuerdos_pre`
--
ALTER TABLE `acuerdos_pre`
  ADD CONSTRAINT `FK_3692BC8A4AF1C2F8` FOREIGN KEY (`areaIpd_id`) REFERENCES `area_ipd` (`id`);

--
-- Filtros para la tabla `acuerdos_s_g`
--
ALTER TABLE `acuerdos_s_g`
  ADD CONSTRAINT `FK_FAF039104AF1C2F8` FOREIGN KEY (`areaIpd_id`) REFERENCES `area_ipd` (`id`);

--
-- Filtros para la tabla `detalle_indicador`
--
ALTER TABLE `detalle_indicador`
  ADD CONSTRAINT `FK_EC7E8F8347D487D1` FOREIGN KEY (`indicador_id`) REFERENCES `indicador` (`id`);

--
-- Filtros para la tabla `indicador`
--
ALTER TABLE `indicador`
  ADD CONSTRAINT `FK_CD123EC34AF1C2F8` FOREIGN KEY (`areaIpd_id`) REFERENCES `area_ipd` (`id`);

--
-- Filtros para la tabla `leyenda`
--
ALTER TABLE `leyenda`
  ADD CONSTRAINT `FK_814FBCE47D487D1` FOREIGN KEY (`indicador_id`) REFERENCES `indicador` (`id`);

--
-- Filtros para la tabla `observaciones_pre`
--
ALTER TABLE `observaciones_pre`
  ADD CONSTRAINT `FK_44E438E2D6081371` FOREIGN KEY (`acuerdoPre_id`) REFERENCES `acuerdos_pre` (`id`);

--
-- Filtros para la tabla `observaciones_s_g`
--
ALTER TABLE `observaciones_s_g`
  ADD CONSTRAINT `FK_8886BD788FDE162F` FOREIGN KEY (`acuerdoSG_id`) REFERENCES `acuerdos_s_g` (`id`);

--
-- Filtros para la tabla `total_indicadores`
--
ALTER TABLE `total_indicadores`
  ADD CONSTRAINT `FK_F4C2CDB747D487D1` FOREIGN KEY (`indicador_id`) REFERENCES `indicador` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6494AF1C2F8` FOREIGN KEY (`areaIpd_id`) REFERENCES `area_ipd` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
