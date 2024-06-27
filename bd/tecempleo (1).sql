-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2024 a las 22:25:13
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
-- Base de datos: `tecempleo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `Nombre_Cat` varchar(50) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `Nombre_Cat`, `Descripcion`) VALUES
(1, 'Tecnología', 'Categoría relacionada con tecnología'),
(2, 'Marketing', 'Categoría relacionada con marketing'),
(3, 'Finanzas', 'Categoría relacionada con finanzas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `Nombre_emp` varchar(100) DEFAULT NULL,
  `Direccion_emp` varchar(255) DEFAULT NULL,
  `Ciudad_emp` varchar(50) DEFAULT NULL,
  `Email_emp` varchar(100) DEFAULT NULL,
  `Telefono_emp` varchar(15) DEFAULT NULL,
  `Imagen_emp` varchar(250) DEFAULT NULL,
  `Contrasena` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `Nombre_emp`, `Direccion_emp`, `Ciudad_emp`, `Email_emp`, `Telefono_emp`, `Imagen_emp`, `Contrasena`) VALUES
(1, 'Empresa Tecnológica', 'Calle Principal 123', 'Ciudad Tecnológica', 'info@empresa.com', '+123456789', NULL, NULL),
(2, 'Empresa de Marketing', 'Avenida Comercial 456', 'Ciudad de Marketing', 'info@marketing.com', '+987654321', NULL, NULL),
(6, 'katronix', 'calle 22 sur', 'Bogotá D.C', 'katronix@gmail.com', '7852156', 'Imagen_emp/das.jpg', '$2y$10$bS5xUDyCXeMrBvZjcU.fcurki9uTkJslZVXzI3jsMcm1ebHaBthHy'),
(7, 'Findeter', 'call 22 sur', 'Bogota', 'findeter@gmail.co', '12313212313', 'Imagen_emp/WIN_20240318_14_40_47_Pro.jpg', '$2y$10$3670Gjx5RcoX9OwPTQPj9evJg1brwBTS4Eg7ZbbqhJ1glEeo7u.lS'),
(8, 'Smart ', 'call 22 sur', 'Bogota', 'smart@gmail.com', '3104056525', NULL, '$2y$10$QF2mm4O0VojwKeIGRcW2KuTNJ5vn9QehqJvP438NZhQBVbtfbkAmS'),
(9, 'asdad', 'dsadsa', 'asdas', 'empresa@gmail', '122332', NULL, '$2y$10$fTo9N/Ttn3UL5KcM2oTbeepLkCHXdcmvXNBllgUNhimr5V8r7zGKW'),
(10, '7-seven', 'call 22 sur', 'Bogota', 'moya@gmail.co', '213234231', NULL, '$2y$10$eKWvBd6qdl1UcCIpO/0G2O2ZzCDSbk1fKnVo0v2IGHXEyhsEMeWrO'),
(12, '7-seven', 'call 22 sur', 'Bogota', 'empresa@gmail.com', '78965432', NULL, '$2y$10$a63HqavYZS9pCWUMF0q6Gu9sYXGnehED6EAXnuLshS5PbfjgFAwrK'),
(13, 'alkosto', 'cr 15 #20-32', 'alkosto', 'alkosto@gmail.com', '3104056525', NULL, '$2y$10$MSlhzHLMFSV5dbhGWXwJI.Ig7g/2vOMF3lOACpEr4jw/XfNxuUkyK');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hdv`
--

