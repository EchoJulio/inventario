<?php

abstract class Controller{

	protected $view;

	public function __construct(){
		//primero generamos la URL de la vista
		//utilizando la peticion de la URL
		//la vistara estara disponible para todos los
		//controladores que herenden esta clase
		$this->view = new View(new Request);
	}

	//Funcion que va hacer heradada por todas las
	//clases heredades de Controller
	abstract public function index();

	protected function loadModel($modelo){
		$modelo = $modelo . 'Model';
		$rutaModelo = ROOT . 'models' . DS . $modelo . '.php';
		

		if (is_readable($rutaModelo)) {
			require_once $rutaModelo;
			$modelo = new $modelo;
			return $modelo;
		}else{
			throw new Exception("Error al acceder al modelo solicitado");
			
		}
	}

	protected function getLibrary($libreria){
		//Metodo para exportar libreria
		
		$rutaLibreria = ROOT . 'libs' . DS . $libreria . '.php';

		if (is_readable($rutaLibreria)) {
			include_once $rutaLibreria;
		}else{
			throw new Exception("Error al intentar acceder a la libreria ");
			
		}
	}

	protected function getTexto($clave){
		//Metodo para limpiar los campos de tipo texto enviados por post
		//transformar o quitar las comillas simples y dobles
		
		if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
			$_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);
			return $_POST[$clave];
		}
		return '';
	}

	protected function getInt($clave){
		//Metodo para limpiar los campos de tipo enteros enviados por post
		//transformar o quitar las comillas simples y dobles
		
		if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
			$_POST[$clave] = filter_var($_POST[$clave], FILTER_VALIDATE_INT);
			return $_POST[$clave];
		}
		return 0;
	}

	protected function getEmail($clave){
		//Metodo para limpiar los campos de tipo enteros enviados por post
		//transformar o quitar las comillas simples y dobles
		
		if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
			$_POST[$clave] = filter_var($_POST[$clave], FILTER_VALIDATE_EMAIL);
			return $_POST[$clave];
		}
		return '';
	}

	protected function redireccionar($ruta = false){
		 if ($ruta) {
		 	header('Location:' . BASE_URL . $ruta);
		 	exit;
		 }
		 else
		 {
		 	header('Location:' . BASE_URL);
		 	exit;
		 }
	}

	protected function filtrarInt($int){
		$int = (int) $int;
		if (is_int($int)) {
			return $int;
		}else{
			return 0;
		}
	}

	protected function getPostParam($clave){
		if (isset($_POST[$clave])) {
			
			return $_POST[$clave];
		}

	}


	protected function getSql($clave){

        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = strip_tags($_POST[$clave]);
            
            if(!get_magic_quotes_gpc()){
                $_POST[$clave] = $_POST[$clave];
            }
            return trim($_POST[$clave]);
        }
    }
    
    protected function getAlphaNum($clave){
    	
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);
            return trim($_POST[$clave]);
        }
        return false;
        
    }

    protected function validarEmail($email){
    	//Funcion para validar el email
    	if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
    		
    		return true;
    	}
    	return false;
    }

    protected function noEspacio($clave){

		if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
			if (strpos($_POST[$clave], " ")) {
				return true;
			}
		}
		return false;

	}

	protected function validarNombre($clave){

		if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
			if (preg_match('/[^A-Za-z]+$/', $_POST[$clave])) {

				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	protected function validarUsuario($clave){
    	
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            if (preg_match('/[^a-z0-9_]/i', $_POST[$clave])) {
            	 return true;
            }
           
        }
        return false;
        
    }

    protected function validarImg($img){
    	if (!isset($img)) {
    		return false;

    	}else{

	    	if (count($img['imagenes']['name']) == 0 || !count($img['imagenes']['name'])) {
	    		return false;
	    	}

	    	if (count($img['imagenes']['name']) > 5) {
	    		return false;
	    	}
    	}
    	return true;

    }

    protected function validarFormatoImg($img){

    	
    	if (!isset($img)) {
    		return false;

    	}


    	$formatosValidos = array('image/gif', 'image/jpg', 'image/jpeg', 'image/png');

    	$formatosImg = $img['imagenes']['type'];
    	//$imagenInfo = getimagesize($img['imagenes']['tmp_name']);

    	
    	//Validamos el formato permitido de las imagenes
    	 for ($i=0; $i < count($formatosImg); $i++) { 
			if (!in_array($formatosImg[$i], $formatosValidos)) {
				return false;
			}
    	 }
    	return true;

    }

    protected function validarTamanoImg($img){
    	
    	if (!isset($img)) {
    		return false;

    	}

    	$tamanoMax = 5 * 1024 * 1024;

    	//Validamos el tamano maximo de los imagenes
    	if (count($img['imagenes']['size']) > 0 && count($img['imagenes']['size']) > $tamanoMax) {
    		return false;
    	}

    	
    	return true;

    }

    



}