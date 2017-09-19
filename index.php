<?php
ini_set('display_errors',1);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'app' . DS);



try{
	
	require_once APP_PATH . 'bootstrap.php';
	require_once APP_PATH . 'config.php';
	require_once APP_PATH . 'controller.php';
	require_once APP_PATH . 'database.php';
	require_once APP_PATH . 'model.php';
	require_once APP_PATH . 'request.php';
	require_once APP_PATH . 'session.php';
	require_once APP_PATH . 'view.php';
	require_once APP_PATH . 'hash.php';
	//Metodo que inicia la sesion 
	//justo al momento que se carga la pagina
	Session::init();


	Bootstrap::run(new Request);

}catch(Exception $e){
	echo $e->getMessage();
}

?>