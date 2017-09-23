<?php

/**
* Modelo de la tabla productos donde se va a gestionar toda intreaccion
con la tabla productos.
*/
class inventarioModel extends model
{
	private $id_producto = '';
	private $id_usuario = '';
	private $detalle = '';
	private $descripcion = '';
	private $unidad = '';
	private $costo_unitario = '';
	private $costo_total = '';
	private $stock = '';

	public function __construct()
	{
		parent::__construct();
	}

	public function set($propiedad, $valor){
		$this->$propiedad = $valor;
	}
	public function lista($id = false){
		if ($id) {
			$id = (int) $id;
			$lista_query = $this->db->prepare('SELECT producto.id as id, producto.titulo as titulo, descripcion, categoria.titulo as categoria FROM producto LEFT JOIN categoria ON producto.id_categoria = categoria.id WHERE producto.id = :id');
			$lista_query->execute(array(':id' => $id));
			return $lista_query->fetch(PDO::FETCH_ASSOC);
		}else{
			$lista_query = $this->db->query('SELECT producto.id as id, producto.titulo as titulo, descripcion, categoria.titulo as categoria FROM producto LEFT JOIN categoria ON producto.id_categoria = categoria.id');
			return $lista_query->fetchAll(PDO::FETCH_ASSOC);
		}
		
	}
	private function consulta_stock($id_producto){
		$stock_query = $this->db->prepare('SELECT inventario.unidad as stock FROM inventario LEFT JOIN transaccion_entrada ON transaccion_entrada.id_inventario = inventario.id LEFT JOIN entrada ON entrada.id = transaccion_entrada.id_entrada WHERE entrada.id_producto = :id_producto');
		$stock_query->execute(array(':id_producto' => $id_producto));
		$stock_query = $stock_query->fetch(PDO::FETCH_ASSOC);
		if ($stock_query['stock'] != null) {
			return $stock_query['stock'];
		}else{
			return 0;
		}
		
	}
	public function entrada(){
		 $entrada_query = $this->db->prepare('INSERT INTO entrada (id_producto,id_usuario,detalle,descripcion,unidad,costo_unitario,costo_total) VALUES (:id_producto,:id_usuario,:detalle,:descripcion,:unidad,:costo_unitario,:costo_total)');
		 $inventario_query = $this->db->prepare('INSERT INTO inventario (unidad,costo_unitario,costo_total) VALUES (:unidad,:costo_unitario,:costo_total)');
		 $this->stock = $this->unidad + $this->consulta_stock($this->id_producto);
		 $costo_total = $this->costo_unitario * $this->unidad;
		 //$costo_total = $this->cantidad * $this->costo;
		 $datos_entrada = array(
				':descripcion' => $this->descripcion,
				':id_producto' => $this->id_producto,
				':id_usuario' => $this->id_usuario,
				':costo_unitario' => $this->costo_unitario,
				':detalle' => $this->detalle,
				':costo_total' => $costo_total,
				':unidad' => $this->unidad
			);
		 $datos_inventario = array(
				':costo_unitario' => $this->costo_unitario,
				':costo_total' => $this->costo_unitario * $this->stock,
				':unidad' => $this->stock
			);
		if ($entrada_query->execute($datos_entrada) && $inventario_query->execute($datos_inventario)) {
			$this->registrar_entrada_inventario();
			return true;
		}else{
			return false;
		}
	}
	public function salida(){
		 $add_query = $this->db->prepare('INSERT INTO salida (id_producto,id_usuario,detalle,descripcion,unidad,costo_unitario,costo_total) VALUES (:id_producto,:id_usuario,:detalle,:descripcion,:unidad,:costo_unitario,:costo_total)');
		 //$this->stock = $this->cantidad + $this->consulta_stock($this->id_producto);
		 $costo_total = $this->costo_unitario * $this->unidad;
		 //$costo_total = $this->cantidad * $this->costo;
		return $add_query->execute(array(
				':descripcion' => $this->descripcion,
				':id_producto' => $this->id_producto,
				':id_usuario' => $this->id_usuario,
				':costo_unitario' => $this->costo_unitario,
				':detalle' => $this->detalle,
				':costo_total' => $costo_total,
				':unidad' => $this->unidad
			));
	}
	private function registrar_entrada_inventario(){
		$registrar_query = $this->db->prepare('INSERT INTO transaccion_entrada (id_inventario, id_entrada) VALUES (:id_inventario, :id_entrada)');
		$last_entrada = $this->consulta_ultima_entrada();
		$last_inventario = $this->consulta_ultimo_inventario();
		$datos_transaccion = array(
				':id_inventario' => $last_inventario,
				':id_entrada' => $last_entrada
			);
		return $registrar_query->execute($datos_transaccion);
	}
	private function consulta_ultima_entrada(){
		$last_entrada = $this->db->query('SELECT MAX(id) AS id FROM entrada');
		$last_entrada = $last_entrada->fetch(PDO::FETCH_ASSOC);
		return $last_entrada['id'];
	}
	private function consulta_ultimo_inventario(){
		$last_inventario = $this->db->query('SELECT MAX(id) AS id FROM inventario');
		$last_inventario = $last_inventario->fetch(PDO::FETCH_ASSOC);
		return $last_inventario['id'];
	}
	private function registrar_salida_inventario(){

	}
	public function delete(){
		 $edit_query = $this->db->prepare('DELETE FROM producto WHERE id = :id');

		return $edit_query->execute(array(
				':id' => $this->id
			));
	}
}