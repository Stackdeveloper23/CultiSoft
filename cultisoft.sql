-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-05-2024 a las 00:47:19
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
-- Base de datos: `cultisoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'h'),
(2, 'cereales'),
(3, 'ho'),
(4, 'nutricion_vegetal'),
(5, 'macetas'),
(6, 'semillas_frutales'),
(7, 'abono'),
(8, 'soportes'),
(9, 'mallas'),
(10, 'invernadero'),
(11, 'hoy'),
(13, 'hoy'),
(500000, 'matas'),
(1233453, 'mataas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombres` varchar(25) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contraseña` varchar(25) NOT NULL,
  `rol` enum('admin','usuario') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombres`, `apellidos`, `email`, `contraseña`, `rol`) VALUES
(1, 'manaña', 'hoy', 'hola2@gmail.com', '123456', NULL),
(10, 'sergio', 'rojas', 'var@gmail.com', '123456', NULL),
(12, 'maria', 'paz', 'maria@gmail.com', 'mary123', 'usuario'),
(22, 'juan jose', 'Rojas', 'juan@gmail.com', '123456', 'usuario'),
(1020, 'andres', 'Perez', 'andres@gmail.com', '123456', 'usuario'),
(10237867, 'andre', 'Vargas', 'var633@gmail.com', '67651', 'usuario'),
(521498021, 'jose', 'Ramirez', 'jose@gmail.com', 'hoy01jose', NULL),
(1029520306, 'Sergio', 'Vargas', 'vargasrojas663@gmail.com', 'Admintrue', 'admin');

--
-- Disparadores `cliente`
--
DELIMITER $$
CREATE TRIGGER `eliminacio_info_cliente` AFTER DELETE ON `cliente` FOR EACH ROW begin 
  insert into eliminacion_cliente(columna_afectada,valor_eliminado)
  values (id,old.id);
  end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eliminacion_cliente`
--

CREATE TABLE `eliminacion_cliente` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `columna_afectada` varchar(25) DEFAULT NULL,
  `valor_eliminado` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eliminacion_cliente`
--

INSERT INTO `eliminacion_cliente` (`id`, `fecha`, `columna_afectada`, `valor_eliminado`) VALUES
(1, '2024-03-26 19:20:29', '0', '10'),
(2, '2024-03-26 19:20:45', '0', '102545030'),
(3, '2024-03-26 19:21:04', '0', '102358656'),
(4, '2024-03-26 23:41:01', '0', '125209145'),
(5, '2024-03-26 23:41:05', '0', '265478120'),
(6, '2024-03-26 23:41:11', '0', '285478951'),
(7, '2024-03-26 23:41:16', '0', '457896321'),
(8, '2024-03-26 23:41:22', '0', '520985452'),
(9, '2024-03-26 23:41:28', '0', '521478954'),
(10, '2024-03-27 00:43:25', '0', '1'),
(11, '2024-03-29 13:39:51', '0', '21'),
(12, '2024-03-29 13:40:44', '0', '20'),
(13, '2024-04-02 12:10:59', '0', '564875181');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `estado` varchar(15) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(8,0) NOT NULL,
  `imagenes` text DEFAULT NULL,
  `cantidad` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `estado`, `descripcion`, `precio`, `imagenes`, `cantidad`) VALUES
(1, 'mataas', 'disponible', 'plantitias muy bonitas para sembar en tu jardiro en tu finca resistentes para todo tipo de clima desde frio como en canada hasta lo mas cliente como el sahara', 1000, '', '8'),
(2, 'maceta diametro 40cm', 'disponible', 'maceta para plantar matas', 45000, '', NULL),
(3, 'flores grandes', 'disponible', 'Arroz grande para comer con toda lafamilia y podras invitar a todos los vecino dela cuadra por que te alcanzara para todo los que estan cerca de ti', 90000, '', '10'),
(4, 'semillas de flores', 'disponible', 'semilas para cultivar pan de bono', 50000, '', '9'),
(5, 'Semillas de manzana', 'disponible', 'semilas para cultivar pan de bono', 10000, '', '10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eliminacion_cliente`
--
ALTER TABLE `eliminacion_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `eliminacion_cliente`
--
ALTER TABLE `eliminacion_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
