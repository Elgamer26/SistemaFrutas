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

 Date: 14/05/2023 18:19:14
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
-- Table structure for compra
-- ----------------------------
DROP TABLE IF EXISTS `compra`;
CREATE TABLE `compra`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `proveedor_id` int NULL DEFAULT NULL,
  `fechac` date NULL DEFAULT NULL,
  `n_compra` char(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `comprobante` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `iva` decimal(10, 2) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  `impuesto` decimal(10, 2) NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `proveedor_id`(`proveedor_id` ASC) USING BTREE,
  CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compra
-- ----------------------------
INSERT INTO `compra` VALUES (11, 1, '2023-05-13', '20230513150546', 'Factura', 12.00, 12.00, 1.44, 13.44, 0);
INSERT INTO `compra` VALUES (12, 2, '2023-05-13', '20230513170527', 'Factura', 12.00, 1350.00, 162.00, 1512.00, 1);
INSERT INTO `compra` VALUES (13, 1, '2023-05-13', '20230513170512', 'Nota de venta', 0.00, 48.00, 0.00, 48.00, 1);
INSERT INTO `compra` VALUES (14, 1, '2023-05-13', '20230513170523', 'Nota de venta', 0.00, 60.00, 0.00, 60.00, 1);
INSERT INTO `compra` VALUES (15, 1, '2023-05-13', '20230513170523', 'Nota de venta', 0.00, 60.00, 0.00, 60.00, 1);
INSERT INTO `compra` VALUES (16, 1, '2023-05-13', '20230513170523', 'Nota de venta', 0.00, 60.00, 0.00, 60.00, 1);
INSERT INTO `compra` VALUES (17, 1, '2023-05-13', '20230513170523', 'Nota de venta', 0.00, 60.00, 0.00, 60.00, 1);
INSERT INTO `compra` VALUES (18, 1, '2023-05-13', '20230513170523', 'Nota de venta', 0.00, 60.00, 0.00, 60.00, 1);
INSERT INTO `compra` VALUES (19, 1, '2023-05-13', '20230513170523', 'Nota de venta', 0.00, 60.00, 0.00, 60.00, 1);
INSERT INTO `compra` VALUES (20, 1, '2023-05-13', '20230513170523', 'Nota de venta', 0.00, 60.00, 0.00, 60.00, 1);
INSERT INTO `compra` VALUES (21, 2, '2023-05-13', '20230513170500', 'Nota de venta', 0.00, 1353.00, 0.00, 1353.00, 1);
INSERT INTO `compra` VALUES (22, 2, '2023-05-13', '20230513170538', 'Nota de venta', 0.00, 60.00, 0.00, 60.00, 1);
INSERT INTO `compra` VALUES (23, 2, '2023-05-13', '20230513170558', 'Nota de venta', 0.00, 12.00, 0.00, 12.00, 1);
INSERT INTO `compra` VALUES (24, 2, '2023-05-13', '20230513170507', 'Nota de venta', 0.00, 12.00, 0.00, 12.00, 1);
INSERT INTO `compra` VALUES (25, 1, '2023-05-13', '20230513170546', 'Nota de venta', 0.00, 1107.00, 0.00, 1107.00, 1);

-- ----------------------------
-- Table structure for compra_material
-- ----------------------------
DROP TABLE IF EXISTS `compra_material`;
CREATE TABLE `compra_material`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `proveedor_id` int NULL DEFAULT NULL,
  `fechac` date NULL DEFAULT NULL,
  `n_compra` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `comprobante` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `iva` decimal(10, 2) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  `impuesto` decimal(10, 2) NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `proveedor_id`(`proveedor_id` ASC) USING BTREE,
  CONSTRAINT `compra_material_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compra_material
-- ----------------------------
INSERT INTO `compra_material` VALUES (1, 1, '2023-05-13', '20230513180551', 'Nota de venta', 0.00, 159.00, 0.00, 159.00, 1);
INSERT INTO `compra_material` VALUES (2, 2, '2023-05-13', '20230513180533', 'Nota de venta', 0.00, 1410.00, 0.00, 1410.00, 0);
INSERT INTO `compra_material` VALUES (3, 1, '2023-05-13', '20230513180524', 'Nota de venta', 0.00, 2820.00, 0.00, 2820.00, 1);

-- ----------------------------
-- Table structure for detallecompra
-- ----------------------------
DROP TABLE IF EXISTS `detallecompra`;
CREATE TABLE `detallecompra`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `compra_id` int NULL DEFAULT NULL,
  `insumo_id` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `descuento` decimal(10, 2) NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `compra_id`(`compra_id` ASC) USING BTREE,
  INDEX `insumo_id`(`insumo_id` ASC) USING BTREE,
  CONSTRAINT `detallecompra_ibfk_1` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detallecompra_ibfk_2` FOREIGN KEY (`insumo_id`) REFERENCES `insumo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detallecompra
-- ----------------------------
INSERT INTO `detallecompra` VALUES (5, 11, 4, 12.00, 1, 0.00, 12.00);
INSERT INTO `detallecompra` VALUES (6, 12, 4, 12.00, 10, 0.00, 120.00);
INSERT INTO `detallecompra` VALUES (7, 12, 3, 123.00, 10, 0.00, 1230.00);
INSERT INTO `detallecompra` VALUES (8, 13, 4, 12.00, 4, 0.00, 48.00);
INSERT INTO `detallecompra` VALUES (9, 14, 4, 12.00, 5, 0.00, 60.00);
INSERT INTO `detallecompra` VALUES (10, 15, 4, 12.00, 5, 0.00, 60.00);
INSERT INTO `detallecompra` VALUES (11, 16, 4, 12.00, 5, 0.00, 60.00);
INSERT INTO `detallecompra` VALUES (12, 17, 4, 12.00, 5, 0.00, 60.00);
INSERT INTO `detallecompra` VALUES (13, 18, 4, 12.00, 5, 0.00, 60.00);
INSERT INTO `detallecompra` VALUES (14, 19, 4, 12.00, 5, 0.00, 60.00);
INSERT INTO `detallecompra` VALUES (15, 20, 4, 12.00, 5, 0.00, 60.00);
INSERT INTO `detallecompra` VALUES (16, 21, 3, 123.00, 11, 0.00, 1353.00);
INSERT INTO `detallecompra` VALUES (17, 22, 4, 12.00, 5, 0.00, 60.00);
INSERT INTO `detallecompra` VALUES (18, 23, 4, 12.00, 1, 0.00, 12.00);
INSERT INTO `detallecompra` VALUES (19, 24, 4, 12.00, 1, 0.00, 12.00);
INSERT INTO `detallecompra` VALUES (20, 25, 3, 123.00, 9, 0.00, 1107.00);

-- ----------------------------
-- Table structure for detallecompramaterial
-- ----------------------------
DROP TABLE IF EXISTS `detallecompramaterial`;
CREATE TABLE `detallecompramaterial`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `compra_id` int NULL DEFAULT NULL,
  `material_id` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `cantidad` decimal(10, 2) NULL DEFAULT NULL,
  `descuento` decimal(10, 2) NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detallecompramaterial
-- ----------------------------
INSERT INTO `detallecompramaterial` VALUES (1, 1, 2, 159.00, 1.00, 0.00, 159.00);
INSERT INTO `detallecompramaterial` VALUES (2, 2, 2, 159.00, 5.00, 0.00, 795.00);
INSERT INTO `detallecompramaterial` VALUES (3, 2, 1, 123.00, 5.00, 0.00, 615.00);
INSERT INTO `detallecompramaterial` VALUES (4, 3, 2, 159.00, 10.00, 0.00, 1590.00);
INSERT INTO `detallecompramaterial` VALUES (5, 3, 1, 123.00, 10.00, 0.00, 1230.00);

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
INSERT INTO `empresa` VALUES (1, 'nombre editado', 'direccion editado', 'correo@hotmail.com', '1245', '09876', 'actividad esto es editado por el usuario wey', 'IMG1252023223341.jpg');

-- ----------------------------
-- Table structure for insumo
-- ----------------------------
DROP TABLE IF EXISTS `insumo`;
CREATE TABLE `insumo`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `tipo_id` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  `imagen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `cantidad` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tipo_id`(`tipo_id` ASC) USING BTREE,
  CONSTRAINT `insumo_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipoinsumo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of insumo
-- ----------------------------
INSERT INTO `insumo` VALUES (3, '18191053', 'Insumo de tierra', 2, 123.00, 'Descripción del insumo', 'insumo.jpg', 1, 20);
INSERT INTO `insumo` VALUES (4, '535545165', 'INSUMO DE PLANTA', 1, 12.00, 'Descripción del insumo DETALLE', 'IMG1352023144657.jpg', 1, 6);

-- ----------------------------
-- Table structure for material
-- ----------------------------
DROP TABLE IF EXISTS `material`;
CREATE TABLE `material`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `tipo_id` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  `imagen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `cantidad` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tipo_id`(`tipo_id` ASC) USING BTREE,
  CONSTRAINT `material_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of material
-- ----------------------------
INSERT INTO `material` VALUES (1, '388536903', 'NUEVO MATERILA PALA', 1, 123.00, 'Descripción del material - Ingrese la descripcion del material', 'IMG125202322324.jpg', 1, 15);
INSERT INTO `material` VALUES (2, '890255674', 'NOMBRE EDITADO', 1, 159.00, 'Descripción del material EDITADO', 'IMG125202322316.jpg', 1, 16);

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
-- Table structure for proveedor
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `ruc` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `razon_social` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `telefono` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `encargado` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proveedor
-- ----------------------------
INSERT INTO `proveedor` VALUES (1, '0940321850001', 'FARLETZA S.A', 'Farletza@hotmail.com', 'Torres del norte', '0987654321', 'JORGE RAMIREZ', 'Descripción del proveedor', 1);
INSERT INTO `proveedor` VALUES (2, '0940321854001', 'CALRO SA', 'FARLETZ@HOTMAIL.COM', 'MI CASITA', '123456788', 'JORGE RAMIREZ', 'AAAAAAAAAAA', 1);

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
-- Table structure for tipo_material
-- ----------------------------
DROP TABLE IF EXISTS `tipo_material`;
CREATE TABLE `tipo_material`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_material
-- ----------------------------
INSERT INTO `tipo_material` VALUES (1, 'TIPO MATERIAL', 1);
INSERT INTO `tipo_material` VALUES (2, 'TIPO DE MATERIAL editado', 1);

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
-- Table structure for tipoinsumo
-- ----------------------------
DROP TABLE IF EXISTS `tipoinsumo`;
CREATE TABLE `tipoinsumo`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipoinsumo
-- ----------------------------
INSERT INTO `tipoinsumo` VALUES (1, 'TIPO DE INSUMO', 1);
INSERT INTO `tipoinsumo` VALUES (2, 'NUEVO TIPO DE INSUMO', 1);

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
INSERT INTO `usuario` VALUES (4, 'JORGE MOISES', 'RAMIREZ ZAVALA', 'elgamer-26@hotmail.com', '0940321851', 3, 'admin', '123', 'IMG1252023223416.jpg', '2023-04-28 20:40:07', 1);

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
-- Procedure structure for EditarInsumo
-- ----------------------------
DROP PROCEDURE IF EXISTS `EditarInsumo`;
delimiter ;;
CREATE PROCEDURE `EditarInsumo`(in idd int, in codigov VARCHAR(15), in nombrev VARCHAR(100), in tipo_insumov int, in precio_ventav DECIMAL(10,2), in descripcionv TEXT)
BEGIN

	DECLARE coun_codigo INT; 
	
	set @coun_codigo = (select COUNT(*) from insumo WHERE codigo = codigov AND id != idd);
  
	if @coun_codigo = 0 THEN
		UPDATE insumo SET codigo = codigov, nombre = nombrev, tipo_id = tipo_insumov, precio = precio_ventav, descripcion = descripcionv WHERE id = idd;
		SELECT 1;
	ELSE
		SELECT 2;
	end if;
 
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for EditarMaterial
-- ----------------------------
DROP PROCEDURE IF EXISTS `EditarMaterial`;
delimiter ;;
CREATE PROCEDURE `EditarMaterial`(in idd int, in codigov VARCHAR(15), in nombrev VARCHAR(100), in tipo_materialv int, in precio_ventav DECIMAL(10,2), in descripcionv TEXT)
BEGIN
	DECLARE coun_codigo INT; 
	set @coun_codigo = (select COUNT(*) from material WHERE codigo = codigov AND id != idd);
	if @coun_codigo = 0 THEN
		UPDATE material SET codigo=codigov, nombre=nombrev, tipo_id=tipo_materialv, precio=precio_ventav, descripcion=descripcionv WHERE id = idd;
		SELECT 1;
	ELSE
		SELECT 2;
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
-- Procedure structure for EditarProveedor
-- ----------------------------
DROP PROCEDURE IF EXISTS `EditarProveedor`;
delimiter ;;
CREATE PROCEDURE `EditarProveedor`(in rucv VARCHAR(13), in razon_socialv VARCHAR(100), in correov VARCHAR(100), in direccionv VARCHAR(100), in telefonov VARCHAR(11), in encargado VARCHAR(100), in descripcion text, in idd int)
BEGIN
	DECLARE coun_codigo INT; 
	set @coun_codigo = (select COUNT(*) from proveedor WHERE ruc = rucv AND id != idd);
	if @coun_codigo = 0 THEN
		UPDATE proveedor SET ruc=rucv ,razon_social=razon_socialv ,correo=correov ,direccion=direccionv ,telefono=telefonov ,encargado=encargado ,descripcion=descripcion WHERE id=idd;
		SELECT 1;
	ELSE
		SELECT 2;
	end if;
 
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for EditarTipoInsumo
-- ----------------------------
DROP PROCEDURE IF EXISTS `EditarTipoInsumo`;
delimiter ;;
CREATE PROCEDURE `EditarTipoInsumo`(in nombre VARCHAR(50), in idd int)
BEGIN

	DECLARE valor INT;
	
	set @valor = (select COUNT(*) from tipoinsumo WHERE BINARY tipo = nombre AND id != idd);
		if @valor = 0 THEN
				UPDATE tipoinsumo SET tipo = nombre WHERE id = idd;
				SELECT 1;
			ELSE
				SELECT 2;
		end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for EditarTipoMaterial
-- ----------------------------
DROP PROCEDURE IF EXISTS `EditarTipoMaterial`;
delimiter ;;
CREATE PROCEDURE `EditarTipoMaterial`(in idd int, in nombre VARCHAR(50))
BEGIN

	DECLARE valor INT;
	
	set @valor = (select COUNT(*) from tipo_material WHERE BINARY tipo = nombre AND id != idd);
		if @valor = 0 THEN
				UPDATE tipo_material SET tipo = nombre WHERE id = idd;
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
-- Procedure structure for RegistrarInsumo
-- ----------------------------
DROP PROCEDURE IF EXISTS `RegistrarInsumo`;
delimiter ;;
CREATE PROCEDURE `RegistrarInsumo`(in codigov VARCHAR(15), in nombrev VARCHAR(100), in tipo_insumov int, in precio_ventav DECIMAL(10,2), in descripcionv TEXT, in imagenv VARCHAR(100))
BEGIN

	DECLARE coun_codigo INT; 
	
	set @coun_codigo = (select COUNT(*) from insumo WHERE codigo = codigov);
  
	if @coun_codigo = 0 THEN
		INSERT into insumo (codigo,nombre,tipo_id,precio,descripcion,imagen) VALUES (codigov,nombrev,tipo_insumov,precio_ventav,descripcionv,imagenv);
		SELECT 1;
	ELSE
		SELECT 2;
	end if;
 
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for RegistrarMaterial
-- ----------------------------
DROP PROCEDURE IF EXISTS `RegistrarMaterial`;
delimiter ;;
CREATE PROCEDURE `RegistrarMaterial`(in codigov VARCHAR(15), in nombrev VARCHAR(100), in tipo_materialv int, in precio_ventav DECIMAL(10,2), in descripcionv TEXT, in imagenv VARCHAR(100))
BEGIN

	DECLARE coun_codigo INT; 
	
	set @coun_codigo = (select COUNT(*) from material WHERE codigo = codigov);
  
	if @coun_codigo = 0 THEN
		INSERT into material (codigo,nombre,tipo_id,precio,descripcion,imagen) VALUES (codigov,nombrev,tipo_materialv,precio_ventav,descripcionv,imagenv);
		SELECT 1;
	ELSE
		SELECT 2;
	end if;
 
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for RegistrarProveedor
-- ----------------------------
DROP PROCEDURE IF EXISTS `RegistrarProveedor`;
delimiter ;;
CREATE PROCEDURE `RegistrarProveedor`(in rucv VARCHAR(13), in razon_socialv VARCHAR(100), in correov VARCHAR(100), in direccionv VARCHAR(100), in telefonov VARCHAR(11), in encargado VARCHAR(100), in descripcion text)
BEGIN
	DECLARE coun_codigo INT; 
	set @coun_codigo = (select COUNT(*) from proveedor WHERE ruc = rucv);
	if @coun_codigo = 0 THEN
		INSERT into proveedor (ruc,razon_social,correo,direccion,telefono,encargado,descripcion) VALUES (rucv,razon_socialv,correov,direccionv,telefonov,encargado,descripcion);
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
-- Procedure structure for RegistraTipoInsumo
-- ----------------------------
DROP PROCEDURE IF EXISTS `RegistraTipoInsumo`;
delimiter ;;
CREATE PROCEDURE `RegistraTipoInsumo`(in nombre VARCHAR(50))
BEGIN

	DECLARE valor INT;
	
	set @valor = (select COUNT(*) from tipoinsumo WHERE BINARY tipo = nombre);
		if @valor = 0 THEN
				INSERT into tipoinsumo (tipo) VALUES (nombre);
				SELECT 1;
			ELSE
				SELECT 2;
		end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for RegistraTipoMaterial
-- ----------------------------
DROP PROCEDURE IF EXISTS `RegistraTipoMaterial`;
delimiter ;;
CREATE PROCEDURE `RegistraTipoMaterial`(in nombre VARCHAR(50))
BEGIN

	DECLARE valor INT;
	
	set @valor = (select COUNT(*) from tipo_material WHERE BINARY tipo = nombre);
		if @valor = 0 THEN
				INSERT into tipo_material (tipo) VALUES (nombre);
				SELECT 1;
			ELSE
				SELECT 2;
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
