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

 Date: 17/06/2023 20:08:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for aggcarrito
-- ----------------------------
DROP TABLE IF EXISTS `aggcarrito`;
CREATE TABLE `aggcarrito`  (
  `cliente_id` int NULL DEFAULT NULL,
  `producto_id` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `promocion` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `tipo_promo` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `porcentaje` int NULL DEFAULT NULL,
  `descuento_promo` decimal(10, 2) NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `sale` int NULL DEFAULT NULL,
  INDEX `producto_id`(`producto_id` ASC) USING BTREE,
  CONSTRAINT `aggcarrito_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of aggcarrito
-- ----------------------------

-- ----------------------------
-- Table structure for calificarestado
-- ----------------------------
DROP TABLE IF EXISTS `calificarestado`;
CREATE TABLE `calificarestado`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `clienteid` int NULL DEFAULT NULL,
  `productoid` int NULL DEFAULT NULL,
  `estado` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `clienteid`(`clienteid` ASC) USING BTREE,
  INDEX `productoid`(`productoid` ASC) USING BTREE,
  CONSTRAINT `calificarestado_ibfk_1` FOREIGN KEY (`clienteid`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `calificarestado_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of calificarestado
-- ----------------------------
INSERT INTO `calificarestado` VALUES (6, 9, 2, 'Nomegusta', '2023-06-09 23:30:19');
INSERT INTO `calificarestado` VALUES (7, 9, 1, 'Megusta', '2023-06-09 23:39:32');

-- ----------------------------
-- Table structure for calificarestadooferta
-- ----------------------------
DROP TABLE IF EXISTS `calificarestadooferta`;
CREATE TABLE `calificarestadooferta`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `clienteid` int NULL DEFAULT NULL,
  `productoid` int NULL DEFAULT NULL,
  `estado` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `clienteid`(`clienteid` ASC) USING BTREE,
  INDEX `productoid`(`productoid` ASC) USING BTREE,
  CONSTRAINT `calificarestadooferta_ibfk_1` FOREIGN KEY (`clienteid`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `calificarestadooferta_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of calificarestadooferta
-- ----------------------------
INSERT INTO `calificarestadooferta` VALUES (3, 9, 2, 'Nomegusta', '2023-06-09 23:41:09');
INSERT INTO `calificarestadooferta` VALUES (4, 9, 1, 'Megusta', '2023-06-09 23:41:16');

-- ----------------------------
-- Table structure for calificarproducto
-- ----------------------------
DROP TABLE IF EXISTS `calificarproducto`;
CREATE TABLE `calificarproducto`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `idcliente` int NULL DEFAULT NULL,
  `calificacion` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT 'ok',
  `detalle` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idproducto` int NULL DEFAULT NULL,
  `oferta` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idcliente`(`idcliente` ASC) USING BTREE,
  INDEX `idproducto`(`idproducto` ASC) USING BTREE,
  CONSTRAINT `calificarproducto_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `calificarproducto_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of calificarproducto
-- ----------------------------
INSERT INTO `calificarproducto` VALUES (1, 9, 'ok', 'Buen producto justo lo que estoy buscando', '2023-05-21 20:18:14', 1, 'oferta');
INSERT INTO `calificarproducto` VALUES (2, 9, 'ok', 'Buen producto justo lo que estoy buscando', '2023-05-21 20:19:27', 1, 'oferta');
INSERT INTO `calificarproducto` VALUES (3, 9, 'ok', 'producto destacado', '2023-05-21 20:23:01', 1, 'oferta');
INSERT INTO `calificarproducto` VALUES (4, 9, 'ok', 'sdsd', '2023-05-21 20:23:03', 1, 'oferta');
INSERT INTO `calificarproducto` VALUES (5, 9, 'ok', 'sdsd', '2023-05-21 20:23:05', 1, 'oferta');
INSERT INTO `calificarproducto` VALUES (6, 9, 'ok', 'buen producto', '2023-05-22 11:11:19', 2, 'Sin oferta');
INSERT INTO `calificarproducto` VALUES (7, 9, 'ok', 'Producto estable y de buen color', '2023-05-22 11:17:03', 2, 'Sin oferta');
INSERT INTO `calificarproducto` VALUES (8, 9, 'ok', 'ME GUSTO EL PRODUCTO', '2023-05-27 21:25:42', 1, 'oferta');
INSERT INTO `calificarproducto` VALUES (9, 9, 'ok', 'AA', '2023-06-09 18:11:18', 2, 'Sin oferta');
INSERT INTO `calificarproducto` VALUES (10, 9, 'ok', 'aa', '2023-06-09 18:13:28', 2, 'Sin oferta');
INSERT INTO `calificarproducto` VALUES (11, 9, 'ok', 'as', '2023-06-09 18:13:59', 2, 'Sin oferta');
INSERT INTO `calificarproducto` VALUES (12, 9, 'ok', 'COMENTARIO DEL PRODUCTO', '2023-06-09 18:14:15', 2, 'Sin oferta');
INSERT INTO `calificarproducto` VALUES (13, 9, 'ok', 'asa', '2023-06-09 21:27:59', 1, 'oferta');

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
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (1, 'JORGE MOISES', 'RAMIREZ ZAVLA', 'elgamereee@hptmail.com', '121212', 'Masculino', 'milafro', '0985906677', 1, '123', 0);
INSERT INTO `cliente` VALUES (2, 'editado empresa', 'bbbbbbbbb', 'elgamerrrr@hotmail.com', '132323', 'Masculino', 'ssssssss', '11111111', 1, '098', 1);
INSERT INTO `cliente` VALUES (3, 'editado tienda', 'fffffff', 'elgamertttt@hotmail.com', '343434', 'Masculino', 'ssssssss', '11111111', 1, '123', 0);
INSERT INTO `cliente` VALUES (9, 'JORGE MOISSES', 'RAMIREZ ZAVALA', 'elgamer-26@hotmail.com', '0940321854', 'Masculino', 'AV. AMAZONAS', '0985906677', 1, '123', 0);
INSERT INTO `cliente` VALUES (10, 'USER NEW', 'NEW USER', 'jorgemoisesramirez201412122@gmail.com', '09403217', 'Masculino', 'MILAGRO', '0980370752', 1, 'ym86sr45q.', 1);
INSERT INTO `cliente` VALUES (11, 'USER NUEVO', 'USER NUEVO', 'jorgemoisesramirez201422@gmail.com', '0940321850', 'Femenino', 'milagro', '0969938481', 1, 'kmrs69bpm.', 1);
INSERT INTO `cliente` VALUES (12, 'NUEVO CLIENTE', 'DE MAS DE UNO', 'elgam123er-26@hotmail.com', '0940321851', 'Masculino', 'Mialgro', '0987654321', 1, 'm3lszh270g', 0);
INSERT INTO `cliente` VALUES (13, 'Paul', 'De la U', 'smartechconsulta@gmail.com', '0940321821', 'Masculino', 'Babahoyo', '1234567890', 1, 'ry7srf7rx6', 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compra
-- ----------------------------
INSERT INTO `compra` VALUES (11, 1, '2023-05-13', '20230513150546', 'Factura', 12.00, 12.00, 1.44, 13.44, 0);
INSERT INTO `compra` VALUES (12, 2, '2023-05-13', '20230513170527', 'Factura', 12.00, 1350.00, 162.00, 1512.00, 0);
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
INSERT INTO `compra` VALUES (26, 2, '2023-05-21', '20230521140515', 'Nota de venta', 0.00, 429.00, 0.00, 429.00, 1);
INSERT INTO `compra` VALUES (27, 1, '2023-05-27', '20230527210507', 'Nota de venta', 0.00, 120.00, 0.00, 120.00, 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compra_material
-- ----------------------------
INSERT INTO `compra_material` VALUES (1, 1, '2023-05-13', '20230513180551', 'Nota de venta', 0.00, 159.00, 0.00, 159.00, 1);
INSERT INTO `compra_material` VALUES (2, 2, '2023-05-13', '20230513180533', 'Nota de venta', 0.00, 1410.00, 0.00, 1410.00, 0);
INSERT INTO `compra_material` VALUES (3, 1, '2023-05-13', '20230513180524', 'Nota de venta', 0.00, 2820.00, 0.00, 2820.00, 1);
INSERT INTO `compra_material` VALUES (4, 2, '2023-05-21', '20230521140500', 'Factura', 12.00, 2661.00, 319.32, 2980.32, 1);
INSERT INTO `compra_material` VALUES (5, 2, '2023-05-27', '20230527210502', 'Factura', 12.00, 282.00, 33.84, 315.84, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `detallecompra` VALUES (21, 26, 4, 12.00, 5, 0.00, 60.00);
INSERT INTO `detallecompra` VALUES (22, 26, 3, 123.00, 3, 0.00, 369.00);
INSERT INTO `detallecompra` VALUES (23, 27, 4, 12.00, 10, 0.00, 120.00);

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
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `compra_id`(`compra_id` ASC) USING BTREE,
  INDEX `material_id`(`material_id` ASC) USING BTREE,
  CONSTRAINT `detallecompramaterial_ibfk_1` FOREIGN KEY (`compra_id`) REFERENCES `compra_material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detallecompramaterial_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detallecompramaterial
-- ----------------------------
INSERT INTO `detallecompramaterial` VALUES (1, 1, 2, 159.00, 1.00, 0.00, 159.00);
INSERT INTO `detallecompramaterial` VALUES (2, 2, 2, 159.00, 5.00, 0.00, 795.00);
INSERT INTO `detallecompramaterial` VALUES (3, 2, 1, 123.00, 5.00, 0.00, 615.00);
INSERT INTO `detallecompramaterial` VALUES (4, 3, 2, 159.00, 10.00, 0.00, 1590.00);
INSERT INTO `detallecompramaterial` VALUES (5, 3, 1, 123.00, 10.00, 0.00, 1230.00);
INSERT INTO `detallecompramaterial` VALUES (6, 4, 2, 159.00, 9.00, 0.00, 1431.00);
INSERT INTO `detallecompramaterial` VALUES (7, 4, 1, 123.00, 10.00, 0.00, 1230.00);
INSERT INTO `detallecompramaterial` VALUES (8, 5, 1, 123.00, 1.00, 0.00, 123.00);
INSERT INTO `detallecompramaterial` VALUES (9, 5, 2, 159.00, 1.00, 0.00, 159.00);

-- ----------------------------
-- Table structure for detalleproduccioninsumo
-- ----------------------------
DROP TABLE IF EXISTS `detalleproduccioninsumo`;
CREATE TABLE `detalleproduccioninsumo`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `produccion_id` int NULL DEFAULT NULL,
  `insumo_id` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produccion_id`(`produccion_id` ASC) USING BTREE,
  INDEX `insumo_id`(`insumo_id` ASC) USING BTREE,
  CONSTRAINT `detalleproduccioninsumo_ibfk_1` FOREIGN KEY (`produccion_id`) REFERENCES `produccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleproduccioninsumo_ibfk_2` FOREIGN KEY (`insumo_id`) REFERENCES `insumo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalleproduccioninsumo
-- ----------------------------
INSERT INTO `detalleproduccioninsumo` VALUES (1, 6, 4, 5);
INSERT INTO `detalleproduccioninsumo` VALUES (2, 6, 3, 10);
INSERT INTO `detalleproduccioninsumo` VALUES (3, 7, 4, 5);
INSERT INTO `detalleproduccioninsumo` VALUES (4, 7, 3, 10);
INSERT INTO `detalleproduccioninsumo` VALUES (5, 8, 4, 12);
INSERT INTO `detalleproduccioninsumo` VALUES (6, 8, 3, 34);
INSERT INTO `detalleproduccioninsumo` VALUES (7, 9, 4, 2);
INSERT INTO `detalleproduccioninsumo` VALUES (8, 9, 3, 5);
INSERT INTO `detalleproduccioninsumo` VALUES (9, 10, 4, 3);
INSERT INTO `detalleproduccioninsumo` VALUES (10, 10, 3, 4);
INSERT INTO `detalleproduccioninsumo` VALUES (11, 11, 4, 5);
INSERT INTO `detalleproduccioninsumo` VALUES (12, 11, 3, 5);

-- ----------------------------
-- Table structure for detalleproduccionmaterial
-- ----------------------------
DROP TABLE IF EXISTS `detalleproduccionmaterial`;
CREATE TABLE `detalleproduccionmaterial`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `produccion_id` int NULL DEFAULT NULL,
  `material_id` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produccion_id`(`produccion_id` ASC) USING BTREE,
  INDEX `material_id`(`material_id` ASC) USING BTREE,
  CONSTRAINT `detalleproduccionmaterial_ibfk_1` FOREIGN KEY (`produccion_id`) REFERENCES `produccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleproduccionmaterial_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalleproduccionmaterial
-- ----------------------------
INSERT INTO `detalleproduccionmaterial` VALUES (1, 7, 2, 100);
INSERT INTO `detalleproduccionmaterial` VALUES (2, 7, 1, 100);
INSERT INTO `detalleproduccionmaterial` VALUES (3, 8, 2, 2);
INSERT INTO `detalleproduccionmaterial` VALUES (4, 8, 1, 2);
INSERT INTO `detalleproduccionmaterial` VALUES (5, 9, 2, 1);
INSERT INTO `detalleproduccionmaterial` VALUES (6, 9, 1, 2);
INSERT INTO `detalleproduccionmaterial` VALUES (7, 10, 2, 1);
INSERT INTO `detalleproduccionmaterial` VALUES (8, 10, 1, 1);
INSERT INTO `detalleproduccionmaterial` VALUES (9, 11, 2, 1);
INSERT INTO `detalleproduccionmaterial` VALUES (10, 11, 1, 2);

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
  `codigowhatsapp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of empresa
-- ----------------------------
INSERT INTO `empresa` VALUES (1, 'nombre editado', 'direccion editado', 'correo@hotmail.com', '1245', '09876', 'actividad esto es editado por el usuario wey', 'IMG215202319810.png', 'GA230617114907');

-- ----------------------------
-- Table structure for fase
-- ----------------------------
DROP TABLE IF EXISTS `fase`;
CREATE TABLE `fase`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `fase` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fase
-- ----------------------------
INSERT INTO `fase` VALUES (1, 'Germinación', 1);
INSERT INTO `fase` VALUES (2, 'Desarrollo de las hojas', 1);
INSERT INTO `fase` VALUES (3, 'Formación de brotes laterales / macollamiento', 1);
INSERT INTO `fase` VALUES (4, 'Crecimiento longitudinal del tallo o crecimiento en roseta, desarrollo de brotes', 1);
INSERT INTO `fase` VALUES (5, 'Desarrollo de las partes vegetativas cosechables de la planta', 1);
INSERT INTO `fase` VALUES (6, 'Emergencia de la inflorescencia (tallo principal) / espigamiento', 1);
INSERT INTO `fase` VALUES (7, 'Floración', 1);
INSERT INTO `fase` VALUES (8, 'Desarrollo del fruto', 1);
INSERT INTO `fase` VALUES (9, 'Maduración o madurez de frutos y semillas', 1);
INSERT INTO `fase` VALUES (10, 'Senescencia, comienzo de la dormancia', 1);

-- ----------------------------
-- Table structure for faseproduccion
-- ----------------------------
DROP TABLE IF EXISTS `faseproduccion`;
CREATE TABLE `faseproduccion`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `produccion_id` int NULL DEFAULT NULL,
  `fase_id` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `detalle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produccion_id`(`produccion_id` ASC) USING BTREE,
  INDEX `fase_id`(`fase_id` ASC) USING BTREE,
  CONSTRAINT `faseproduccion_ibfk_1` FOREIGN KEY (`produccion_id`) REFERENCES `produccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `faseproduccion_ibfk_2` FOREIGN KEY (`fase_id`) REFERENCES `fase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 73 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of faseproduccion
-- ----------------------------
INSERT INTO `faseproduccion` VALUES (1, 7, 1, '2023-05-19', 'AA');
INSERT INTO `faseproduccion` VALUES (2, 7, 2, '2023-05-26', 'bbbbbbb');
INSERT INTO `faseproduccion` VALUES (3, 7, 3, '2023-05-19', 'detalle de fase');
INSERT INTO `faseproduccion` VALUES (4, 7, 4, '2023-05-19', 'aaaaa');
INSERT INTO `faseproduccion` VALUES (5, 7, 5, '2023-05-19', 'aaaaa');
INSERT INTO `faseproduccion` VALUES (6, 7, 6, '2023-05-19', 'aaaaa');
INSERT INTO `faseproduccion` VALUES (7, 7, 7, '2023-05-19', 'aaaaaa');
INSERT INTO `faseproduccion` VALUES (8, 7, 8, '2023-05-19', 'aaaaaa');
INSERT INTO `faseproduccion` VALUES (9, 7, 9, '2023-05-19', 'aaaa');
INSERT INTO `faseproduccion` VALUES (10, 7, 10, '2023-05-19', 'aaaa');
INSERT INTO `faseproduccion` VALUES (11, 6, 1, '2023-05-19', 'aaa');
INSERT INTO `faseproduccion` VALUES (12, 6, 2, '2023-05-19', 'qwe');
INSERT INTO `faseproduccion` VALUES (13, 6, 3, '2023-05-19', 'es una porueba');
INSERT INTO `faseproduccion` VALUES (14, 6, 4, '2023-05-19', 'aaaa');
INSERT INTO `faseproduccion` VALUES (15, 6, 5, '2023-05-19', 'aaaaaaa');
INSERT INTO `faseproduccion` VALUES (16, 6, 6, '2023-05-19', 'gg');
INSERT INTO `faseproduccion` VALUES (17, 6, 7, '2023-05-19', 'edddedf');
INSERT INTO `faseproduccion` VALUES (18, 6, 8, '2023-05-19', 'FLORES');
INSERT INTO `faseproduccion` VALUES (19, 6, 9, '2023-05-19', 'aaaaaaa');
INSERT INTO `faseproduccion` VALUES (20, 6, 10, '2023-05-19', 'asasasssss');
INSERT INTO `faseproduccion` VALUES (21, 5, 1, '2023-05-19', 'sds');
INSERT INTO `faseproduccion` VALUES (22, 5, 2, '2023-05-19', 'd');
INSERT INTO `faseproduccion` VALUES (23, 5, 3, '2023-05-19', 'sdsd');
INSERT INTO `faseproduccion` VALUES (24, 5, 4, '2023-05-19', 'sdsd');
INSERT INTO `faseproduccion` VALUES (25, 5, 5, '2023-05-19', 'sdsd');
INSERT INTO `faseproduccion` VALUES (26, 5, 6, '2023-05-19', 'sdsds');
INSERT INTO `faseproduccion` VALUES (27, 5, 7, '2023-05-19', 'sdsd');
INSERT INTO `faseproduccion` VALUES (28, 5, 8, '2023-05-19', 'sdsd');
INSERT INTO `faseproduccion` VALUES (29, 5, 9, '2023-05-19', 'sdsds');
INSERT INTO `faseproduccion` VALUES (30, 5, 10, '2023-05-19', 'sdsd');
INSERT INTO `faseproduccion` VALUES (31, 4, 1, '2023-05-19', 'aaaaaaa');
INSERT INTO `faseproduccion` VALUES (36, 8, 1, '2023-05-19', 'aaaa');
INSERT INTO `faseproduccion` VALUES (37, 8, 2, '2023-05-19', 'bbbbb');
INSERT INTO `faseproduccion` VALUES (38, 8, 3, '2023-05-19', 'cccc');
INSERT INTO `faseproduccion` VALUES (39, 8, 4, '2023-05-19', 'ddddd');
INSERT INTO `faseproduccion` VALUES (40, 8, 5, '2023-05-19', 'eeee');
INSERT INTO `faseproduccion` VALUES (41, 8, 6, '2023-05-19', 'fffff');
INSERT INTO `faseproduccion` VALUES (42, 8, 7, '2023-05-19', 'hhhhhh');
INSERT INTO `faseproduccion` VALUES (43, 8, 8, '2023-05-19', 'iiiii');
INSERT INTO `faseproduccion` VALUES (44, 8, 9, '2023-05-19', 'jjjjjj');
INSERT INTO `faseproduccion` VALUES (45, 8, 10, '2023-05-19', 'kkkkkkk');
INSERT INTO `faseproduccion` VALUES (46, 4, 2, '2023-05-20', 'asasa');
INSERT INTO `faseproduccion` VALUES (47, 4, 3, '2023-05-20', 'aaaaaaa');
INSERT INTO `faseproduccion` VALUES (48, 4, 4, '2023-05-20', 'asssssssss');
INSERT INTO `faseproduccion` VALUES (49, 4, 5, '2023-05-20', 'dddddddd');
INSERT INTO `faseproduccion` VALUES (50, 4, 6, '2023-05-20', '2w2w2w');
INSERT INTO `faseproduccion` VALUES (51, 4, 7, '2023-05-20', '2w2w2');
INSERT INTO `faseproduccion` VALUES (52, 4, 8, '2023-05-20', 'sss');
INSERT INTO `faseproduccion` VALUES (53, 4, 9, '2023-05-20', 'sdsdsd');
INSERT INTO `faseproduccion` VALUES (54, 4, 10, '2023-05-20', 'sdsdsd');
INSERT INTO `faseproduccion` VALUES (55, 2, 1, '2023-05-20', 'asasa');
INSERT INTO `faseproduccion` VALUES (56, 2, 2, '2023-05-20', 'asaasa');
INSERT INTO `faseproduccion` VALUES (57, 2, 3, '2023-05-20', 'asasa');
INSERT INTO `faseproduccion` VALUES (58, 2, 4, '2023-05-20', 'asasasas');
INSERT INTO `faseproduccion` VALUES (59, 2, 5, '2023-05-20', 'sasasas');
INSERT INTO `faseproduccion` VALUES (60, 2, 6, '2023-05-20', 'asasasa');
INSERT INTO `faseproduccion` VALUES (61, 2, 7, '2023-05-20', 'asasasasas');
INSERT INTO `faseproduccion` VALUES (62, 2, 8, '2023-05-20', 'asasas');
INSERT INTO `faseproduccion` VALUES (63, 2, 9, '2023-05-20', 'asasasas');
INSERT INTO `faseproduccion` VALUES (64, 2, 10, '2023-05-20', '1212121');
INSERT INTO `faseproduccion` VALUES (65, 9, 1, '2023-05-21', 'FASE ONE');
INSERT INTO `faseproduccion` VALUES (66, 9, 2, '2023-05-21', 'FASE TWO');
INSERT INTO `faseproduccion` VALUES (67, 9, 3, '2023-05-21', 'FASE TREE');
INSERT INTO `faseproduccion` VALUES (68, 9, 4, '2023-05-21', 'FASE FOUR');
INSERT INTO `faseproduccion` VALUES (69, 9, 5, '2023-05-21', 'FIVE');
INSERT INTO `faseproduccion` VALUES (70, 11, 1, '2023-05-27', 'AAAAA');
INSERT INTO `faseproduccion` VALUES (71, 11, 2, '2023-05-27', 'BBBB');
INSERT INTO `faseproduccion` VALUES (72, 11, 3, '2023-05-27', 'BBBBB');

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
INSERT INTO `insumo` VALUES (3, '18191053', 'Insumo de tierra', 2, 123.00, 'Descripción del insumo', 'insumo.jpg', 1, 55);
INSERT INTO `insumo` VALUES (4, '535545165', 'INSUMO DE PLANTA', 1, 12.00, 'Descripción del insumo DETALLE', 'IMG1352023144657.jpg', 1, 93);

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
INSERT INTO `material` VALUES (1, '388536903', 'NUEVO MATERILA PALA', 1, 123.00, 'Descripción del material - Ingrese la descripcion del material', 'IMG125202322324.jpg', 1, 14);
INSERT INTO `material` VALUES (2, '890255674', 'NOMBRE EDITADO', 1, 159.00, 'Descripción del material EDITADO', 'IMG125202322316.jpg', 1, 15);

-- ----------------------------
-- Table structure for oferta
-- ----------------------------
DROP TABLE IF EXISTS `oferta`;
CREATE TABLE `oferta`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `producto_id` int NULL DEFAULT NULL,
  `fecha_inicio` date NULL DEFAULT NULL,
  `fecha_fin` date NULL DEFAULT NULL,
  `tipo_oferta` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `valor_descuento` int NULL DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `producto_id`(`producto_id` ASC) USING BTREE,
  CONSTRAINT `oferta_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oferta
-- ----------------------------
INSERT INTO `oferta` VALUES (2, 1, '2023-05-20', '2023-07-09', 'Descuento %', 80, '2023-05-20 16:05:00');
INSERT INTO `oferta` VALUES (4, 2, '2023-06-17', '2023-07-01', '2x1', 0, '2023-06-17 10:43:02');

-- ----------------------------
-- Table structure for perdida_produccion
-- ----------------------------
DROP TABLE IF EXISTS `perdida_produccion`;
CREATE TABLE `perdida_produccion`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `produccion_id` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `detalle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  `fecha` date NULL DEFAULT NULL,
  `usuario_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `produccion_id`(`produccion_id` ASC) USING BTREE,
  INDEX `usuario_id`(`usuario_id` ASC) USING BTREE,
  CONSTRAINT `perdida_produccion_ibfk_1` FOREIGN KEY (`produccion_id`) REFERENCES `produccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `perdida_produccion_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of perdida_produccion
-- ----------------------------
INSERT INTO `perdida_produccion` VALUES (2, 7, 10, 'PERDIDA POR MALA PLANTA', '2023-05-19', 4);
INSERT INTO `perdida_produccion` VALUES (4, 4, 4, 'aaaaaaa', '2023-05-20', 4);
INSERT INTO `perdida_produccion` VALUES (5, 3, 2, 'Descripción de la perdida', '2023-05-20', 4);
INSERT INTO `perdida_produccion` VALUES (6, 3, 1, 'wewewe', '2023-05-20', 4);
INSERT INTO `perdida_produccion` VALUES (7, 9, 5, 'PERDIDA NUEVA', '2023-05-20', 4);
INSERT INTO `perdida_produccion` VALUES (8, 9, 5, 'DETALE DE PERDIDA', '2023-05-21', 4);

-- ----------------------------
-- Table structure for produccion
-- ----------------------------
DROP TABLE IF EXISTS `produccion`;
CREATE TABLE `produccion`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `fecharegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaini` date NULL DEFAULT NULL,
  `fechafin` date NULL DEFAULT NULL,
  `dias` int NULL DEFAULT NULL,
  `productoid` int NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `usuarioid` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `productoid`(`productoid` ASC) USING BTREE,
  INDEX `usuarioid`(`usuarioid` ASC) USING BTREE,
  CONSTRAINT `produccion_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `produccion_ibfk_2` FOREIGN KEY (`usuarioid`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produccion
-- ----------------------------
INSERT INTO `produccion` VALUES (2, 'aaaaaaaaa', '2023-05-16 20:45:59', '2023-05-16', '2023-05-18', 2, 2, 2, 4, 100);
INSERT INTO `produccion` VALUES (3, 'aaaaaaaaa', '2023-05-16 20:46:15', '2023-05-16', '2023-05-18', 2, 2, 1, 4, 100);
INSERT INTO `produccion` VALUES (4, 'ss', '2023-05-16 20:48:48', '2023-05-16', '2023-05-31', 15, 2, 2, 4, 100);
INSERT INTO `produccion` VALUES (5, 'NUEVA PRODUCCION DE PLANTAS', '2023-05-16 21:35:11', '2023-05-16', '2023-06-01', 16, 1, 2, 4, 100);
INSERT INTO `produccion` VALUES (6, 'PRODUCCION DE CACAO', '2023-05-19 09:36:19', '2023-05-19', '2023-05-22', 3, 1, 2, 4, 100);
INSERT INTO `produccion` VALUES (7, 'PRODUCCION DE CACAO', '2023-05-19 09:37:27', '2023-05-19', '2023-05-22', 3, 1, 2, 4, 100);
INSERT INTO `produccion` VALUES (8, 'PRODUCCION DE ARROZ', '2023-05-19 19:14:19', '2023-05-19', '2023-07-01', 43, 2, 2, 4, 100);
INSERT INTO `produccion` VALUES (9, 'PRODUCCION DE CAPTUS', '2023-05-20 10:32:39', '2023-05-20', '2023-06-11', 22, 1, 1, 4, 100);
INSERT INTO `produccion` VALUES (10, 'PRODUCCION DE PRUEBA', '2023-05-21 14:47:47', '2023-05-21', '2023-06-10', 20, 2, 1, 4, 100);
INSERT INTO `produccion` VALUES (11, 'PLANTAS', '2023-05-27 21:43:29', '2023-05-27', '2023-07-01', 35, 2, 1, 4, 100);

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
  `cantidad` int NULL DEFAULT 0,
  `oferta` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tipo_id`(`tipo_id` ASC) USING BTREE,
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES (1, '77959826', 'PLANTA EDITADA', 1, 159.00, 'Descripción del producto', 'IMG85202321507.jpg', 1, 89, 1);
INSERT INTO `producto` VALUES (2, '874084907', 'Nombre', 3, 7453.00, 'ES UNA DESCRIPCION', 'IMG852023214933.jpg', 1, 65, 1);

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
INSERT INTO `rol` VALUES (4, 'NUEVO TIPO', '2023-05-07 20:21:37', 1);

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
-- Table structure for ventaweb
-- ----------------------------
DROP TABLE IF EXISTS `ventaweb`;
CREATE TABLE `ventaweb`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NULL DEFAULT NULL,
  `direccion` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  `impuesto` decimal(10, 2) NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `n_venta` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `comprobante` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `iva` int NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `fecharegistro` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ciudad` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `referencia` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cliente_id`(`cliente_id` ASC) USING BTREE,
  CONSTRAINT `ventaweb_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ventaweb
-- ----------------------------
INSERT INTO `ventaweb` VALUES (20, 9, 'SD', 14906.00, 1788.72, 16694.72, '2023-06-03', '20230603190642', 'PayPal', 12, 0, '2023-06-03 20:59:37', 'DSSD', 'SD');
INSERT INTO `ventaweb` VALUES (21, 9, 'SD', 14906.00, 1788.72, 16694.72, '2023-06-03', '20230603190656', 'PayPal', 12, 0, '2023-06-03 20:59:34', 'DSSD', 'SD');
INSERT INTO `ventaweb` VALUES (22, 9, 'bbbbb', 14906.00, 1788.72, 16694.72, '2023-06-03', '20230603190630', 'PayPal', 12, 0, '2023-06-03 20:59:28', 'aaaaa', 'ccccc');
INSERT INTO `ventaweb` VALUES (23, 9, 'Av. amazonas y eloy alfaro', 7612.00, 913.44, 8525.44, '2023-06-04', '20230604180601', 'PayPal', 12, 1, '2023-06-04 18:28:01', 'Milagro', 'En mi casa');
INSERT INTO `ventaweb` VALUES (24, 12, NULL, 7484.80, 0.00, 7484.80, '2023-06-09', '20230609120645', 'Nota de venta', 0, 1, '2023-06-09 12:53:21', NULL, NULL);
INSERT INTO `ventaweb` VALUES (25, 12, NULL, 7612.00, 0.00, 7612.00, '2023-06-09', '20230609120640', 'Nota de venta', 0, 1, '2023-06-09 12:54:52', NULL, NULL);
INSERT INTO `ventaweb` VALUES (26, 12, NULL, 7612.00, 0.00, 7612.00, '2023-06-09', '20230609120640', 'Nota de venta', 0, 1, '2023-06-09 12:55:37', NULL, NULL);
INSERT INTO `ventaweb` VALUES (27, 13, NULL, 7453.00, 0.00, 7453.00, '2023-06-09', '20230609120651', 'Nota de venta', 0, 0, '2023-06-09 14:22:27', NULL, NULL);
INSERT INTO `ventaweb` VALUES (28, 2, NULL, 7612.00, 0.00, 7612.00, '2023-06-09', '20230609140611', 'Nota de venta', 0, 1, '2023-06-09 14:24:25', NULL, NULL);
INSERT INTO `ventaweb` VALUES (29, 10, NULL, 22836.00, 0.00, 22836.00, '2023-06-09', '20230609140640', 'Nota de venta', 0, 1, '2023-06-09 14:24:56', NULL, NULL);
INSERT INTO `ventaweb` VALUES (30, 9, NULL, 7612.00, 0.00, 7612.00, '2023-06-10', '20230610090633', 'Nota de venta', 0, 1, '2023-06-10 09:35:42', NULL, NULL);
INSERT INTO `ventaweb` VALUES (31, 9, 'Exuado', 7453.00, 894.36, 8347.36, '2023-06-10', '20230610130636', 'PayPal', 12, 1, '2023-06-10 13:01:36', 'Milagro', 'Mi casa');
INSERT INTO `ventaweb` VALUES (32, 9, 'a', 7453.00, 894.36, 8347.36, '2023-06-10', '20230610130658', 'PayPal', 12, 1, '2023-06-10 13:03:58', 'qa', 'aaa');
INSERT INTO `ventaweb` VALUES (33, 9, 'asa', 7453.00, 894.36, 8347.36, '2023-06-10', '20230610130610', 'PayPal', 12, 1, '2023-06-10 13:08:10', 'as', 'asa');
INSERT INTO `ventaweb` VALUES (34, 9, 'ddd', 7453.00, 894.36, 8347.36, '2023-06-10', '20230610130634', 'PayPal', 12, 1, '2023-06-10 13:09:34', 'dd', 'dd');
INSERT INTO `ventaweb` VALUES (35, 9, 'aa', 7453.00, 894.36, 8347.36, '2023-06-10', '20230610130631', 'PayPal', 12, 1, '2023-06-10 13:11:31', 'aaa', 'aaa');
INSERT INTO `ventaweb` VALUES (36, 9, 'BBBBBBBB', 159.00, 19.08, 178.08, '2023-06-10', '20230610130634', 'PayPal', 12, 1, '2023-06-10 13:17:34', 'AAAAAAA', 'CCCCCCC');
INSERT INTO `ventaweb` VALUES (37, 9, 's', 7453.00, 894.36, 8347.36, '2023-06-10', '20230610130612', 'PayPal', 12, 1, '2023-06-10 13:20:12', 'a', 'd');
INSERT INTO `ventaweb` VALUES (38, 9, 'sssss', 7453.00, 894.36, 8347.36, '2023-06-10', '20230610130615', 'PayPal', 12, 1, '2023-06-10 13:23:15', 'sss', 'sss');
INSERT INTO `ventaweb` VALUES (39, 9, 'asas', 159.00, 19.08, 178.08, '2023-06-10', '20230610130636', 'PayPal', 12, 1, '2023-06-10 13:25:36', 'asa', 'asa');
INSERT INTO `ventaweb` VALUES (40, 9, 'Dirección', 7771.00, 932.52, 8703.52, '2023-06-10', '20230610130630', 'PayPal', 12, 1, '2023-06-10 13:29:30', 'Ciudad', 'Referencia');

-- ----------------------------
-- Table structure for ventawebdetalle
-- ----------------------------
DROP TABLE IF EXISTS `ventawebdetalle`;
CREATE TABLE `ventawebdetalle`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `ventaid` int NULL DEFAULT NULL,
  `productoid` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `sale` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `oferta` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL,
  `descuento` decimal(10, 2) NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  `descuento_moneda` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ventaid`(`ventaid` ASC) USING BTREE,
  INDEX `productoid`(`productoid` ASC) USING BTREE,
  CONSTRAINT `ventawebdetalle_ibfk_1` FOREIGN KEY (`ventaid`) REFERENCES `ventaweb` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ventawebdetalle_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ventawebdetalle
-- ----------------------------
INSERT INTO `ventawebdetalle` VALUES (7, 20, 2, 2, 6, 7453.00, '3x1', 0.00, 14906.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (8, 21, 2, 2, 6, 7453.00, '3x1', 0.00, 14906.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (9, 22, 2, 2, 6, 7453.00, '3x1', 0.00, 14906.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (10, 23, 2, 1, 1, 7453.00, 'No oferta', 0.00, 7453.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (11, 23, 1, 1, 1, 159.00, 'No oferta', 0.00, 159.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (12, 25, 2, 1, 3, 7453.00, '3x1', 0.00, 7453.00, 0.00);
INSERT INTO `ventawebdetalle` VALUES (13, 25, 1, 1, 1, 159.00, 'No oferta', 0.00, 159.00, 0.00);
INSERT INTO `ventawebdetalle` VALUES (14, 26, 2, 1, 3, 7453.00, '3x1', 0.00, 7453.00, 0.00);
INSERT INTO `ventawebdetalle` VALUES (15, 26, 1, 1, 1, 159.00, 'No oferta', 0.00, 159.00, 0.00);
INSERT INTO `ventawebdetalle` VALUES (16, 27, 2, 1, 1, 7453.00, 'No oferta', 0.00, 7453.00, 0.00);
INSERT INTO `ventawebdetalle` VALUES (17, 28, 2, 1, 1, 7453.00, 'No oferta', 0.00, 7453.00, 0.00);
INSERT INTO `ventawebdetalle` VALUES (18, 28, 1, 1, 1, 159.00, 'No oferta', 0.00, 159.00, 0.00);
INSERT INTO `ventawebdetalle` VALUES (19, 29, 2, 3, 3, 7453.00, 'No oferta', 0.00, 22359.00, 0.00);
INSERT INTO `ventawebdetalle` VALUES (20, 29, 1, 3, 3, 159.00, 'No oferta', 0.00, 477.00, 0.00);
INSERT INTO `ventawebdetalle` VALUES (21, 30, 2, 1, 3, 7453.00, '3x1', 0.00, 7453.00, 0.00);
INSERT INTO `ventawebdetalle` VALUES (22, 30, 1, 1, 1, 159.00, 'No oferta', 0.00, 159.00, 0.00);
INSERT INTO `ventawebdetalle` VALUES (23, 31, 2, 1, 1, 7453.00, 'No oferta', 0.00, 7453.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (24, 32, 2, 1, 1, 7453.00, 'No oferta', 0.00, 7453.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (25, 33, 2, 1, 1, 7453.00, 'No oferta', 0.00, 7453.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (26, 34, 2, 1, 1, 7453.00, 'No oferta', 0.00, 7453.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (27, 35, 2, 1, 1, 7453.00, 'No oferta', 0.00, 7453.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (28, 36, 1, 1, 1, 159.00, 'No oferta', 0.00, 159.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (29, 37, 2, 1, 1, 7453.00, 'No oferta', 0.00, 7453.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (30, 38, 2, 1, 1, 7453.00, 'No oferta', 0.00, 7453.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (31, 39, 1, 1, 1, 159.00, 'No oferta', 0.00, 159.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (32, 40, 1, 2, 1, 159.00, 'No oferta', 0.00, 318.00, NULL);
INSERT INTO `ventawebdetalle` VALUES (33, 40, 2, 1, 1, 7453.00, 'No oferta', 0.00, 7453.00, NULL);

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
-- Procedure structure for EventoEstado
-- ----------------------------
DROP PROCEDURE IF EXISTS `EventoEstado`;
delimiter ;;
CREATE PROCEDURE `EventoEstado`(in idcliente int, in idproducto int, in estados char(20))
BEGIN
declare statuss int;

	SET @statuss = (select COUNT(*) from calificarestado where clienteid = idcliente and productoid = idproducto);

	IF @statuss > 0 THEN
	 
			UPDATE calificarestado SET estado = estados where clienteid = idcliente and productoid = idproducto;
			SELECT 1;
			
	ELSE

			INSERT INTO calificarestado (clienteid, productoid, estado) value (idcliente, idproducto, estados);
			SELECT 1;

	end if;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for EventoEstadoOferta
-- ----------------------------
DROP PROCEDURE IF EXISTS `EventoEstadoOferta`;
delimiter ;;
CREATE PROCEDURE `EventoEstadoOferta`(in idcliente int, in idproducto int, in estados char(20))
BEGIN
declare statuss int;

	SET @statuss = (select COUNT(*) from calificarestadooferta where clienteid = idcliente and productoid = idproducto);

	IF @statuss > 0 THEN
	 
			UPDATE calificarestadooferta SET estado = estados where clienteid = idcliente and productoid = idproducto;
			SELECT 1;
			
	ELSE

			INSERT INTO calificarestadooferta (clienteid, productoid, estado) value (idcliente, idproducto, estados);
			SELECT 1;

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
-- Procedure structure for llamer_etiquetas
-- ----------------------------
DROP PROCEDURE IF EXISTS `llamer_etiquetas`;
delimiter ;;
CREATE PROCEDURE `llamer_etiquetas`()
BEGIN
DECLARE producto1 int;
DECLARE ofertas1 int;
DECLARE clientes1 int;
DECLARE produccion1 int;

SELECT COUNT(*) INTO producto1 from producto WHERE estado = 1;
SELECT COUNT(*) INTO ofertas1 from oferta;
SELECT COUNT(*) INTO clientes1 from cliente WHERE estado = 1;
SELECT COUNT(*) INTO produccion1 from produccion WHERE estado = 1;

SELECT producto1, ofertas1, clientes1, produccion1;

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
