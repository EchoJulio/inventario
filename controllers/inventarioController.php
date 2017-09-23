<?php

class inventarioController extends Controller{

	private $categoria;
	private $producto;
	private $inventario;
	public function __construct(){
		parent::__construct();
		$this->categoria = $this->loadModel('categoria');
		$this->producto = $this->loadModel('productos');
		$this->inventario = $this->loadModel('inventario');
	}

	public function index(){
		$this->view->titulo = 'Productos';
		$this->view->productos = $this->producto->lista();
		//Mi metodo para llamar las vistas
		$this->view->renderizar('index','Productos');
	}
	public function entrada(){
		Session::acceso('admin');
		if (isset($_POST) && !empty($_POST)) {
			if (isset($_POST['id']) && !empty($_POST['id'])) {
				if (isset($_POST['cantidad']) && !empty($_POST['cantidad'])) {
					if (isset($_POST['costo']) && !empty($_POST['costo'])) {
						if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
						$this->inventario->set('id_producto',$_POST['id']);
						$this->inventario->set('id_usuario',Session::get('id'));
						$this->inventario->set('unidad',$_POST['cantidad']);
						$this->inventario->set('costo_unitario',$_POST['costo']);
						$this->inventario->set('detalle',$_POST['razon']);
						$this->inventario->set('descripcion',$_POST['descripcion']);
						if ($this->inventario->entrada()) {
							$this->view->mensaje_exito = 'Registro exitoso!';
						}else{
							$this->view->mensaje_error = 'Hubo un erro con el registro.';
						}
					}else{
						$this->view->mensaje_error = 'Falta la descripcion.';
					}
				}else{
					$this->view->mensaje_error = 'No se ha la cantidad a registrar.';
				}
				}else{
					$this->view->mensaje_error = 'No haz asignado la cantidad a registrar.';
				}
			}else{
				$this->view->mensaje_error = 'No se ha seleccionado ningun producto.';
			}
		}
		$this->view->renderizar('entrada');
	}
	public function salida(){
		Session::acceso('admin');
		if (isset($_POST) && !empty($_POST)) {
			if (isset($_POST['id']) && !empty($_POST['id'])) {
				if (isset($_POST['cantidad']) && !empty($_POST['cantidad'])) {
					if (isset($_POST['costo']) && !empty($_POST['costo'])) {
						if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
						$this->inventario->set('id_producto',$_POST['id']);
						$this->inventario->set('id_usuario',Session::get('id'));
						$this->inventario->set('unidad',$_POST['cantidad']);
						$this->inventario->set('costo_unitario',$_POST['costo']);
						$this->inventario->set('detalle',$_POST['razon']);
						$this->inventario->set('descripcion',$_POST['descripcion']);
						if ($this->inventario->salida()) {
							$this->view->mensaje_exito = 'Registro exitoso!';
						}else{
							$this->view->mensaje_error = 'Hubo un erro con el registro.';
						}
					}else{
						$this->view->mensaje_error = 'Falta la descripcion.';
					}
				}else{
					$this->view->mensaje_error = 'No se ha la cantidad a registrar.';
				}
				}else{
					$this->view->mensaje_error = 'No haz asignado la cantidad a registrar.';
				}
			}else{
				$this->view->mensaje_error = 'No se ha seleccionado ningun producto.';
			}
		}
		$this->view->renderizar('salida');
	}
	public function editar($id){
		Session::acceso('admin');
		
	}
	public function borrar($id){
		Session::acceso('admin');
		
	}

	
}