<?php

class errorController extends Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->view->titulo = 'Error';
		$this->view->mensaje = $this->getError();

		//Mi metodo para llamar las vistas
		$this->view->renderizar('index','error');
	}

	

	public function access($codigo){
		$this->view->titulo = 'Error';
		$this->view->mensaje = $this->getError($codigo);

		//Mi metodo para llamar las vistas
		$this->view->renderizar('access');
	}
	
	private function getError($codigo  = false){
		//Verificamos que se haya enviado un error
		if ($codigo) {
			$codigo = $this->filtrarInt($codigo);
		}else{
			$codigo = 'default';
		}	
		//Array asoc con la lista de errores que puedo solicitar
		//por la url usado la variable codigo
		$error['default'] = 'Oops! Ha ocurrido un error y la pagina no puede mostrarse.';
		$error['5050'] = 'Acceso restringido';
		$error['8080'] = 'El tiempo de sesion se a agotado';
		$error['1010'] = 'La direccion no esta disponible';

		//Validamos que el error enviado exista en la lista y de ser asi lo retornamos
		if (array_key_exists($codigo, $error)) {
			return $error[$codigo];
		}else{
			//si el error no se encuentro en la lista retornamos el error por defecto
			return $error['default'];
		}
	}
}