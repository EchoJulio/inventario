<?php

/**
* Modelo de la tabla user donde se va a gestionar toda intreaccion
con la tabla user.
*/
class userModel extends model
{
	private $username = '';
	private $password = '';

	public function __construct()
	{
		parent::__construct();
	}

	public function lista($id = false){
		if ($id) {
			//$id = (int) $id;
			$lista_query = $this->db->prepare('SELECT * FROM user WHERE id = :id');
			$lista_query->execute(array(':id' => $id));
			return $lista_query->fetch(PDO::FETCH_ASSOC);
		}else{
			$lista_query = $this->db->query('SELECT * FROM user');
			return $lista_query->fetchAll(PDO::FETCH_ASSOC);
		}
		
	}
	public function set($propiedad,$valor){
		$this->$propiedad = $valor;
	}
	public function setUsername($valor){
		$this->username = $valor;
	}
	public function setPassword($valor){
		$this->password = $valor;
	}
	public function authenticate(){
		$auth_query = $this->db->prepare('SELECT * FROM user WHERE username = :username AND password = :password');
		//$username = 'jv.capellan06';
		$password = md5($this->password);
		$auth_query->execute(array(
				':username' => $this->username,
				':password' => $password
			));
		$datos =  $auth_query->fetch(PDO::FETCH_ASSOC);
		return $datos;

		//echo $datos['username'];

	}
}