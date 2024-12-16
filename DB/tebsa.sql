-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-03-2018 a las 20:05:36
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tebsa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `archivo_nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `archivo_almace` varchar(15) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `archivo_tipo` varchar(25) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `codigo_mueble` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `n_entrepano` int(11) NOT NULL,
  `uni_conservacion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `url_arc` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `archivo_nombre`, `archivo_almace`, `archivo_tipo`, `codigo_mueble`, `n_entrepano`, `uni_conservacion`, `url_arc`) VALUES
(86, 'formato', '150346', 'application/pdf', 'M2', 7, 'Caja', 'Archivo/Runes/2017/formato.pdf'),
(87, 'formato', '150346', 'application/pdf', 'M11', 7, 'Caja', 'Archivo/Notas_Contables/2018/formato.pdf'),
(88, 'Para Eliminar', '150346', 'application/pdf', 'MX', 2, 'Caja', 'Archivo/Notas_Contables/2018/Para Eliminar.pdf'),
(89, 'Para_Eliminar', '150346', 'application/pdf', 'MX', 2, 'Caja', 'Archivo/Notas_Contables/2018/Para_Eliminar.pdf'),
(90, 'Facturadelpc', '252104', 'application/pdf', '1', 0, '1', 'Documentos/Facturadelpc.pdf'),
(91, 'RUN_cuentadecobro_2867', '94331', 'application/pdf', '2', 0, '2', 'Documentos/RUN_cuentadecobro_2867.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usu` int(11) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `pass` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usu`, `nombre`, `pass`) VALUES
(5, 'sebas@mail.com', 'ee5b948f1485d7be518a4664b2641a6f'),
(7, 'boom@mail.com', 'cf8067d790afd44d34679a5015f52ae5');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
