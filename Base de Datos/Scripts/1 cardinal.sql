/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : cardinal

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 18/07/2020 23:59:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for articulos
-- ----------------------------
DROP TABLE IF EXISTS `articulos`;
CREATE TABLE `articulos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `codigo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `imagen` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `nombre_UNIQUE`(`nombre`) USING BTREE,
  INDEX `fk_articulo_categoria_idx`(`id_categoria`) USING BTREE,
  CONSTRAINT `fk_articulos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of articulos
-- ----------------------------
INSERT INTO `articulos` VALUES (1, 1, '123456788', 'Impresora Empson L300', 50, NULL, '1491149398.jpeg', 1);
INSERT INTO `articulos` VALUES (2, 1, '123456789', 'Cable impresora x2mt', 50, NULL, '1485910808.jpg', 1);

-- ----------------------------
-- Table structure for cargos
-- ----------------------------
DROP TABLE IF EXISTS `cargos`;
CREATE TABLE `cargos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cargos
-- ----------------------------
INSERT INTO `cargos` VALUES (1, 'ADMIN', 'ADMIN', 1);
INSERT INTO `cargos` VALUES (2, 'USER', 'USER', 1);
INSERT INTO `cargos` VALUES (3, 'INVITADO', 'INVITADO', 1);

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `nombre_UNIQUE`(`nombre`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES (1, 'Categoría 1', 'descripción 1', 1);
INSERT INTO `categorias` VALUES (2, 'Categoría 2', 'descripción 2', 1);
INSERT INTO `categorias` VALUES (3, 'Categoría 3', 'descripción 3', 1);
INSERT INTO `categorias` VALUES (4, 'Categoría 4', 'descripción 4', 1);
INSERT INTO `categorias` VALUES (5, 'Categoría 5', 'descripción 5', 1);

-- ----------------------------
-- Table structure for compras
-- ----------------------------
DROP TABLE IF EXISTS `compras`;
CREATE TABLE `compras`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo_comprobante` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `serie_comprobante` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `num_comprobante` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha_hora` datetime(0) NOT NULL,
  `impuesto` decimal(4, 2) NOT NULL,
  `total_compra` decimal(11, 2) NOT NULL,
  `estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_ingreso_persona_idx`(`id_proveedor`) USING BTREE,
  INDEX `fk_ingreso_usuario_idx`(`id_usuario`) USING BTREE,
  CONSTRAINT `fk_compras_personas` FOREIGN KEY (`id_proveedor`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_compras_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for detalle_cargos
-- ----------------------------
DROP TABLE IF EXISTS `detalle_cargos`;
CREATE TABLE `detalle_cargos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cargo` int(11) NULL DEFAULT NULL,
  `id_permiso` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 77 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of detalle_cargos
-- ----------------------------
INSERT INTO `detalle_cargos` VALUES (1, 1, 1);
INSERT INTO `detalle_cargos` VALUES (2, 1, 2);
INSERT INTO `detalle_cargos` VALUES (3, 1, 3);
INSERT INTO `detalle_cargos` VALUES (4, 1, 4);
INSERT INTO `detalle_cargos` VALUES (5, 1, 5);
INSERT INTO `detalle_cargos` VALUES (6, 1, 6);
INSERT INTO `detalle_cargos` VALUES (67, 2, 1);
INSERT INTO `detalle_cargos` VALUES (68, 2, 2);
INSERT INTO `detalle_cargos` VALUES (69, 2, 3);
INSERT INTO `detalle_cargos` VALUES (74, 3, 1);
INSERT INTO `detalle_cargos` VALUES (75, 3, 2);
INSERT INTO `detalle_cargos` VALUES (76, 3, 6);

-- ----------------------------
-- Table structure for detalle_compras
-- ----------------------------
DROP TABLE IF EXISTS `detalle_compras`;
CREATE TABLE `detalle_compras`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_compra` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_compra` decimal(11, 2) NOT NULL,
  `precio_venta` decimal(11, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_detalle_ingreso_ingreso_idx`(`id_compra`) USING BTREE,
  INDEX `fk_detalle_ingreso_articulo_idx`(`id_articulo`) USING BTREE,
  CONSTRAINT `fk_detalle_compras_articulos` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_compras_compras` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for detalle_ventas
-- ----------------------------
DROP TABLE IF EXISTS `detalle_ventas`;
CREATE TABLE `detalle_ventas`  (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(11, 2) NOT NULL,
  `descuento` decimal(11, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_detalle_venta_venta_idx`(`id_venta`) USING BTREE,
  INDEX `fk_detalle_venta_articulo_idx`(`id_articulo`) USING BTREE,
  CONSTRAINT `fk_detalle_ventas_articulos` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_ventas_ventas` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for permisos
-- ----------------------------
DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permisos
-- ----------------------------
INSERT INTO `permisos` VALUES (1, 'Escritorio');
INSERT INTO `permisos` VALUES (2, 'Almacén');
INSERT INTO `permisos` VALUES (3, 'Compras');
INSERT INTO `permisos` VALUES (4, 'Ventas');
INSERT INTO `permisos` VALUES (5, 'Acceso');
INSERT INTO `permisos` VALUES (6, 'Consultas');

-- ----------------------------
-- Table structure for personas
-- ----------------------------
DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_persona` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tipo_documento` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `num_documento` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `telefono` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of personas
-- ----------------------------
INSERT INTO `personas` VALUES (1, 'Proveedor', 'Inversiones Santa Cruz SAC', 'RUC', '2236157773', NULL, NULL, NULL);
INSERT INTO `personas` VALUES (2, 'Proveedor', 'Inversiones Iglesias SAC', 'RUC', '20415689234', 'aaa', 'aaa', 'aaa@gmail.com');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tipo_documento` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `num_documento` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `telefono` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `id_cargo` int(11) NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `login_UNIQUE`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'Jorge Ernesto', 'DNI', '73704296', NULL, NULL, NULL, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '5.jpg', 1);
INSERT INTO `usuarios` VALUES (2, 'Lilia Sturman', 'DNI', '99999999', '', '', '', 2, 'lilia', 'e5b5a57b9d168fbdd42a1e8799dd59c3', 'KKK.jpg', 1);

-- ----------------------------
-- Table structure for ventas
-- ----------------------------
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo_comprobante` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `serie_comprobante` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `num_comprobante` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha_hora` datetime(0) NOT NULL,
  `impuesto` decimal(4, 2) NOT NULL,
  `total_venta` decimal(11, 2) NOT NULL,
  `estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_venta_persona_idx`(`id_cliente`) USING BTREE,
  INDEX `fk_venta_usuario_idx`(`id_usuario`) USING BTREE,
  CONSTRAINT `fk_ventas_personas` FOREIGN KEY (`id_cliente`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ventas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Triggers structure for table detalle_compras
-- ----------------------------
DROP TRIGGER IF EXISTS `tr_updateStockCompra`;
delimiter ;;
CREATE TRIGGER `tr_updateStockCompra` AFTER INSERT ON `detalle_compras` FOR EACH ROW BEGIN
    UPDATE articulos a
    SET    a.stock = a.stock + new.cantidad
    WHERE  a.id = new.id_articulo;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
