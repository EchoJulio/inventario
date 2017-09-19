<?php

class Session{

	public static function init(){
		//Metodo para iniciar una session
		session_start();
	}

	public static function destroy($clave = false){
		//Metodo para borrar una sesion
		
		//1-validamos que se haya enviado una clave
		if ($clave) {
			//2-validamos que es un array
			if (is_array($clave)) {
				for ($i=0; $i < count($clave); $i++) { 
					if (isset($_SESSION[$clave[$i]])) {
						//Recorremos el las sessiones y las eliminamos con la funcion unset
						unset($_SESSION[$clave[$i]]);
					}
				}
			}else{
				//si no es un array  eliminamos la session
				if (isset($_SESSION[$clave])) {
					unset($_SESSION[$clave]);
				}
			}
		}else{
			//Si no se envio nada destruimos la session en tu totalidad
			session_destroy();
		}
	}

	public static function set($clave, $valor){
		//Este metodo recibe un nombre de variable de sesion y su valor
		if (!empty($clave)) {
			$_SESSION[$clave] = $valor;
		}
	}

	public static function get($clave){
		//metodo para solicitar un valor en el array session
		if (isset($_SESSION[$clave])) {
			return $_SESSION[$clave];
		}
	}

	public static function acceso($level){
		//Validamos que este autenticado 
		if (!Session::get('autenticado')) {
			//Si el usuario no esta autenticado
			//lo redireccionamos

			header('Location:' . BASE_URL . 'error/access/5050');
			exit;
		}
		//validamos el tiempo
		Session::tiempo();

		//Validamos el nivel de acceso
		if (Session::getLevel($level) > Session::getLevel(Session::get('level'))) {
			//Si el nivel de acceso requido es mayor al que tiene el usuario es entonces se niego el acceso
				
			header('Location:' . BASE_URL . 'error/access/5050');
			exit;
		
		}

		 
	}

	public static function acessoView($level){
		//Validamos que este autenticado 
		if (!Session::get('autenticado')) {
			//Si el usuario no esta autenticado
			//lo redireccionamos
			return false; 
			
		}

		//Validamos el nivel de acceso
		if (Session::getLevel($level) > Session::getLevel(Session::get('level'))) {
			//Si el nivel de acceso requido es mayor al que tiene el usuario es entonces se niego el acceso
				
			return false;
		
		}
		return true;
	}

	public static function getLevel($level){

		//Metodo para controlar los niveles de acceso en la pagina

		$role['admin'] = 3;
		$role['especial'] = 2;
		$role['usuario'] = 1;

		if (!array_key_exists($level, $role)) {
			throw new Exception("Error de acceso");
			
		}else{
			return $role[$level];
		}

	}

	public static function accesoEstricto(array $level, $noAdmin = false){
		//El parametro noAdmin bloquea el acceso a los
		//Administradores cuando tiene el valor true
			if(!Session::get('autenticado')) {
					//Si el usuario no esta autenticado
					//lo redireccionamos

					header('Location:' . BASE_URL . 'error/access/5050');
					exit;
				
			}
			Session::tiempo();
			
			if(Session::get('level') == 'admin' && $noAdmin == false){
				return;
			}else{

				//validamos que el array no este vacio
				if (count($level)) {
					//validamos que los niveles que se enviaron en el array
					//esten en la lista
					if (in_array(Session::get('level'), $level)) {
						return;
					}
				}
				header('Location:' . BASE_URL . 'error/access/5050');
			}

			
			
			
	}

	public static function accesoViewEstricto(array $level, $noAdmin = false){
		if (!Session::get('autenticado')) {
				//Si el usuario no esta autenticado/logeado
				//lo redireccionamos

				return false;
			
		}

		if ($noAdmin == false) {
			
			if (Session::getLevel('admin')) {
				return;
			}
		}
		//validamos que el array no este vacio
		if (count($level)) {
			//validamos que los niveles que se enviaron en el array
			//esten en la lista
			if ( in_array(Session::get('level'), $level)) {
				return;
			}
		}
		return false;
	}

	public static function tiempo(){
		//Metodo para controlar el tiempo de las sesiones

		if (!Session::get('tiempo') || !defined('SESSION_TIME')) {
			//Validamos que existe o esta definida la variable SESSION_TIME

			throw new Exception("Error No se ha definido el tiempo de sesion");
			
		}

		if (SESSION_TIME == 0) {
			//cuando la constante vale 0 es que el tiempo sera indefinido
		 	return;
		}

		if (time() - Session::get('tiempo') > (SESSION_TIME * 60)) {
			//*funcion time devuelve el tiempo actual en segundos

			//a time le restamos el tiempo asignado a la funcion
			//lo que esquivale al tiempo transcurrido 
			//desde que se inicio sesion hasta el momento que
			//que se llame esta funcion
			//si ese tiempo es mayor al que esta permitido durar la sesion abierta entonces se
			//llama al metodo destroy y se elimina la sesion

			Session::destroy();
			header('Location:' . BASE_URL . 'error/access/8080');

		}else{
			//si aun esta en tiempo de sesion 
			//Reiniciamos el tiempo de sesion
			Session::set('tiempo', time());
		}

	}
}