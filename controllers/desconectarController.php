<?php

/**
* Controlador que tiene la logica para el login de sitio
*/
class desconectarController extends Controller
{
	
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		
		if (Session::get('autenticado')) {
			Session::destroy();
			$this->redireccionar('login');
		}

	}
}