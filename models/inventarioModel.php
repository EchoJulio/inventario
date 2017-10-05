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
			$lista_query = $this->db->prepare('SELECT  producto.id as id, producto.titulo as titulo, descripcion, categoria.titulo as categoria FROM producto LEFT JOIN categoria ON producto.id_categoria = categoria.id WHERE producto.id = :id');
			$lista_query->execute(array(':id' => $id));
			return $lista_query->fetch(PDO::FETCH_ASSOC);
		}else{
			$lista_query = $this->db->query('SELECT producto.id as id, producto.titulo as titulo, descripcion, categoria.titulo as categoria FROM producto LEFT JOIN categoria ON producto.id_categoria = categoria.id');
			return $lista_query->fetchAll(PDO::FETCH_ASSOC);
		}
		
	}
	public function consulta_stock($id_producto){
		$query_entrada = $this->db->prepare('SELECT id_producto, SUM(unidad) as total_entradas FROM entrada WHERE id_producto = :id_producto');
		$query_entrada->execute(array(':id_producto' => $id_producto));
		$query_entrada = $query_entrada->fetch(PDO::FETCH_ASSOC);
		$sum_entradas = $query_entrada['total_entradas'];

		$query_salida = $this->db->prepare('SELECT SUM(unidad) as total_salida FROM salida WHERE id_producto = :id_producto');
		$query_salida->execute(array(':id_producto' => $id_producto));
		$query_salida = $query_salida->fetch(PDO::FETCH_ASSOC);
		$sum_salidas = $query_salida['total_salida'];

		$existencia = $sum_entradas - $sum_salidas;
		
		if ($existencia != null) {
			return $existencia;
		}else{
			return 0;
		}
		
	}
	private function actualizar_inventario(array $datos_inventario){
		 $inventario_query = $this->db->prepare('INSERT INTO inventario (unidad,costo_unitario,costo_total) VALUES (:unidad,:costo_unitario,:costo_total)');
		 if ($inventario_query->execute($datos_inventario)) {
		 	return true;
		 }
	}
	public function entrada(){
		 $entrada_query = $this->db->prepare('INSERT INTO entrada (id_producto,id_usuario,detalle,descripcion,unidad,costo_unitario,costo_total) VALUES (:id_producto,:id_usuario,:detalle,:descripcion,:unidad,:costo_unitario,:costo_total)');
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
		if ($entrada_query->execute($datos_entrada) && $this->actualizar_inventario($datos_inventario)) {
			$this->registrar_transaccion_entrada_inventario();
			return true;
		}else{
			return false;
		}
	}
	public function salida(){
		 $salida_query = $this->db->prepare('INSERT INTO salida (id_producto,id_usuario,detalle,descripcion,unidad,costo_unitario,costo_total) VALUES (:id_producto,:id_usuario,:detalle,:descripcion,:unidad,:costo_unitario,:costo_total)');
		 $this->stock = $this->consulta_stock($this->id_producto) - $this->unidad;
		 $costo_unitario_promedio = $this->calcular_costo_promedio($this->id_producto);
		 $costo_total = $costo_unitario_promedio * $this->unidad;
		 $datos_salida = array(
				':descripcion' => $this->descripcion,
				':id_producto' => $this->id_producto,
				':id_usuario' => $this->id_usuario,
				':detalle' => $this->detalle,
				':unidad' => $this->unidad,
				':costo_unitario' => $costo_unitario_promedio,
				':costo_total' => $costo_total
			);
		  $datos_inventario = array(
				':costo_unitario' => $costo_unitario_promedio,
				':costo_total' => $costo_unitario_promedio * $this->stock,
				':unidad' => $this->stock
			);
		 //$costo_total = $this->cantidad * $this->costo;
		if ($salida_query->execute($datos_salida) && $this->actualizar_inventario($datos_inventario)) {
			$this->registrar_transaccion_salida_inventario();
			return true;
		}else{
			return false;
		}
	}
	private function registrar_transaccion_entrada_inventario(){
		$registrar_query = $this->db->prepare('INSERT INTO transaccion_entrada (id_inventario, id_entrada) VALUES (:id_inventario, :id_entrada)');
		$last_entrada = $this->consulta_ultima_entrada();
		$last_inventario = $this->consulta_ultimo_inventario();
		$datos_transaccion = array(
				':id_inventario' => $last_inventario,
				':id_entrada' => $last_entrada
			);
		return $registrar_query->execute($datos_transaccion);
	}
	private function registrar_transaccion_salida_inventario(){
		$registrar_query = $this->db->prepare('INSERT INTO transaccion_salida (id_inventario, id_salida) VALUES (:id_inventario, :id_salida)');
		$last_salida = $this->consulta_ultima_salida();
		$last_inventario = $this->consulta_ultimo_inventario();
		$datos_transaccion = array(
				':id_inventario' => $last_inventario,
				':id_salida' => $last_salida
			);
		return $registrar_query->execute($datos_transaccion);
	}
	private function consulta_ultima_entrada(){
		$last_entrada = $this->db->query('SELECT MAX(id) AS id FROM entrada');
		$last_entrada = $last_entrada->fetch(PDO::FETCH_ASSOC);
		return $last_entrada['id'];
	}
	private function consulta_ultima_salida(){
		$last_salida = $this->db->query('SELECT MAX(id) AS id FROM salida');
		$last_salida = $last_salida->fetch(PDO::FETCH_ASSOC);
		return $last_salida['id'];
	}
	private function consulta_ultimo_inventario(){
		$last_inventario = $this->db->query('SELECT MAX(id) AS id FROM inventario');
		$last_inventario = $last_inventario->fetch(PDO::FETCH_ASSOC);
		return $last_inventario['id'];
	}
	private function registrar_salida_inventario(){
		$registrar_query = $this->db->prepare('INSERT INTO transaccion_salida (id_inventario, id_salida) VALUES (:id_inventario, :id_salida)');
		$last_entrada = $this->consulta_ultima_entrada();
		$last_inventario = $this->consulta_ultimo_inventario();
		$datos_transaccion = array(
				':id_inventario' => $last_inventario,
				':id_salida' => $last_entrada
			);
		return $registrar_query->execute($datos_transaccion);
	}
	public function consulta_productos_tb_entrada(array $fecha){
		if (is_array($fecha)) {
			$fecha_inicio = $fecha['ano'];
			$fecha_inicio .= '-' . $fecha['mes'];
			$fecha_inicio .=  '-0' . 1 . ' 00:00:00';
			$fecha_final = $fecha['ano'] . '-' . $fecha['mes'] . '-' . $fecha['dia'] . ' 23:59:59';
			$lista_productos = $this->db->prepare('SELECT producto.titulo as titulo, entrada.fecha_creacion as fecha, entrada.unidad as unidad, entrada.costo_unitario as costo FROM producto LEFT JOIN entrada ON producto.id = entrada.id_producto WHERE entrada.fecha_creacion >= :fecha_inicio AND entrada.fecha_creacion <= :fecha_final  ORDER BY fecha DESC LIMIT 5');
			$lista_productos->execute(array(':fecha_inicio' => $fecha_inicio, ':fecha_final' => $fecha_final));
			return $lista_productos->fetchAll(PDO::FETCH_ASSOC);
		}else{
			$lista_productos = $this->db->query('SELECT id_producto FROM entrada');
			return $lista_productos->fetchAll(PDO::FETCH_ASSOC);
		}
	}
	public function calcular_costo_promedio($id_producto){

		$query_entrada = $this->db->prepare('SELECT id_producto,  SUM(costo_total) as costo_total FROM entrada WHERE id_producto = :id_producto');
		$query_entrada->execute(array(':id_producto' => $id_producto));
		$query_entrada = $query_entrada->fetch(PDO::FETCH_ASSOC);
		$costo_entrada = $query_entrada['costo_total'];

		$query_salida = $this->db->prepare('SELECT id_producto,  SUM(costo_total) as costo_total FROM salida WHERE id_producto = :id_producto');
		$query_salida->execute(array(':id_producto' => $id_producto));
		$query_salida = $query_salida->fetch(PDO::FETCH_ASSOC);
		$costo_salida = $query_salida['costo_total'];
		$existencia = $this->consulta_stock($id_producto);

		$total_costos = $costo_entrada - $costo_salida;
		if ($total_costos != null && $existencia != null) {
			return $total_costos / $existencia;
		}else{
			return 0;
		}

	}
	public function lista_inventario($id_producto){
		 $lista_query = $this->db->prepare('SELECT DISTINCT producto.id as id, entrada.fecha_creacion as fecha, producto.titulo as titulo, categoria.titulo as categoria FROM producto LEFT JOIN categoria ON producto.id_categoria = categoria.id LEFT JOIN entrada ON entrada.id_producto = producto.id LEFT JOIN salida ON salida.id_producto = producto.id WHERE producto.id = :id_producto');
		 $lista_query->execute(array(':id_producto' => $id_producto));
		 return $lista_query->fetchAll(PDO::FETCH_ASSOC);
	}
}