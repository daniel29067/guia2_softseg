-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-02-2024 a las 00:21:28
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `softseg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_students`
--

CREATE TABLE `audit_students` (
  `ID` int(11) NOT NULL,
  `PREVIOUS_NAME` varchar(50) DEFAULT NULL,
  `NEW_NAME` varchar(50) DEFAULT NULL,
  `PREVIOUS_PROGRAM` varchar(50) DEFAULT NULL,
  `NEW_PROGRAM` varchar(50) DEFAULT NULL,
  `USERID` varchar(20) DEFAULT NULL,
  `MODIFY` datetime DEFAULT NULL,
  `PROCESS` varchar(20) DEFAULT NULL,
  `ID_STUDENT` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `audit_students`
--

INSERT INTO `audit_students` (`ID`, `PREVIOUS_NAME`, `NEW_NAME`, `PREVIOUS_PROGRAM`, `NEW_PROGRAM`, `USERID`, `MODIFY`, `PROCESS`, `ID_STUDENT`) VALUES
(10, NULL, 'Daniel', NULL, 'software', '1000065344', '2024-02-28 18:07:26', 'Insertar', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `id_nivel` int(11) NOT NULL,
  `des_nivel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`id_nivel`, `des_nivel`) VALUES
(0, 'Admin'),
(1, 'Nivel 1'),
(2, 'Nivel 2'),
(3, 'Nivel 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `ID` int(15) NOT NULL,
  `NAME` varchar(50) DEFAULT NULL,
  `LAST` varchar(50) NOT NULL,
  `PROGRAM` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `students`
--

INSERT INTO `students` (`ID`, `NAME`, `LAST`, `PROGRAM`) VALUES
(10, 'Daniel', 'leal', 'software');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `USERID` varchar(20) NOT NULL,
  `USERNAME` varchar(20) DEFAULT NULL,
  `PASWD` varchar(20) DEFAULT NULL,
  `id_nivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`USERID`, `USERNAME`, `PASWD`, `id_nivel`) VALUES
('1000065344', 'daniel', '1234', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `audit_students`
--
ALTER TABLE `audit_students`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`id_nivel`),
  ADD UNIQUE KEY `des_nivel` (`des_nivel`);

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USERID`),
  ADD KEY `fk_users_nivel` (`id_nivel`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `audit_students`
--
ALTER TABLE `audit_students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_nivel` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id_nivel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
