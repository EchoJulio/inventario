<?php

/**
* Modelo de la tabla productos donde se va a gestionar toda intreaccion
con la tabla productos.
*/
class inventarioModel extends model
{
	private $titulo = '';
	private $descripcion = '';
	private $id_categoria = '';
	private $id_usuario = '';
	private $id = '';
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
	public function add(){
		 $add_query = $this->db->prepare('INSERT INTO producto (titulo, descripcion, id_categoria,id_usuario) VALUES (:titulo, :descripcion,:id_categoria,:id_usuario)');

		return $add_query->execute(array(
				':titulo' => $this->titulo,
				':descripcion' => $this->descripcion,
				':id_categoria' => $this->id_categoria,
				':id_usuario' => $this->id_usuario
			));
	}
	public function edit(){
		 $edit_query = $this->db->prepare('UPDATE producto SET titulo = :titulo, descripcion = :descripcion, id_categoria = :id_categoria WHERE id = :id');

		return $edit_query->execute(array(
				':titulo' => $this->titulo,
				':descripcion' => $this->descripcion,
				':id_categoria' => $this->id_categoria,
				':id' => $this->id
			));
	}
	public function delete(){
		 $edit_query = $this->db->prepare('DELETE FROM producto WHERE id = :id');

		return $edit_query->execute(array(
				':id' => $this->id
			));
	}
}