SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE DATABASE bbdd_rutenio;



CREATE TABLE `recurso` (
	`rec_id` int(4) NOT NULL,
	`rec_tipo` varchar (25) COLLATE utf8_spanish_ci NOT NULL,
	`rec_nombre` varchar (50) COLLATE utf8_spanish_ci NOT NULL,
	`rec_disponibilidad` boolean NOT NULL,
	`rec_fecha` timestamp NULL,
	`rec_descripcion` text COLLATE utf8_spanish_ci NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `usuario` (
	`usu_id` int(4) NOT NULL,
	`usu_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
	`usu_apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
	`usu_correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
	`usu_contraseña` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `usuario` (`usu_id`, `usu_nombre`, `usu_apellido`, `usu_correo`, `usu_contraseña`) VALUES
(1, 'Alex', 'Perez', 'alex@gmail.com', 'qweQWE123'),
(2, 'Irene', 'Fernandez', 'irene@gmail.com', 'asdASD123'),
(3, 'David', 'Gomez', 'david@gmail.com', 'zxcZXC123'),
(4, 'Maria', 'Gil', 'maria@gmail.com', 'qazQAZ123'),
(5, 'Javier', 'Ortiz', 'javier@gmail.com', 'wsxWSX123'),
(6, 'Sherlock', 'Holmes', 'sherlock@gmail.com', 'abcABC123'),
(7, 'John', 'Watson', 'john@gmail.com', '123456789'),
(8, 'Irene', 'Adler', 'adler@gmail.com', '987654321');


INSERT INTO `recurso` (`rec_id`, `rec_tipo`, `rec_nombre`, `rec_disponibilidad`, `rec_fecha`, `rec_descripcion`) VALUES
(1, 'Aula de teoría', 'Aula de teoría con proyector', '0', '2017-11-10 14:10:48', ''),
(2, 'Aula de teoría', 'Aula de teoría con proyector', '1', '2017-11-10 14:10:48', ''),
(3, 'Aula de teoría', 'Aula de teoría sin proyector', '1', '2017-11-10 14:10:48', ''),
(4, 'Aula de informática', 'Aula de informática', '1', '2017-11-10 14:10:48', ''),
(5, 'Aula de informática', 'Aula de informática', '1', '2017-11-10 14:10:48', ''),
(6, 'Sala', 'Despacho para entrevistas', '1', '2017-11-10 14:10:48', ''),
(7, 'Sala', 'Despacho para entrevistas', '1', '2017-11-10 14:10:48', ''),
(8, 'Sala', 'Sala de reuniones', '1', '2017-11-10 14:10:48', ''),
(9, 'Proyector', 'Proyector', '1', '2017-11-10 14:10:48', ''),
(10, 'Carro de portatiles', 'Carro de portatiles', '1', '2017-11-10 14:10:48', ''),
(11, 'Portátil', 'Portátil', '1', '2017-11-10 14:10:48', ''),
(12, 'Portátil', 'Portátil', '1', '2017-11-10 14:10:48', ''),
(13, 'Portátil', 'Portátil', '1', '2017-11-10 14:10:48', ''),
(14, 'Móvil', 'Móvil', '1', '2017-11-10 14:10:48', ''),
(15, 'Móvil', 'Móvil', '1', '2017-11-10 14:10:48', '');

ALTER TABLE `recurso`
ADD PRIMARY KEY (`rec_id`);


ALTER TABLE `usuario`
ADD PRIMARY KEY (`usu_id`);

ALTER TABLE `recurso`
ADD COLUMN `usu_id` int(4) NOT NULL;

ALTER TABLE `recurso`
MODIFY `rec_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

ALTER TABLE `usuario`
MODIFY `usu_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;    

ALTER TABLE `recurso`
ADD CONSTRAINT `fk_recurso_usuario` FOREIGN KEY (`usu_id`) REFERENCES `usuario`(`usu_id`);

UPDATE `recurso` SET `usu_id` = '1' WHERE `recurso`.`rec_id` = 1;