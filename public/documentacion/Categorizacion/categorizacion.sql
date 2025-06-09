CREATE TABLE `categorizacion`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(255) NOT NULL,
    `version` BIGINT NOT NULL,
    `actual` BOOLEAN NOT NULL,
    `creado` DATETIME NOT NULL,
    `por` BIGINT NOT NULL
);
CREATE TABLE `categorizacion_item`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `codigo` BIGINT NOT NULL,
    `tipo` BIGINT NOT NULL,
    `order` BIGINT NOT NULL,
    `categorizacion` BIGINT NOT NULL
);
CREATE TABLE `categoria`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombrebigint` VARCHAR(255) NOT NULL,
    `codigo` VARCHAR(255) NOT NULL,
    `creado` DATETIME NOT NULL,
    `por` BIGINT NOT NULL
);
CREATE TABLE `subcategoria`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombre` BIGINT NOT NULL,
    `categoria` BIGINT NOT NULL,
    `creado` DATETIME NOT NULL,
    `por` BIGINT NOT NULL
);
CREATE TABLE `producto`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombre` BIGINT NOT NULL,
    `subcategoria` BIGINT NOT NULL,
    `estado` BIGINT NOT NULL,
    `creado` DATETIME NOT NULL,
    `por` BIGINT NOT NULL
);
ALTER TABLE
    `producto` ADD CONSTRAINT `producto_subcategoria_foreign` FOREIGN KEY(`subcategoria`) REFERENCES `subcategoria`(`id`);
ALTER TABLE
    `categorizacion_item` ADD CONSTRAINT `categorizacion_item_categorizacion_foreign` FOREIGN KEY(`categorizacion`) REFERENCES `categorizacion`(`id`);
ALTER TABLE
    `subcategoria` ADD CONSTRAINT `subcategoria_categoria_foreign` FOREIGN KEY(`categoria`) REFERENCES `categoria`(`id`);