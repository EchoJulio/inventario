<?php

class categoriaController extends Controller{

	private $categoria;
	private $producto;
	public function __construct(){
		parent::__construct();
		$this->categoria = $this->loadModel('categoria');
		$this->producto = $this->loadModel('productos');
	}

	public function index($pagina = false){
		Session::acceso('admin');
		if (!$this->filtrarInt($pagina)) {
			$pagina = false;
		}else{
			$pagina = (int) $pagina;
		}
		$this->getLibrary('paginador');
		$paginador = new Paginador();
		$limite = 20;
		$this->view->titulo = 'Productos';
		//$this->view->productos = $this->producto->lista();
		$this->view->productos = $paginador->paginar($this->producto->lista(), $pagina,$limite);
		$this->view->paginacion = $paginador->getView('prueba','productos/index');


		//Mi metodo para llamar las vistas
		$this->view->renderizar('index','Productos');
	}
	public function nuevo(){
		Session::acceso('admin');
		$this->view->titulo = 'Nuevo Producto';
		$this->view->categoria = $this->categoria->lista();
		$mensaje_error = array();

		if (isset($_POST) && !empty($_POST)) {
			if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
				$this->producto->set('titulo',$this->getTexto('titulo'));
			}else{
				$this->view->mensaje_error = 'No haz agregado ningun titulo';
				exit;
			}

			if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
				$this->producto->set('descripcion',$this->getTexto('descripcion'));
			}else{
				$this->view->mensaje_error = 'No haz agregado ninguna descripcion';
				exit;
			}

			$this->producto->set('id_categoria',$this->getTexto('id_categoria'));
			$this->producto->set('id_usuario',Session::get('id'));
			if ($this->producto->add()) {
				$this->view->mensaje_exito = 'El producto a sido creado.';
			}else{
				$this->view->mensaje_error = 'Hubo un error con la creacion del producto, intentalo mas tarde.';
				
			}
		}
		$this->view->renderizar('nuevo');
	}
	public function editar($id){
		Session::acceso('admin');
		$this->view->titulo = 'Editar Producto';
		$this->view->categoria = $this->categoria->lista();
		$this->view->productos = $this->producto->lista($id);
		$mensaje_error = array();

		if (isset($_POST) && !empty($_POST)) {
			if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
				$this->producto->set('titulo',$this->getTexto('titulo'));
			}else{
				$this->view->mensaje_error = 'No haz agregado ningun titulo';
				exit;
			}

			if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
				$this->producto->set('descripcion',$this->getTexto('descripcion'));
			}else{
				$this->view->mensaje_error = 'No haz agregado ninguna descripcion';
				exit;
			}

			$this->producto->set('id_categoria',$this->getTexto('id_categoria'));
			$this->producto->set('id',$id);
			if ($this->producto->edit()) {
				$this->view->productos = $this->producto->lista($id);
				$this->view->mensaje_exito = 'El producto a sido editado.';
			}else{
				$this->view->mensaje_error = 'Hubo un error con la edicion del producto, intentalo mas tarde.';
				
			}
		}
		$this->view->renderizar('editar');
	}
	public function borrar($id){
		Session::acceso('admin');
		$this->producto->set('id',$id);
		if ($this->producto->delete()) {
			$this->redireccionar('productos');
		}
	}

	
}