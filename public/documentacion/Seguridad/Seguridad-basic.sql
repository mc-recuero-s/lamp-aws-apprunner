-- Eliminamos las tablas si existen, en orden inverso para evitar errores por dependencias
DROP TABLE IF EXISTS usuario_perfil;
DROP TABLE IF EXISTS usuario_funcionalidad;
DROP TABLE IF EXISTS usuario_rol;
DROP TABLE IF EXISTS perfil_rol;
DROP TABLE IF EXISTS rol_funcionalidad;
DROP TABLE IF EXISTS rol_modulo;
DROP TABLE IF EXISTS perfil;
DROP TABLE IF EXISTS funcionalidad;
DROP TABLE IF EXISTS modulo;
DROP TABLE IF EXISTS rol;

-- Crear tablas base
CREATE TABLE `usuario` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(255) NOT NULL,
  `apellido` VARCHAR(255) NOT NULL,
  `correo` VARCHAR(255) NOT NULL,
  `usuario` VARCHAR(255) NOT NULL,
  `contrasena` VARCHAR(255) NOT NULL,
  `tipo` BIGINT NOT NULL,
  `categoria` BIGINT NOT NULL,
  `creado` DATETIME NOT NULL,
  `por` BIGINT NOT NULL
) ENGINE=InnoDB;

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `correo`, `usuario`, `contrasena`, `tipo`, `categoria`, `creado`, `por`) VALUES
(1, 'Admin', 'Admin', 'Admin@Admin.org.co', 'Admin', '123', 1, 0, '2020-08-27', 0),
(2, 'Tesoreria', 'Tesoreria', 'Tesoreria@Tesoreria.org', 'Tesoreria', '123', 101, 0, '2024-06-03', 0),
(3, 'Mercadeo', 'Mercadeo', 'Mercadeo@Mercadeo.org.co', 'Mercadeo', '123', 102, 0, '2024-06-03', 0),
(4, 'Contabilidad ', 'Contabilidad', 'Contabilidad@Contabilidad.org.co', 'Contabilidad', '123', 103, 0, '2024-06-03', 0),
(5, 'Revisoria', 'Revisoria', 'Revisoria@Revisoria.com.co', 'Revisoria', '123', 104, 0, '2024-06-03', 0),
(6, 'entradas', 'entradas', 'entradas@gmail.com', 'entradas', '123', 2, 1, '0000-00-00', 0),
(7, 'salidas', 'salidas', 'salidas@gmail.com', 'salidas', '123', 3, 1, '0000-00-00', 0),
(8, 'cuartosfrios', 'cuartosfrios', 'cuartosfrios@cuartosfrios.org.co', 'cuartosfrios', '123', 3, 0, '0000-00-00', 0),
(9, 'alistamiento', 'alistamiento', 'alistamiento@alistamiento.org.co', 'alistamiento', '123', 3, 0, '0000-00-00', 0),
(10, 'fruver', 'fruver', 'fruver@fruver.org.co', 'fruver', '123', 3, 0, '0000-00-00', 0);

CREATE TABLE `rol` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(255) NOT NULL,
  `categoria` BIGINT NOT NULL,
  `creado` DATETIME NOT NULL,
  `por` BIGINT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `modulo` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(255) NOT NULL,
  `abreviatura` VARCHAR(255) NOT NULL,
  `elemento` VARCHAR(255) NOT NULL,
  `creado` DATETIME NOT NULL,
  `por` BIGINT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE `perfil` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(255) NOT NULL,
  `codigo` VARCHAR(255) NOT NULL,
  `creado` DATETIME NOT NULL,
  `por` BIGINT NOT NULL
) ENGINE=InnoDB;

-- Ahora funcionalidad incluye el enlace directo a módulo
CREATE TABLE `funcionalidad` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(255) NOT NULL,
  `abreviatura` VARCHAR(255) NOT NULL,
  `elemento` VARCHAR(255) NOT NULL,
  `ver` BOOLEAN NOT NULL,
  `editar` BOOLEAN NOT NULL,
  `eliminar` BOOLEAN NOT NULL,
  `modulo` BIGINT UNSIGNED NOT NULL,
  `creado` DATETIME NOT NULL,
  `por` BIGINT NOT NULL,
  INDEX (`modulo`),
  CONSTRAINT `funcionalidad_modulo_foreign` FOREIGN KEY (`modulo`) REFERENCES `modulo`(`id`)
) ENGINE=InnoDB;

