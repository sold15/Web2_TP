-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2024 a las 04:02:20
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `booking`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id_registro` int(55) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id_registro`, `nombre_usuario`, `password`) VALUES
(1, 'webadmin', '$2y$10$mBQ9qu.flqPxRN.687b8n.7eiTzL7kDZ7FTjkyYgv/xkvd7Pkuige');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `gmail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `gmail`) VALUES
(5, 'Nadina', 'Osa', 'nadinosi@gmail.com'),
(6, 'simon', 'arrechavaleta', 'simoarre@gmail.com'),
(7, 'thiago', 'bedoya aguero', 'thiagobe@gmail.com'),
(8, 'agustin', 'kala', 'aguskala@gmail.com'),
(9, 'claudia', 'sivo', 'clausivo@gmail.com'),
(10, 'manuel', 'figueroa', 'manufigue@gmail.com'),
(11, 'Nicholas', 'Chavez', 'nichochavezz@gmail.com'),
(12, 'Susana', 'Gimenez', 'sugimenez@gmail.com'),
(13, 'Carolina', 'Rodriguez', 'carorodri7@gmail.com'),
(14, 'Juana ', 'Lanzani', 'juajua9@gmail.com'),
(15, 'Rodrigo', 'Serrano', 'rodriserrano@gmail.com'),
(16, 'Martin', 'Cirio', 'martinacirio@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `ID_viajes` int(11) NOT NULL,
  `destino` varchar(200) NOT NULL,
  `salida` date NOT NULL,
  `regreso` date NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`ID_viajes`, `destino`, `salida`, `regreso`, `id_usuario`) VALUES
(8, 'Rio de Janeiro', '2024-12-22', '2025-01-03', 5),
(9, 'Barcelona', '2024-10-31', '2024-11-29', 6),
(10, 'Londres', '2024-11-01', '2025-03-03', 7),
(11, 'Salta', '2024-12-05', '2025-01-09', 8),
(12, 'Santa Cruz', '2025-01-03', '2025-01-15', 9),
(13, 'Moscu', '2024-11-01', '2024-12-12', 10),
(14, 'Texas', '2024-10-22', '2024-11-22', 11),
(15, 'Ciudad de Mexico', '2024-10-25', '2024-12-26', 12),
(16, 'Montevideo', '2024-11-08', '2024-11-20', 13),
(17, 'Berlin', '2024-11-03', '2024-11-13', 14),
(18, 'Lisboa', '2024-11-01', '2024-11-30', 15),
(19, 'San Francisco', '2024-12-05', '2025-02-05', 16);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id_registro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `gmail` (`gmail`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`ID_viajes`),
  ADD KEY `ID_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id_registro` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `ID_viajes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `viajes` (`id_usuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
