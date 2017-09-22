<?php

class inventarioController extends Controller{

	private $categoria;
	private $producto;
	public function __construct(){
		parent::__construct();
		$this->categoria = $this->loadModel('categoria');
		$this->producto = $this->loadModel('productos');
	}

	public function index(){
		$this->view->titulo = 'Productos';
		$this->view->productos = $this->producto->lista();
		//Mi metodo para llamar las vistas
		$this->view->renderizar('index','Productos');
	}
	public function entrada(){
		Session::acceso('admin');
		$this->view->renderizar('entrada');
	}
	public function salida(){
		Session::acceso('admin');
		$this->view->renderizar('salida');
	}
	public function editar($id){
		Session::acceso('admin');
		
	}
	public function borrar($id){
		Session::acceso('admin');
		
	}

	
}