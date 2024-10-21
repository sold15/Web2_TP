<?php
require_once "database/config.php";

class Model {
    protected $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=booking;charset=utf8', 'root', '');
        // Verifica si la base de datos existe, si no lo hace la crea
        $this->db->exec('CREATE DATABASE IF NOT EXISTS ' . MYSQL_DB);
        $this->db->exec('USE ' . MYSQL_DB);
        $this->deploy();
    }

    function deploy() {
        // Chequear si hay tablas
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();

        if (count($tables) == 0) {
            // Si no hay tablas, crea las tablas y los datos
            $sql = <<<END
                                -- Estructura de tabla para la tabla `usuarios`
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
                (1, 'Moria', 'Casan', 'moriacasan@gmail.com'),
                (2, 'Ana Carolina', 'Ardohain', 'pampi1@gmail.com'),
                (3, 'Jimena', 'Baron', 'hope@gmail.com'),
                (4, 'Mora', 'Gomez', 'morita123gmail.com'),
                (5, 'Nadina', 'Osa', 'nadinosi@gmail.com');

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
                (4, 'Madrid', '2024-09-12', '2024-10-12', 1),
                (5, 'Chile', '2024-10-10', '2024-10-17', 2),
                (6, 'Orlando', '2024-10-01', '2024-10-23', 3),
                (7, 'Roma', '2024-09-13', '2024-09-27', 4),
                (8, 'Rio de Janeiro', '2024-12-22', '2025-01-03', 5);

                --
                -- Índices para tablas volcadas
                --

                --
                -- Indices de la tabla `registro`
                --
                ALTER TABLE `registro`
                ADD PRIMARY KEY (`id`);

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
                MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

                --
                -- AUTO_INCREMENT de la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

                --
                -- AUTO_INCREMENT de la tabla `viajes`
                --
                ALTER TABLE `viajes`
                MODIFY `ID_viajes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

                --
                -- Restricciones para tablas volcadas
                --

                --
                -- Filtros para la tabla `usuarios`
                --
                ALTER TABLE `usuarios`
                ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `viajes` (`id_usuario`) ON UPDATE CASCADE;
                COMMIT;

                END;
      $this->db->query($sql);
    }
  }
}
