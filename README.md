

# Base de datos:

Modificar la configuracion en config/database.php



	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'CobraCode',



En su base de datos, crear la DB 'CobraCode' o crear alguna y modificar el nombre de la db en la configuracion 

Ejecutar en el shell de sql 

```

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

```

# Server

En mi caso, solo descargue el codigo, lo coloque en htdocs y lo ejecute directamente
