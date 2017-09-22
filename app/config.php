	<?php
//Constante para el controlador por defecto para cuando se solicita
//un contrlador que no existe se sustituye por este.

// define('BASE_URL', 'http://localhost/mercadito/');
define('BASE_URL', 'http://localhost/inventario/');
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_LAYOUT', 'default');
define('SESSION_TIME', 60);
define('HASH_KEY', '5948861b6e066');

//Informacion sobre la compania
define('APP_NAME', 'Alamacen');
define('APP_SLOGAN', 'Vende todo lo que quieras, para el publico que quieras.');
define('APP_COMPANY', 'julio_dev');
define('MAIL_COMPANY', 'jv.capellan06@gmail.com');


//Informacion de la base de datos

define('DB_HOST', '127.0.0.1:3307');
// define('DB_HOST', 'localhost');
define('DB_NAME', 'inventario');
define('DB_USER', 'root');
define('DB_PASS', '123');
define('DB_CHARSET', 'utf8');