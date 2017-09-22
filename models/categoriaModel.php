<?php

/**
* Modelo de la tabla user donde se va a gestionar toda intreaccion
con la tabla user.
*/
class categoriaModel extends model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function lista(){
		$auth_query = $this->db->prepare('SELECT * FROM categoria');
		$auth_query->execute();
		$datos =  $auth_query->fetchAll(PDO::FETCH_ASSOC);
		return $datos;

	}
}