-- Tablas relacionales
CREATE TABLE `usuario_rol` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `usuario` BIGINT UNSIGNED NOT NULL,
  `rol` BIGINT UNSIGNED NOT NULL,
  `creado` DATETIME NOT NULL,
  `por` BIGINT NOT NULL,
  INDEX (`usuario`), INDEX (`rol`),
  CONSTRAINT `usuario_rol_usuario_foreign` FOREIGN KEY (`usuario`) REFERENCES `usuario`(`id`),
  CONSTRAINT `usuario_rol_rol_foreign` FOREIGN KEY (`rol`) REFERENCES `rol`(`id`)
) ENGINE=InnoDB;

CREATE TABLE `usuario_funcionalidad` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `usuario` BIGINT UNSIGNED NOT NULL,
  `funcionalidad` BIGINT UNSIGNED NOT NULL,
  `creado` DATETIME NOT NULL,
  `por` BIGINT NOT NULL,
  INDEX (`usuario`), INDEX (`funcionalidad`),
  CONSTRAINT `usuario_funcionalidad_usuario_foreign` FOREIGN KEY (`usuario`) REFERENCES `usuario`(`id`),
  CONSTRAINT `usuario_funcionalidad_funcionalidad_foreign` FOREIGN KEY (`funcionalidad`) REFERENCES `funcionalidad`(`id`)
) ENGINE=InnoDB;

CREATE TABLE `rol_funcionalidad` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `rol` BIGINT UNSIGNED NOT NULL,
  `funcionalidad` BIGINT UNSIGNED NOT NULL,
  `creado` DATETIME NOT NULL,
  `por` BIGINT NOT NULL,
  INDEX (`rol`), INDEX (`funcionalidad`),
  CONSTRAINT `rol_funcionalidad_rol_foreign` FOREIGN KEY (`rol`) REFERENCES `rol`(`id`),
  CONSTRAINT `rol_funcionalidad_funcionalidad_foreign` FOREIGN KEY (`funcionalidad`) REFERENCES `funcionalidad`(`id`)
) ENGINE=InnoDB;

CREATE TABLE `rol_modulo` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `rol` BIGINT UNSIGNED NOT NULL,
  `modulo` BIGINT UNSIGNED NOT NULL,
  `creado` DATETIME NOT NULL,
  `por` BIGINT NOT NULL,
  INDEX (`rol`), INDEX (`modulo`),
  CONSTRAINT `rol_modulo_rol_foreign` FOREIGN KEY (`rol`) REFERENCES `rol`(`id`),
  CONSTRAINT `rol_modulo_modulo_foreign` FOREIGN KEY (`modulo`) REFERENCES `modulo`(`id`)
) ENGINE=InnoDB;

CREATE TABLE `usuario_perfil` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `usuario` BIGINT UNSIGNED NOT NULL,
  `perfil` BIGINT UNSIGNED NOT NULL,
  `creado` DATETIME NOT NULL,
  `por` BIGINT NOT NULL,
  INDEX (`usuario`), INDEX (`perfil`),
  CONSTRAINT `usuario_perfil_usuario_foreign` FOREIGN KEY (`usuario`) REFERENCES `usuario`(`id`),
  CONSTRAINT `usuario_perfil_perfil_foreign` FOREIGN KEY (`perfil`) REFERENCES `perfil`(`id`)
) ENGINE=InnoDB;

CREATE TABLE `perfil_rol` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `perfil` BIGINT UNSIGNED NOT NULL,
  `rol` BIGINT UNSIGNED NOT NULL,
  `creado` DATETIME NOT NULL,
  `por` BIGINT NOT NULL,
  INDEX (`perfil`), INDEX (`rol`),
  CONSTRAINT `perfil_rol_perfil_foreign` FOREIGN KEY (`perfil`) REFERENCES `perfil`(`id`),
  CONSTRAINT `perfil_rol_rol_foreign` FOREIGN KEY (`rol`) REFERENCES `rol`(`id`)
) ENGINE=InnoDB;