CREATE TABLE `hdv` (
  `id_hdv` int(11) NOT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `nombre_cargo` varchar(100) DEFAULT NULL,
  `funciones` text DEFAULT NULL,
  `trabajando` varchar(50) DEFAULT NULL,
  `desde` date DEFAULT NULL,
  `hasta` date DEFAULT NULL,
  `nivel_educativo` varchar(50) DEFAULT NULL,
  `centro_educativo` varchar(100) DEFAULT NULL,
  `cursando_actualmente` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_Documento` int(11) NOT NULL,
  `Usuario_id` int(11) DEFAULT NULL,
  `Fotografia` varchar(255) DEFAULT NULL,
  `Profesion` varchar(100) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Sexo` char(1) DEFAULT NULL,
  `Departamento` varchar(50) DEFAULT NULL,
  `Ciudad` varchar(50) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Correo_Electronico` varchar(100) DEFAULT NULL,
  `id_hdv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_Documento`, `Usuario_id`, `Fotografia`, `Profesion`, `Edad`, `Fecha_Nacimiento`, `Sexo`, `Departamento`, `Ciudad`, `Direccion`, `Telefono`, `Correo_Electronico`, `id_hdv`) VALUES
(108523654, 1, 'Fotografia_perfil/imagen2.jpg', 'desarrollador de software', 18, '2005-07-22', 'M', 'Cundinamarca', 'Bogotá D.C', 'calle 89 sur # 2-18', '3123813779', 'santiagomoyano@gmail.com', NULL),
(1074158334, 7, 'Fotografia_perfil/Software WEB.png', 'desarrollador de software', 18, '2005-07-22', 'M', 'Cundinamarca', 'Bogotá D.C', 'calle 89 sur # 2-18', '3123813779', 'julianmoreno@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulacion`
--

CREATE TABLE `postulacion` (
  `id_postulacion` int(11) NOT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `id_vacante` int(11) DEFAULT NULL,
  `estado` enum('Activo','Cerrado') DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `postulacion`
--

INSERT INTO `postulacion` (`id_postulacion`, `usuarios_id`, `id_vacante`, `estado`) VALUES
(8, 1, 6, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntaje`
--

CREATE TABLE `puntaje` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `puntaje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puntaje`
--

INSERT INTO `puntaje` (`id`, `id_usuario`, `puntaje`) VALUES
(51, 11, 5),
(52, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_encuesta`
--

CREATE TABLE `respuestas_encuesta` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `pregunta_problema` varchar(255) DEFAULT NULL,
  `pregunta_trabajo` varchar(255) DEFAULT NULL,
  `pregunta_caracteristicas` varchar(255) DEFAULT NULL,
  `pregunta_ayuda` varchar(255) DEFAULT NULL,
  `pregunta_cambio` varchar(255) DEFAULT NULL,
  `pregunta_presion` varchar(255) DEFAULT NULL,
  `pregunta_decisiones` varchar(255) DEFAULT NULL,
  `pregunta_liderazgo` varchar(255) DEFAULT NULL,
  `pregunta_responsabilidad` varchar(255) DEFAULT NULL,
  `pregunta_lider` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas_encuesta`
--

INSERT INTO `respuestas_encuesta` (`id`, `id_usuario`, `genero`, `pregunta_problema`, `pregunta_trabajo`, `pregunta_caracteristicas`, `pregunta_ayuda`, `pregunta_cambio`, `pregunta_presion`, `pregunta_decisiones`, `pregunta_liderazgo`, `pregunta_responsabilidad`, `pregunta_lider`) VALUES
(84, 11, 'mujer', 'Intentar resolverlo por ti mismo.', 'Me resulta difícil manejar la presión y puedo sentirme abrumado/a.', 'Inspirar y motivar a los miembros del equipo', 'Analizar la situación y buscar soluciones posibles', 'Esperar a que el cambio se revierta antes de tomar alguna acción.', 'Trabajando más horas para terminar todo a tiempo.', 'Consultar con colegas y analizar todas las alternativas antes de decidir.', 'Autoritarismo y control estricto sobre los miembros del equipo.', 'Evitar asumir responsabilidades para no arriesgarse.', 'Evitar la delegación de responsabilidades para mantener el control.'),
(85, 1, 'hombre', 'Pedir ayuda a un colega.', 'Mantengo la calma y busco soluciones de manera sistemática.', 'Evitar la delegación de tareas', 'Ignorar el problema y esperar que se resuelva solo', 'Esperar a que el cambio se revierta antes de tomar alguna acción.', 'Pidiendo ayuda a colegas para dividir las tareas y compartir la carga.', 'Dejar que otros tomen las decisiones por ti.', 'Empatía y habilidades para motivar a los demás.', 'Echar la culpa a otros cuando surgen problemas.', 'Empatía y habilidades para motivar a los demás.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `Email_Reg` varchar(255) NOT NULL,
  `Contrasena` varchar(255) NOT NULL,
  `Nombre_Reg` varchar(100) DEFAULT NULL,
  `Apellido_Reg` varchar(100) DEFAULT NULL,
  `Rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `Email_Reg`, `Contrasena`, `Nombre_Reg`, `Apellido_Reg`, `Rol`) VALUES
(1, 'santiagomoyano@gmail.com', '$2y$10$uUFIk1cmmZfc7DXFsVTGieRz4SGvHTy2FL1CsFYAHsLr3Zm0idD8G', 'santiago', 'moyano', 'usuario'),
(2, 'santiagomoya@gmail.com', '$2y$10$VWwAMh0T2UqzZugjHbYSmOyDlns5XdgHFBVhHx/glO.g2Z90HXjwm', 'santiago', 'moya', 'usuario'),
(5, 'Admin1@gmail.com', '$2y$10$N2NK1JpF9AizjUp9T7ljyuPjMoYvYuzZ9qRkdC4tPeVxAPeFYol2u', 'julian', 'moreno', 'administrador'),
(6, 'jucapa@gmail.com', '$2y$10$h1OZKSLDu6iKj7CcPXkN0usxO.SlelCNDEcHPs1c2fArzIn555cDW', 'juan', 'pardo', 'recursos_humanos'),
(7, 'julianmoreno@gmail.com', '$2y$10$/UL5iHGoqXooZMVhriHlEOZEMhnAuk/yGfvmL5rDtGgU29HTpjGYm', 'julian', 'moreno', 'usuario'),
(11, 'karlaperez@gmail.com', '$2y$10$jn2ecF9vJV0Vcwp5drthFectmkSbCWsTZJeaoq4ANsm0A02Lp1Tj.', 'karla', 'perez', 'usuario'),
(25, 'carlosperez@gmail.com', '$2y$10$NBBye4JJKSY9Mr5AZbwb8OV3Nr2/Hl87.Jy4/8x.4slT8LkOapNrK', 'perez', 'carlos', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacantes`
--

CREATE TABLE `vacantes` (
  `idVacantes` int(11) NOT NULL,
  `Categoria_idCategoria` int(11) DEFAULT NULL,
  `Empresa_id_empresa` int(11) DEFAULT NULL,
  `Descripcion_vac` text DEFAULT NULL,
  `Fecha_Publicacion` date DEFAULT NULL,
  `Fecha_Cierre` date DEFAULT NULL,
  `Estado` varchar(20) DEFAULT NULL,
  `Salario` decimal(10,2) DEFAULT NULL,
  `enlace_vacante` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vacantes`
--

INSERT INTO `vacantes` (`idVacantes`, `Categoria_idCategoria`, `Empresa_id_empresa`, `Descripcion_vac`, `Fecha_Publicacion`, `Fecha_Cierre`, `Estado`, `Salario`, `enlace_vacante`) VALUES
(1, 1, 1, 'Descripción de la primera vacante de tecnología', '2024-03-18', '2024-04-18', 'Abierto', 1200000.00, NULL),
(2, 2, 1, 'Descripción de la primera vacante de marketing', '2024-03-18', '2024-04-18', 'Abierto', 2500000.00, NULL),
(3, 1, 2, 'Descripción de la segunda vacante de tecnología', '2024-03-18', '2024-04-18', 'Abierto', NULL, NULL),
(4, 1, 1, 'Desarrollador ruby', '2024-03-28', '0024-10-18', 'activo', NULL, NULL),
(5, 1, 1, 'desarrollador frond end', '2024-03-30', '2024-04-30', 'activo', NULL, NULL),
(6, 2, 7, 'Buscamos ', '2024-04-01', '2024-04-17', 'Activo', 99999999.99, NULL),
(7, 1, 13, 'desarrollador', '2024-04-05', '2024-04-15', 'Activo', 2000000.00, 'https://uiverse.io/loaders?page=11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `hdv`
--
ALTER TABLE `hdv`
  ADD PRIMARY KEY (`id_hdv`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_Documento`),
  ADD KEY `Usuario_id` (`Usuario_id`),
  ADD KEY `id_hdv` (`id_hdv`);

--
-- Indices de la tabla `postulacion`
--
ALTER TABLE `postulacion`
  ADD PRIMARY KEY (`id_postulacion`),
  ADD KEY `usuarios_id` (`usuarios_id`),
  ADD KEY `id_vacante` (`id_vacante`);

--
-- Indices de la tabla `puntaje`
--
ALTER TABLE `puntaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `respuestas_encuesta`
--
ALTER TABLE `respuestas_encuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacantes`
--
ALTER TABLE `vacantes`
  ADD PRIMARY KEY (`idVacantes`),
  ADD KEY `Categoria_idCategoria` (`Categoria_idCategoria`),
  ADD KEY `Empresa_id_empresa` (`Empresa_id_empresa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `hdv`
--
ALTER TABLE `hdv`
  MODIFY `id_hdv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_Documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `postulacion`
--
ALTER TABLE `postulacion`
  MODIFY `id_postulacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `puntaje`
--
ALTER TABLE `puntaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `respuestas_encuesta`
--
ALTER TABLE `respuestas_encuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `vacantes`
--
ALTER TABLE `vacantes`
  MODIFY `idVacantes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`Usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `perfil_ibfk_2` FOREIGN KEY (`id_hdv`) REFERENCES `hdv` (`id_hdv`);

--
-- Filtros para la tabla `postulacion`
--
ALTER TABLE `postulacion`
  ADD CONSTRAINT `postulacion_ibfk_1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `puntaje`
--
ALTER TABLE `puntaje`
  ADD CONSTRAINT `puntaje_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `respuestas_encuesta`
--
ALTER TABLE `respuestas_encuesta`
  ADD CONSTRAINT `respuestas_encuesta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `vacantes`
--
ALTER TABLE `vacantes`
  ADD CONSTRAINT `vacantes_ibfk_1` FOREIGN KEY (`Categoria_idCategoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `vacantes_ibfk_2` FOREIGN KEY (`Empresa_id_empresa`) REFERENCES `empresa` (`id_empresa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
