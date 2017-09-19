<?php
/**
* clase encargada de llamar al controlador y el metodo solicitado desde la url
*/
class Bootstrap
{
	
	public static function run(Request $peticion){

		//Recibimos el Objeto request como parametro
		//Luego de eso obtenemos el controlador enviado via URL

		$controller = $peticion->getControlador() . 'Controller';
		$rutaControlador = ROOT . 'controllers' . DS . $controller . '.php';
		//Formamos la ruta del archivo que seria 
		//'controlador solicitado'Controller.php
		

		//gurdamos el metodo solicitado
		$metodo = $peticion->getMetodo();

		//Guardamos los argumentos/parametros solicitados desde la url
		$argumentos = $peticion->getArgumentos();

		//verificamos si existe tal archivo o es valido
		if (is_readable($rutaControlador)) {
			
			require_once $rutaControlador;
			//Instancioamos la clase del controlador que se pidio 
			$controller = new $controller;

			if (is_callable(array($controller,$metodo))) {
				$metodo = $peticion->getMetodo();
			}else{
				$metodo = 'index';
			}


			
			if (isset($argumentos)) {
				//Esta funcion lo que hace es llamar una funcion/metodo
				//pero debemos enviarle un array con la clase y funcion a ejecutar
				//y ademas los argumentos/parametros que recibe dicha funcion/metodo
				call_user_func_array(array($controller, $metodo), $argumentos);
			}else{
				//Esta funcion lo que hace es llamar una funcion/metodo **QUE NO RECIBE PARAMETROS/ARGUMENTOS**
				//pero debemos enviarle un array con la clase y funcion a ejecutar
				call_user_func(array($controller, $metodo));

			}

		}else{
			header('Location:' . BASE_URL . 'error/access/1010');
			exit;;
			
		}
	}
}