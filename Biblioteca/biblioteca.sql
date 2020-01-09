-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-02-2019 a las 12:17:17
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

DROP TABLE IF EXISTS `libros`;
CREATE TABLE IF NOT EXISTS `libros` (
  `id_libro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `imagen` varchar(100) NOT NULL,
  PRIMARY KEY (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `titulo`, `autor`, `cantidad`, `imagen`) VALUES
(11, 'Fuego y Sangre', 'George R Martin', 1, 'imagenes/fuegoysangre.jpg'),
(12, 'Juego de Tronos', 'George R Martin', 2, 'imagenes/juegodetronos.jpg'),
(13, 'Danza de dragones', 'George R Martin', 3, 'imagenes/danzadedragones.jpg'),
(14, 'La comunidad del anillo', 'J R R Tolkien', 1, 'imagenes/comunidaddelanillo.jpg'),
(15, 'Las dos Torres', 'J R R Tolkien', 1, 'imagenes/lasdostorres.jpg'),
(28, 'El retorno del rey', 'J R R Tolkien', 2, 'imagenes/retornodelrey.jpg'),
(29, 'Mortadelo N180', 'Francisco Ibáñez', 1, 'imagenes/mortadelo180.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

DROP TABLE IF EXISTS `prestamos`;
CREATE TABLE IF NOT EXISTS `prestamos` (
  `id_prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `id_libro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  PRIMARY KEY (`id_prestamo`),
  KEY `prestamos_ibfk_1` (`id_libro`),
  KEY `prestamos_ibfk_2` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `id_libro`, `id_usuario`, `fecha_prestamo`, `fecha_devolucion`) VALUES
(46, 13, 7, '2019-02-26', NULL),
(47, 12, 7, '2019-02-26', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) NOT NULL,
  `clave` varchar(50) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `clave`) VALUES
(6, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(7, 'Joaquin', '25d55ad283aa400af464c76d713c07ad'),
(9, 'Fausto', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
