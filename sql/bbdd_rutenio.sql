SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


-- CREATE DATABASE bbdd_rutenio;


-- CREATE USER 'admin'@'%' IDENTIFIED VIA mysql_native_password USING '***';GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 9999 MAX_CONNECTIONS_PER_HOUR 9999 MAX_UPDATES_PER_HOUR 9999 MAX_USER_CONNECTIONS 9997;GRANT ALL PRIVILEGES ON `admin\_%`.* TO 'admin'@'%';GRANT ALL PRIVILEGES ON `bbdd_rutenio`.* TO 'admin'@'%';
-- CREATE USER 'rutenio'@'%' IDENTIFIED VIA mysql_native_password USING '***';GRANT ALL PRIVILEGES ON *.* TO 'rutenio'@'%' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 999 MAX_CONNECTIONS_PER_HOUR 999 MAX_UPDATES_PER_HOUR 999 MAX_USER_CONNECTIONS 999;CREATE DATABASE IF NOT EXISTS `rutenio`;GRANT ALL PRIVILEGES ON `rutenio`.* TO 'rutenio'@'%';GRANT ALL PRIVILEGES ON `rutenio\_%`.* TO 'rutenio'@'%';GRANT ALL PRIVILEGES ON `bbdd_rutenio`.* TO 'rutenio'@'%';


CREATE TABLE `recurso` (
	`rec_id` int(4) NOT NULL,
	`rec_tipo` varchar (25) COLLATE utf8_spanish_ci NOT NULL,
	`rec_nombre` varchar (50) COLLATE utf8_spanish_ci NOT NULL,
	`rec_disponibilidad` boolean NOT NULL,
	`rec_fecha` timestamp NULL,
	`rec_descripcion` text COLLATE utf8_spanish_ci NULL,
	`rec_img` varchar(25) NULL,
	`rec_incidencia` text COLLATE utf8_spanish_ci NULL,
	`rec_incidencia_estado` boolean NOT NULL,
	`usu_id` int (4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `usuario` (
	`usu_id` int(4) NOT NULL,
	`usu_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
	`usu_apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
	`usu_correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
	`usu_password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
	`usu_seguridad` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `usuario` (`usu_id`, `usu_nombre`, `usu_apellido`, `usu_correo`, `usu_password`, `usu_seguridad`) VALUES
(1, 'Alex', 'Perez', 'alex@gmail.com', 'qweQWE123', 'Milú'),
(2, 'Irene', 'Fernandez', 'irene@gmail.com', 'asdASD123', 'Draco'),
(3, 'David', 'Gomez', 'david@gmail.com', 'zxcZXC123', 'Pitus'),
(4, 'Maria', 'Gil', 'maria@gmail.com', 'qazQAZ123', 'Akira'),
(5, 'Javier', 'Ortiz', 'javier@gmail.com', 'wsxWSX123', 'Flash'),
(6, 'Sherlock', 'Holmes', 'sherlock@gmail.com', 'abcABC123', 'Rocky'),
(7, 'John', 'Watson', 'john@gmail.com', '123456789', 'Bilbo'),
(8, 'Irene', 'Adler', 'adler@gmail.com', '987654321', 'Isti'),
(9, 'Admin', 'Admin', 'admin@gmail.com', '1234', 'Lumi');


INSERT INTO `recurso` (`rec_id`, `rec_tipo`, `rec_nombre`, `rec_disponibilidad`, `rec_fecha`, `rec_descripcion`, `rec_img`, `rec_incidencia`, `rec_incidencia_estado`, `usu_id`) VALUES
(1, 'Aula de teoría', 'Aula de teoría con proyector', '1', '2017-11-10 14:10:48', '', 'imagenes/bici5.png', '', '0', 1),
(2, 'Aula de teoría', 'Aula de teoría con proyector', '1', '2017-11-10 14:10:48', '', 'imagenes/bici5.png', '', '0', 1),
(3, 'Aula de teoría', 'Aula de teoría sin proyector', '1', '2017-11-10 14:10:48', '', 'imagenes/bici5.png', '', '0', 1),
(4, 'Aula de informática', 'Aula de informática', '1', '2017-11-10 14:10:48', '', 'imagenes/bici5.png', '', '0', 1),
(5, 'Aula de informática', 'Aula de informática', '1', '2017-11-10 14:10:48', '', 'imagenes/bici5.png', '', '0', 1),
(6, 'Sala', 'Despacho para entrevistas', '1', '2017-11-10 14:10:48', '', 'imagenes/bici5.png', '', '0', 1),
(7, 'Sala', 'Despacho para entrevistas', '1', '2017-11-10 14:10:48', '', 'imagenes/bici5.png', '', '0', 1),
(8, 'Sala', 'Sala de reuniones', '1', '2017-11-10 14:10:48', '', 'imagenes/bici5.png', '', '0', 1),
(9, 'Proyector', 'Proyector', '1', '2017-11-10 14:10:48', '', 'imagenes/proyector.png', '', '0', 1),
(10, 'Carro de portatiles', 'Carro de portatiles', '1', '2017-11-10 14:10:48', '', 'imagenes/bici5.png', '', '0', 1),
(11, 'Portátil', 'Portátil', '1', '2017-11-10 14:10:48', '', 'imagenes/portatil.png', '', '0', 1),
(12, 'Portátil', 'Portátil', '1', '2017-11-10 14:10:48', '', 'imagenes/portatil2.png', '', '0', 1),
(13, 'Portátil', 'Portátil', '1', '2017-11-10 14:10:48', '', 'imagenes/portatil3.png', '', '0', 1),
(14, 'Móvil', 'Móvil', '1', '2017-11-10 14:10:48', '', 'imagenes/smartphone.png', '', '0', 1),
(15, 'Móvil', 'Móvil', '1', '2017-11-10 14:10:48', '', 'imagenes/smartphone2.png', '', '0', 1);

ALTER TABLE `recurso`
ADD PRIMARY KEY (`rec_id`);


ALTER TABLE `usuario`
ADD PRIMARY KEY (`usu_id`);

ALTER TABLE `recurso`
MODIFY `rec_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

ALTER TABLE `usuario`
MODIFY `usu_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;    

ALTER TABLE `recurso`
ADD CONSTRAINT `fk_recurso_usuario` FOREIGN KEY (`usu_id`) REFERENCES `usuario`(`usu_id`);

UPDATE `recurso` SET `usu_id` = '9' WHERE `rec_disponibilidad` = '1';