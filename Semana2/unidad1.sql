-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-03-2026 a las 20:33:20
-- Versión del servidor: 8.4.7
-- Versión de PHP: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `unidad1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

DROP TABLE IF EXISTS `tareas`;
CREATE TABLE IF NOT EXISTS `tareas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `completado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `titulo`, `completado`, `fecha_creacion`, `email_id`) VALUES
(4, 'Comer', 0, '2026-02-03 20:57:39', '4rthurbl00@gmail.com'),
(5, 'Tranferencia', 1, '2026-02-03 20:57:53', '4rthurbl00@gmail.com'),
(6, 'Ver si funciona', 0, '2026-02-26 18:35:50', '4rthurbl00@gmail.com'),
(7, 'Lavar la ropa', 0, '2026-02-26 19:18:27', 'avx123@gmail.com'),
(8, 'Hacer la Tarea de programación', 0, '2026-02-26 19:18:27', 'avx123@gmail.com'),
(9, 'Esto Funciona????', 0, '2026-02-26 19:25:43', '4rthurbl00@gmail.com'),
(10, 'Hacer de comer', 0, '2026-02-26 19:26:09', 'avx123@gmail.com'),
(11, 'Lavar los trastes ', 0, '2026-02-26 19:28:27', 'avx123@gmail.com'),
(13, 'pollo loco', 1, '2026-02-26 19:44:24', 'nsergiojason@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `password`) VALUES
(1, 'arturo', 'arturobl00@msn.com', '$2y$10$xDhGgaqwfI5OKmcVW8q40e2gdYwFg6/UvjtOQ0l2Hni5xS5Z/OLGu'),
(2, 'Juan Perez', 'juan@gmail.com', '$2y$10$/fIOyj3k2MTm5ifIZyQPc.Tn1Y6nDQf8QQ29FmMaRLvJrcMynlH8m'),
(3, 'Jose Arturo', '4rthurbl00@gmail.com', '$2y$10$D6eqEqoVHX0GdsaEcgkeJ.TXEm4.cQab4EBVPcOGDedxBEKhBHNQG'),
(4, 'Sergio', 'nsergiojason@gmail.com', '$2y$10$3/trb0ViycNwTIMUuCvGfOcLHbd5FmBoB8/yM8Mr9Ogt44kGQ/3se'),
(5, 'andrea vazquez', 'andreavazquezsanchez777@gmail.com', '$2y$10$okYkYlLSs1JmD8ktipS2RO6gH3BRU2D1cCMJNOKlOQy7SH16m9EYe'),
(6, 'Josue Pablo Lucas ', 'josuepablo06@gmail.com', '$2y$10$6/TvUoVU2i30Y6qDrPEQh.1SNLwBWHLxW408MwR.ntrF61F2mfq12'),
(7, 'changuitomarinero', 'changuitomarinero@gmail.com', '$2y$10$ikKfdwvhO/qD0Fe46McORuqjGKB97GP2W2bJ7ga//DscDbEnkm.NW'),
(8, 'Juancho', 'Cr8791973@gmail.com', '$2y$10$62oiM6SVohKzTPks5YqNBeMLcr3Co75MEclTCznlRbPxs6gjaQ9Eu'),
(9, 'Pastelín', '24120162@gmail.com', '$2y$10$qBOr8L0yFpM7trbmTSiMA.GhvGrexk0ZHM9ogUKfYBmDAOCXWKs5K'),
(10, 'Bladimir', 'b.dxmrl07@gmail.com', '$2y$10$GyWIcN5fG.CONa0vq.Z0euD.Bis8Q1k/JJhtRwKgxyee7msQQbC8K'),
(11, 'JUAN PEREZ ORTIZ', 'JUANP1719@GMAIL.COM', '$2y$10$SYzCXo1DCqZbqt8yB6lmQOjLIBVyyLLhTPbzkzhOpyqtwlCqQVHNe'),
(12, 'Xochitl', 'avx123@gmail.com', '$2y$10$6.mg8AkbskrK7szb0JetBOata.S1qHOSuqTZpo.RaQKuLMYQ71AS2'),
(13, 'Luciano ', 'Cr8791974@gmail.com', '$2y$10$tHjeonohTaUZMrH/tLGtKu/GB0b.OIUGJFHOPpHdm2T0YDr4HuRQe'),
(14, 'yuli', '24120167@ajalpan.tecnm.mx', '$2y$10$f0eZESjGV5R.GNBsNUsX9.fyEe4LN0DS3zymoaRxurwrsWkneyJMS'),
(15, 'frida', 'guzmanfrida510@gmail.com', '$2y$10$7jhk5cT6zAY10/VYRAlKgedJlPTejj5m5oOtMtSyiJXIxuljHpQr.'),
(16, 'Areli', 'are25@gmail.com', '$2y$10$sQCLK4iruiFw68qtBBK5YeNt/zuhT8SBzrYG/4fjrcNRsnuhkRGWS'),
(17, 'martini', 'martin4211a@gmail.com', '$2y$10$RaDsU698qb3PvyILnGdGp.AJNsDn8PZvONybTNyuZamfv.yZWcZTa'),
(18, 'Guadalupe Cid', 'mcid2724@gmail.com', '$2y$10$ega89AX/cWNDsiuu4p91he5n6VFGbaqXu.ZnXpEGCIe1Z2Dgfpi7q');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
