/*
 Navicat Premium Data Transfer

 Source Server         : Mysql
 Source Server Type    : MySQL
 Source Server Version : 80031 (8.0.31)
 Source Host           : localhost:3306
 Source Schema         : sistemavivero

 Target Server Type    : MySQL
 Target Server Version : 80031 (8.0.31)
 File Encoding         : 65001

 Date: 08/05/2023 21:52:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `apellidos` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `cedula` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `sexo` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `telefono` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `createt` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (1, 'JORGE MOISES', 'RAMIREZ ZAVLA', 'elgamereee@hptmail.com', '121212', 'Masculino', 'milafro', '0940321850', 1, '123', 0);
INSERT INTO `cliente` VALUES (2, 'editado empresa', 'bbbbbbbbb', 'elgamerrrr@hotmail.com', '132323', 'Masculino', 'ssssssss', '11111111', 1, '098', 1);
INSERT INTO `cliente` VALUES (3, 'editado tienda', 'fffffff', 'elgamertttt@hotmail.com', '343434', 'Masculino', 'ssssssss', '11111111', 1, '123', 0);
INSERT INTO `cliente` VALUES (9, 'JORGE JOSE', 'ZAVALA RAMIREZ', 'ELGAMER-26@HOTMAIL.COM', '0940321857', 'Masculino', 'MI CASITA ', '0987654321', 1, '123', 0);
INSERT INTO `cliente` VALUES (10, 'JOSE ANDRES', 'ALFARO LOOR', 'jorgemoisesramirez201412122@gmail.com', '09403217', 'Masculino', 'MILAGRO', '098765432', 1, 'ym86sr45q.', 1);
INSERT INTO `cliente` VALUES (11, 'aaaaaaaa', 'bbbbbbbb', 'jorgemoisesramirez201422@gmail.com', '0940321854', 'Femenino', 'milagro', '0987654321', 1, 'kmrs69bpm.', 1);

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `ruc` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `telefono` char(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `actividad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  `foto` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of empresa
-- ----------------------------
INSERT INTO `empresa` VALUES (1, 'nombre editado', 'direccion editado', 'correo@hotmail.com', '1245', '09876', 'actividad esto es editado por el usuario wey', 'IMG55202321580.png');

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `tipo_id` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  `imagen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tipo_id`(`tipo_id` ASC) USING BTREE,
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES (1, '77959826', 'PLANTA EDITADA', 1, 159.00, 'Descripción del producto', 'IMG85202321507.jpg', 1);
INSERT INTO `producto` VALUES (2, '874084907', 'Nombre', 3, 7453.00, 'ES UNA DESCRIPCION', 'IMG852023214933.jpg', 1);

-- ----------------------------
-- Table structure for rol
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `rol` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rol
-- ----------------------------
INSERT INTO `rol` VALUES (1, 'idd', '2023-04-23 18:41:23', 1);
INSERT INTO `rol` VALUES (2, 'SUPER USER', '2023-04-23 18:42:08', 1);
INSERT INTO `rol` VALUES (3, 'adminitrador uno', '2023-04-23 19:04:23', 1);
INSERT INTO `rol` VALUES (4, 'NUEVO TIPO', '2023-05-07 20:21:37', 0);

-- ----------------------------
-- Table structure for tipo_producto
-- ----------------------------
DROP TABLE IF EXISTS `tipo_producto`;
CREATE TABLE `tipo_producto`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_producto
-- ----------------------------
INSERT INTO `tipo_producto` VALUES (1, 'CAPUS EDITADO', 1);
INSERT INTO `tipo_producto` VALUES (2, 'NUEVO TIPO DE PRODUCTO edit', 1);
INSERT INTO `tipo_producto` VALUES (3, 'NUEVO TIPO EDITADO', 1);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `apellidos` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `cedula` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `rol_id` int NULL DEFAULT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `passwordd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `rol_id`(`rol_id` ASC) USING BTREE,
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'NOMBRE EDITADO', 'APELLIDO EDITADO', 'EDITADO@HOTMAIL.COM', '0940321854', 2, 'USUARIOEDITADO', '123', 'admin.jpg', '2023-04-26 20:53:53', 1);
INSERT INTO `usuario` VALUES (2, 'JORGE MMOISES', 'RAMIREZ ZAVALA', 'ELGAGA@HOTMAIL.COM', '0940321850', 2, 'AAAAAA', '123', 'admin.jpg', '2023-04-28 20:32:36', 1);
INSERT INTO `usuario` VALUES (3, 'aaaaaaaaaaa', 'bbbbbbbbbb', '1ELGAGA@HOTMAIL.COM', '0940321856', 3, '11111', '123', 'admin.jpg', '2023-04-28 20:38:38', 1);
INSERT INTO `usuario` VALUES (4, 'JORGE MOISES', 'RAMIREZ ZAVALA', 'elgamer-26@hotmail.com', '0940321851', 3, 'admin', '123', 'IMG252023223624.png', '2023-04-28 20:40:07', 1);

-- ----------------------------
-- Procedure structure for EditarCliente
-- ----------------------------
DROP PROCEDURE IF EXISTS `EditarCliente`;
delimiter ;;
CREATE PROCEDURE `EditarCliente`(in nombrev VARCHAR(100), in apellidov VARCHAR(100), in correov VARCHAR(80), in cedulav VARCHAR(10), in sexov CHAR(10), in direccionv VARCHAR(100), in telefono CHAR(15), in idd int)
BEGIN

	DECLARE coun_correo INT;
	DECLARE coun_cedula INT;
	
	set @coun_correo = (select COUNT(*) from cliente WHERE correo = correov AND id != idd);
		if @coun_correo = 0 THEN
		
				set @coun_cedula = (select COUNT(*) from cliente WHERE cedula = cedulav AND id != idd);
				if @coun_cedula = 0 THEN
	
					UPDATE cliente SET nombre = nombrev, apellidos = apellidov, correo = correov, cedula = cedulav, sexo = sexov, direccion = direccionv, telefono = telefono WHERE id = idd;
					
					SELECT 1;
				ELSE
					SELECT 2;
			end if;
		
		ELSE
				SELECT 3;
		end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for EditarProducto
-- ----------------------------
DROP PROCEDURE IF EXISTS `EditarProducto`;
delimiter ;;
CREATE PROCEDURE `EditarProducto`(in idd int, in codigov VARCHAR(15), in nombrev VARCHAR(100), in tipo_productov int, in precio_ventav DECIMAL(10,2), in descripcionv TEXT)
BEGIN

	DECLARE coun_codigo INT; 
	
	set @coun_codigo = (select COUNT(*) from producto WHERE codigo = codigov AND id != idd);
	
	if @coun_codigo = 0 THEN
		UPDATE producto SET codigo = codigov, nombre = nombrev, tipo_id = tipo_productov, precio = precio_ventav, descripcion = descripcionv WHERE id = idd;
		SELECT 1;
	ELSE
		SELECT 2;
	end if;
 
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for EditarTipoProducto
-- ----------------------------
DROP PROCEDURE IF EXISTS `EditarTipoProducto`;
delimiter ;;
CREATE PROCEDURE `EditarTipoProducto`(in nombre VARCHAR(50), in idd int)
BEGIN

	DECLARE valor INT;
	
	set @valor = (select COUNT(*) from tipo_producto WHERE BINARY tipo = nombre AND id != idd);
		if @valor = 0 THEN
				UPDATE tipo_producto SET tipo = nombre WHERE id = idd;
				SELECT 1;
			ELSE
				SELECT 2;
		end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for EditarUsuario
-- ----------------------------
DROP PROCEDURE IF EXISTS `EditarUsuario`;
delimiter ;;
CREATE PROCEDURE `EditarUsuario`(in idd int, in nombrev VARCHAR(100), in apellidov VARCHAR(100), in correov VARCHAR(75), in cedulav VARCHAR(10), in tipo_rolv int, in usuariov VARCHAR(50))
BEGIN

	DECLARE coun_correo INT;
	DECLARE coun_cedula INT;
	set @coun_correo = (select COUNT(*) from usuario WHERE correo = correov and id != idd);
		if @coun_correo = 0 THEN
				set @coun_cedula = (select COUNT(*) from usuario WHERE cedula = cedulav and id != idd);
				if @coun_cedula = 0 THEN
				update usuario set nombres = nombrev, apellidos = apellidov, correo = correov, cedula = cedulav, rol_id = tipo_rolv, usuario = usuariov WHERE id = idd;
					SELECT 1;
				ELSE
					SELECT 2;
			end if;
		
		ELSE
				SELECT 3;
		end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for GuardarDatoPerfilUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `GuardarDatoPerfilUser`;
delimiter ;;
CREATE PROCEDURE `GuardarDatoPerfilUser`(in nombrev VARCHAR(100), in apellidov VARCHAR(100), in correov VARCHAR(75), in usuariov VARCHAR(50), in idd INT)
BEGIN

	DECLARE coun_correo INT;
	DECLARE coun_usuario INT;
	
	set @coun_correo = (select COUNT(*) from usuario WHERE correo = correov AND id != idd);
		if @coun_correo = 0 THEN
				set @coun_usuario = (select COUNT(*) from usuario WHERE usuario = usuariov AND id != idd);
				if @coun_usuario = 0 THEN
						update usuario set nombres = nombrev, apellidos = apellidov, correo = correov, usuario = usuariov WHERE id = idd;
						SELECT 1;
				ELSE
						SELECT 2;
			end if;
		ELSE
					SELECT 3;
		end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for ModificarRol
-- ----------------------------
DROP PROCEDURE IF EXISTS `ModificarRol`;
delimiter ;;
CREATE PROCEDURE `ModificarRol`(in nombre VARCHAR(50), in idd int)
BEGIN
	DECLARE valor INT;
	set @valor = (select COUNT(*) from rol WHERE BINARY rol = nombre AND id != idd);
		if @valor = 0 THEN
				UPDATE rol set rol = nombre where id = idd;
				SELECT 1;
			ELSE
				SELECT 2;
		end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for RegistraCliente
-- ----------------------------
DROP PROCEDURE IF EXISTS `RegistraCliente`;
delimiter ;;
CREATE PROCEDURE `RegistraCliente`(in nombrev VARCHAR(100), in apellidov VARCHAR(100), in correov VARCHAR(80), in cedulav VARCHAR(10), in sexov CHAR(10), in direccionv VARCHAR(100), in telefono CHAR(15))
BEGIN

	DECLARE coun_correo INT;
	DECLARE coun_cedula INT;
	
	set @coun_correo = (select COUNT(*) from cliente WHERE correo = correov);
		if @coun_correo = 0 THEN
		
				set @coun_cedula = (select COUNT(*) from cliente WHERE cedula = cedulav);
				if @coun_cedula = 0 THEN
	
					INSERT into cliente (nombre,apellidos,correo,cedula,sexo,direccion,telefono,createt) VALUES (nombrev,apellidov,correov,cedulav,sexov,direccionv,telefono,1);
					
					SELECT LAST_INSERT_ID();
				ELSE
					SELECT 2;
			end if;
		
		ELSE
				SELECT 3;
		end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for RegistraClienteTienda
-- ----------------------------
DROP PROCEDURE IF EXISTS `RegistraClienteTienda`;
delimiter ;;
CREATE PROCEDURE `RegistraClienteTienda`(in nombrev VARCHAR(100), in apellidov VARCHAR(100), in correov VARCHAR(80), in cedulav VARCHAR(10), in sexov CHAR(10), in direccionv VARCHAR(100), in telefono CHAR(15))
BEGIN

	DECLARE coun_correo INT;
	DECLARE coun_cedula INT;
	
	set @coun_correo = (select COUNT(*) from cliente WHERE correo = correov);
		if @coun_correo = 0 THEN
		
				set @coun_cedula = (select COUNT(*) from cliente WHERE cedula = cedulav);
				if @coun_cedula = 0 THEN
	
					INSERT into cliente (nombre,apellidos,correo,cedula,sexo,direccion,telefono,createt) VALUES (nombrev,apellidov,correov,cedulav,sexov,direccionv,telefono,0);
					
					SELECT LAST_INSERT_ID();
				ELSE
					SELECT 2;
			end if;
		
		ELSE
				SELECT 3;
		end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for RegistraProducto
-- ----------------------------
DROP PROCEDURE IF EXISTS `RegistraProducto`;
delimiter ;;
CREATE PROCEDURE `RegistraProducto`(in codigov VARCHAR(15), in nombrev VARCHAR(100), in tipo_productov int, in precio_ventav DECIMAL(10,2), in descripcionv TEXT, in imagenv VARCHAR(100))
BEGIN

	DECLARE coun_codigo INT; 
	
	set @coun_codigo = (select COUNT(*) from producto WHERE codigo = codigov);
  
	if @coun_codigo = 0 THEN
		INSERT into producto (codigo,nombre,tipo_id,precio,descripcion,imagen) VALUES (codigov,nombrev,tipo_productov,precio_ventav,descripcionv,imagenv);
		SELECT 1;
	ELSE
		SELECT 2;
	end if;
 
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for RegistrarRol
-- ----------------------------
DROP PROCEDURE IF EXISTS `RegistrarRol`;
delimiter ;;
CREATE PROCEDURE `RegistrarRol`(in nombre VARCHAR(50))
BEGIN

	DECLARE valor INT;
	
	set @valor = (select COUNT(*) from rol WHERE BINARY rol = nombre);
		if @valor = 0 THEN
				INSERT into rol (rol) VALUES (nombre);
				SELECT 1;
			ELSE
				SELECT 2;
		end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for RegistrarUsuario
-- ----------------------------
DROP PROCEDURE IF EXISTS `RegistrarUsuario`;
delimiter ;;
CREATE PROCEDURE `RegistrarUsuario`(in nombrev VARCHAR(100), in apellidov VARCHAR(100), in correov VARCHAR(75), in cedulav VARCHAR(10), in tipo_rolv int, in usuariov VARCHAR(50), in ppasswordv VARCHAR(50), in imagenv VARCHAR(100))
BEGIN

	DECLARE coun_correo INT;
	DECLARE coun_cedula INT;
	
	set @coun_correo = (select COUNT(*) from usuario WHERE correo = correov);
		if @coun_correo = 0 THEN
		
				set @coun_cedula = (select COUNT(*) from usuario WHERE cedula = cedulav);
				if @coun_cedula = 0 THEN
	
					INSERT into usuario (nombres,apellidos,correo,cedula,rol_id,usuario,passwordd,foto) VALUES (nombrev,apellidov,correov,cedulav,tipo_rolv,usuariov,ppasswordv,					 imagenv);
					SELECT 1;
				ELSE
					SELECT 2;
			end if;
		
		ELSE
				SELECT 3;
		end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for RegistraTipoProducto
-- ----------------------------
DROP PROCEDURE IF EXISTS `RegistraTipoProducto`;
delimiter ;;
CREATE PROCEDURE `RegistraTipoProducto`(in nombre VARCHAR(50))
BEGIN

	DECLARE valor INT;
	
	set @valor = (select COUNT(*) from tipo_producto WHERE BINARY tipo = nombre);
		if @valor = 0 THEN
				INSERT into tipo_producto (tipo) VALUES (nombre);
				SELECT 1;
			ELSE
				SELECT 2;
		end if;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
