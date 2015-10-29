-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2015 a las 15:47:20
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `encuestas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biblioteca`
--

CREATE TABLE IF NOT EXISTS `biblioteca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_facultad` int(11) NOT NULL,
  `Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_facultad` (`id_facultad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `biblioteca`
--

INSERT INTO `biblioteca` (`id`, `id_facultad`, `Nombre`) VALUES
(1, 1, 'Medicina'),
(2, 1, 'Enfermeria'),
(3, 2, 'Jerez'),
(4, 3, 'ESI'),
(6, 3, 'CASEM'),
(7, 4, 'Algeciras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dimensiones`
--

CREATE TABLE IF NOT EXISTS `dimensiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_Estudios` int(11) NOT NULL,
  `nombre` tinytext COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_Estudios` (`id_Estudios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `dimensiones`
--

INSERT INTO `dimensiones` (`id`, `id_Estudios`, `nombre`) VALUES
(1, 1, 'Perfil usuario'),
(2, 1, 'Valor efectivo del servicio'),
(3, 1, 'La biblioteca como espacio'),
(4, 1, 'Control de la informacion'),
(5, 1, 'Quejas y sugerancias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestasrellenas`
--

CREATE TABLE IF NOT EXISTS `encuestasrellenas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_Estudios` int(11) NOT NULL,
  `hora_comienzo` text COLLATE utf8_spanish_ci NOT NULL,
  `hora_fin` text COLLATE utf8_spanish_ci NOT NULL,
  `ip` tinytext COLLATE utf8_spanish_ci,
  `referer` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`),
  KEY `id_Estudios` (`id_Estudios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `encuestasrellenas`
--

INSERT INTO `encuestasrellenas` (`id`, `id_Estudios`, `hora_comienzo`, `hora_fin`, `ip`, `referer`) VALUES
(25, 1, '03:29:13', '03:29:15', '::1', NULL),
(26, 1, '03:32:39', '03:32:49', '::1', NULL),
(27, 1, '03:32:57', '03:32:58', '::1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudios`
--

CREATE TABLE IF NOT EXISTS `estudios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` tinytext COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `estudios`
--

INSERT INTO `estudios` (`id`, `nombre`) VALUES
(1, 'Universidad de Cadiz'),
(2, 'Universidad de Sevilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE IF NOT EXISTS `facultad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estudio` int(11) NOT NULL,
  `Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estudio` (`id_estudio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`id`, `id_estudio`, `Nombre`) VALUES
(1, 1, 'Cadiz'),
(2, 1, 'Jerez'),
(3, 1, 'Puerto Real'),
(4, 1, 'Algeciras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE IF NOT EXISTS `opciones` (
  `nombre` text NOT NULL,
  `id_preguntas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`nombre`, `id_preguntas`) VALUES
('PAS', 1),
('Alumno', 1),
('PDA', 1),
('Puerto Real', 2),
('Cádiz', 2),
('Jerez', 2),
('Algeciras', 2),
('Campus Pto Real', 3),
('Económicas', 3),
('Jerez', 3),
('Algeciras', 3),
('Hombre', 4),
('Mujer', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE IF NOT EXISTS `preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_Dimensiones` int(11) NOT NULL,
  `pregunta` text COLLATE utf8_spanish_ci NOT NULL,
  `tipo` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`),
  KEY `id_Dimensiones` (`id_Dimensiones`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `id_Dimensiones`, `pregunta`, `tipo`, `descripcion`) VALUES
(1, 1, 'Tipo de usuario', '1', 'Seleccion entre PDI,PAS o Alumno'),
(2, 1, 'Facultad', '1', 'Facultad a la que pertenece el encuestado'),
(3, 1, 'Biblioteca evaluada', '1', 'Indica la biblioteca que evalua el encuestado'),
(4, 1, 'Sexo', '1', NULL),
(5, 2, 'El personal muestra buena disposición para responder a las \r\npreguntas planteadas.', '1', NULL),
(6, 2, 'El personal tiene conocimiento y es capaz de responder a las \r\npreguntas planteadas.', '1', NULL),
(7, 2, 'El personal es amable y atento.', '1', NULL),
(8, 2, 'El personal tiene buena presencia.', '1', NULL),
(9, 2, 'El personal esta en su puesto de trabajo.', '1', NULL),
(10, 3, 'Horario de la biblioteca.', '1', NULL),
(11, 3, 'Disponibilidad de puestos de lectura.', '1', NULL),
(12, 3, 'Disponibilidad de equipamientos informáticos (puestos \r\ninformáticos, ordenadores portátiles, conexiones a la red, etc.).', '1', NULL),
(13, 3, 'Disponibilidad de salas de trabajo en grupo.', '1', NULL),
(14, 3, 'Iluminación', '1', NULL),
(15, 3, 'Climatización.', '1', NULL),
(16, 3, 'Señalización de las instalaciones.', '1', NULL),
(17, 3, 'Facilidad de acceso a las instalaciones.', '1', NULL),
(18, 3, 'Ambiente d\r\ne trabajo y estudio.', '1', NULL),
(19, 4, 'Fondo bibliográfico general.', '1', NULL),
(20, 4, 'Recursos electrónicos (revistas \r\nelectrónicas, bases de datos, etc.,).', '1', NULL),
(21, 4, 'Fondo de bibliografía recomendada', '1', NULL),
(22, 5, 'Quejas o sugerencias', '1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE IF NOT EXISTS `respuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_EncuestasRellenas` int(11) NOT NULL,
  `id_Preguntas` int(11) NOT NULL,
  `respuesta` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_Preguntas` (`id_Preguntas`),
  KEY `id_EncuestasRellenas` (`id_EncuestasRellenas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1457 ;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `id_EncuestasRellenas`, `id_Preguntas`, `respuesta`) VALUES
(1391, 25, 1, 'PAS'),
(1392, 25, 2, 'Puerto Real'),
(1393, 25, 3, 'Campus Pto Real'),
(1394, 25, 4, 'Hombre'),
(1395, 25, 5, '0'),
(1396, 25, 6, '0'),
(1397, 25, 7, '0'),
(1398, 25, 8, '0'),
(1399, 25, 9, '0'),
(1400, 25, 10, '0'),
(1401, 25, 11, '0'),
(1402, 25, 12, '0'),
(1403, 25, 13, '0'),
(1404, 25, 14, '0'),
(1405, 25, 15, '0'),
(1406, 25, 16, '0'),
(1407, 25, 17, '0'),
(1408, 25, 18, '0'),
(1409, 25, 19, '0'),
(1410, 25, 20, '0'),
(1411, 25, 21, '0'),
(1412, 25, 22, '0'),
(1413, 26, 1, 'PAS'),
(1414, 26, 2, 'Puerto Real'),
(1415, 26, 3, 'Campus Pto Real'),
(1416, 26, 4, 'Hombre'),
(1417, 26, 5, '0'),
(1418, 26, 6, '0'),
(1419, 26, 7, '0'),
(1420, 26, 8, '4'),
(1421, 26, 9, '0'),
(1422, 26, 10, '3'),
(1423, 26, 11, '0'),
(1424, 26, 12, '0'),
(1425, 26, 13, '0'),
(1426, 26, 14, '0'),
(1427, 26, 15, '1'),
(1428, 26, 16, '0'),
(1429, 26, 17, '0'),
(1430, 26, 18, '0'),
(1431, 26, 19, '0'),
(1432, 26, 20, '0'),
(1433, 26, 21, '0'),
(1434, 26, 22, '0'),
(1435, 27, 1, 'PAS'),
(1436, 27, 2, 'Puerto Real'),
(1437, 27, 3, 'Campus Pto Real'),
(1438, 27, 4, 'Hombre'),
(1439, 27, 5, '0'),
(1440, 27, 6, '0'),
(1441, 27, 7, '0'),
(1442, 27, 8, '0'),
(1443, 27, 9, '0'),
(1444, 27, 10, '0'),
(1445, 27, 11, '0'),
(1446, 27, 12, '0'),
(1447, 27, 13, '0'),
(1448, 27, 14, '0'),
(1449, 27, 15, '0'),
(1450, 27, 16, '0'),
(1451, 27, 17, '0'),
(1452, 27, 18, '0'),
(1453, 27, 19, '0'),
(1454, 27, 20, '0'),
(1455, 27, 21, '0'),
(1456, 27, 22, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `Nombre`) VALUES
(1, 'PDI'),
(2, 'PAS'),
(3, 'Alumno');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD CONSTRAINT `Biblioteca_ibfk_1` FOREIGN KEY (`id_facultad`) REFERENCES `facultad` (`id`);

--
-- Filtros para la tabla `dimensiones`
--
ALTER TABLE `dimensiones`
  ADD CONSTRAINT `Dimensiones_ibfk_1` FOREIGN KEY (`id_Estudios`) REFERENCES `estudios` (`id`);

--
-- Filtros para la tabla `encuestasrellenas`
--
ALTER TABLE `encuestasrellenas`
  ADD CONSTRAINT `EncuestasRellenas_ibfk_1` FOREIGN KEY (`id_Estudios`) REFERENCES `estudios` (`id`);

--
-- Filtros para la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD CONSTRAINT `Facultad_ibfk_1` FOREIGN KEY (`id_estudio`) REFERENCES `estudios` (`id`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `Preguntas_ibfk_1` FOREIGN KEY (`id_Dimensiones`) REFERENCES `dimensiones` (`id`);

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `Respuestas_ibfk_1` FOREIGN KEY (`id_Preguntas`) REFERENCES `preguntas` (`id`),
  ADD CONSTRAINT `Respuestas_ibfk_2` FOREIGN KEY (`id_EncuestasRellenas`) REFERENCES `encuestasrellenas` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
