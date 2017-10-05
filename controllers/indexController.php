<?php

class indexController extends Controller{

	public $productos = '';
	public $categoria = '';
	public $ventas = '';
	public $usuarios = '';
	public $inventario = '';

	public function __construct(){
		//Ejecutamos en metodo constructor de la clase padre y
		//asi poder tener dispoble la vista que le pertenece a esta clase
		parent::__construct();
		$this->categoria = $this->loadModel('categoria');
		$this->productos = $this->loadModel('productos');
		$this->inventario = $this->loadModel('inventario');
		$this->usuarios = $this->loadModel('user');
	}
	public function index(){
		Session::acceso('usuario');
		//Enviar un el parametro titulo a la vista
		$this->view->titulo = 'Inventario | Main';
		$this->view->productos_total = count($this->productos->lista());
		$this->view->usuarios = count($this->usuarios->lista());
		$this->view->categoria = count($this->categoria->lista());
		
		$fecha = array(
			'dia' => date('d'),
			'mes' => date('m'),
			'ano' => date('Y')
 		);

		$this->view->recientes = $this->inventario->consulta_productos_tb_entrada($fecha);
		//Llamamos la vista perteneciente a este metodo
		$this->view->renderizar('index');
	}


}