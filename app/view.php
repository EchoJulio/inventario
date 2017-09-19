<?php

class View{

	private $controlador;
	private $js;

	public function __construct(Request $peticion){
		//Obtenemos el nombre controlador solicitado via url
		$this->controlador = $peticion->getControlador();
		$this->js = array();
	}

	public function renderizar($vista, $item = false){
		//Metodo para llamar a las vistas.
		//El parametro item es usado para saber cambiar la clase active en el menu

		$js = array();

		//Array de las opciones del menu
		$menu = array(

			array(
					'id' => 'inicio',
					'titulo' => 'Inicio',
					'enlace' => BASE_URL
				),
			array(
					'id' => 'publicar',
					'titulo' => 'Publicar',
					'enlace' => BASE_URL . 'post'
				)
			
		);

		//Cuando el usuario esta autenticado
		//Generamos este menu
		if (Session::get('autenticado')) {
			$menu[] = array(
					'id' => 'login',
					'titulo' => 'Cerrar Sesion',
					'enlace' => BASE_URL . 'login/cerrar'
				);
		}else{
			//Si no esta autenticado
			//Generamos este menu
			$menu[] = array(
					'id' => 'login',
					'titulo' => 'Iniciar Sesion',
					'enlace' => BASE_URL . 'login'
				);
			$menu[] = array(
					'id' => 'registro',
					'titulo' => 'Registro',
					'enlace' => BASE_URL . 'registro'
				);
		}
		
		//array con los pluggins
		if (count($this->js)) {
			$js = $this->js;
		}
			$layoutParams = array(
				
				'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/' . 'css/',
				'ruta_img' =>BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/' . 'img/',
				'ruta_js' =>BASE_URL . 'public/' . 'js/',
				'menu' => $menu,
				'js' => $js

			);
		
		

		//Aqui generemos el nombre del archivo que contiene la vista solicitada
		$rutaView = ROOT . 'views' . DS . $this->controlador . DS . $vista . '.php';
		
		//Verificamos si el archivo  existe o puede user ejecutado
		if (is_readable($rutaView)) {
			include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
			include_once $rutaView;
			include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';

		}else{
			throw new Exception("Error: con la vista solicitada");
			
		}
	}

	public function setJs(array $js){

		if (is_array($js) && count($js)) {
			
			for ($i=0; $i < count($js); $i++) { 

				$this->js[] = BASE_URL . 'views/' . $this->controlador . '/js/' . $js[$i] . '.js';
			}
		}else{
			throw new Exception("Error: Al cargar el archivo J");
			
		}
	}
}