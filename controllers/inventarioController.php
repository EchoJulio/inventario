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

	public function index($pagina = false){
		Session::acceso('admin');
		if (!$this->filtrarInt($pagina)) {
			$pagina = false;
		}else{
			$pagina = (int) $pagina;
		}
		$this->view->titulo = 'Inventario';
		$this->getLibrary('paginador');
		$paginador = new Paginador();
		$limite = 20;
		$i = 0;
		$this->view->productos = $this->inventario->lista();
		foreach ($this->view->productos as $key => $value) {
			$stock = $this->inventario->consulta_stock($value['id']);
			$costo_promedio = $this->inventario->calcular_costo_promedio($value['id']);
			if ($stock > 0 && $costo_promedio > 0) {
				$this->view->productos[$i]['stock'] = $stock;
				$this->view->productos[$i]['costo_promedio'] = $costo_promedio;
			}else{
				$this->view->productos[$i]['stock'] = 0;
				$this->view->productos[$i]['costo_promedio'] = 0;
			}
			
			// $this->view->productos[0][$i]['promedio'] = $this->inventario->calcular_costo_promedio($value['id_producto']);
			$i++;
 		}
 		//$this->view->productos[] = $this->inventario->lista();
		$this->view->productos = $paginador->paginar($this->view->productos, $pagina,$limite);
		$this->view->paginacion = $paginador->getView('prueba','inventario/index');
		//Mi metodo para llamar las vistas
		$this->view->renderizar('index','Productos');
	}
	public function entrada(){
		$this->view->titulo = 'Inventario';
		Session::acceso('admin');
		if (isset($_POST) && !empty($_POST)) {
			if (isset($_POST['id']) && !empty($_POST['id'])) {
				if (isset($_POST['cantidad']) && !empty($_POST['cantidad']) && $_POST['cantidad'] >= 1) {
					if (isset($_POST['costo']) && !empty($_POST['costo']) && $_POST['costo'] >= 1) {
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
							$this->view->mensaje_error = 'Hubo un error con el registro.';
						}
					}else{
						$this->view->mensaje_error = 'Falta la descripcion.';
					}
				}else{
					$this->view->mensaje_error = 'No haz agregado el costo a registrar o es una monto no valido';
				}
				}else{
					$this->view->mensaje_error = 'No haz asignado la cantidad a registrar o es un monto no valido.';
				}
			}else{
				$this->view->mensaje_error = 'No se ha seleccionado ningun producto.';
			}
		}
		$this->view->renderizar('entrada');
	}
	public function salida(){
		$this->view->titulo = 'Inventario';
		Session::acceso('admin');
		if (isset($_POST) && !empty($_POST)) {
			if (isset($_POST['id']) && !empty($_POST['id'])) {
				if (isset($_POST['cantidad']) && !empty($_POST['cantidad'] && $_POST['cantidad'] >= 1)) {
						if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
						if ($this->inventario->consulta_stock($_POST['id']) > 0) {
							if ($_POST['cantidad'] <= $this->inventario->consulta_stock($_POST['id'])) {
								$this->inventario->set('id_producto',$_POST['id']);
								$this->inventario->set('id_usuario',Session::get('id'));
								$this->inventario->set('unidad',$_POST['cantidad']);
								$this->inventario->set('detalle',$_POST['razon']);
								$this->inventario->set('descripcion',$_POST['descripcion']);
							if ($this->inventario->salida()) {
								$this->view->mensaje_exito = 'Registro exitoso!';
							}else{
								$this->view->mensaje_error = 'Hubo un error con el registro.';
							}
							}else{
								$this->mensaje_error = 'No puede registrar una salida mayor a la cantidad desponible en el inventario.';
							}
						}else{
							$this->view->mensaje_error = 'Este producto esta agotado.';
						}
					}else{
						$this->view->mensaje_error = 'Falta la descripcion.';
					}
				}else{
					$this->view->mensaje_error = 'No haz asignado la cantidad a registrar o es un monto no valido.';
				}
			}else{
				$this->view->mensaje_error = 'No se ha seleccionado ningun producto.';
			}
		}
		//echo $this->inventario->consulta_stock(3);
		$this->view->renderizar('salida');
	}
	public function editar($id){
		Session::acceso('admin');
		
	}
	public function borrar($id){
		Session::acceso('admin');
		
	}

	
}