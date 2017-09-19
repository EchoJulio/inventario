<?php

 class Request
 {
 	private $controlador;
 	private $metodo;
 	private $argumentos;


 	public function __construct(){
 	 	if (isset($_GET['url'])) {

 	 		$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
 	 		//Seperamos y guardamos dentro un array los valores en la url 
 	 		//pero se dividen por el '/' 
 	 		//Ej: localhost/pagina/controlador/metodo/argumento1/argumento2...
 	 		//Array([0] => 'pagina',[1] => 'controlador',[2] => 'metodo', [3] => 'argumento1',[4] => 'argmento2');
 	 		//Asi sucesivamente hasta extraer todo lo que tengo la url. 
 	 		
 	 		$url = explode('/',$url);
 	 		//Todos los elementos que no sean validos en la url seran eliminados
 	 		//Con la funcion array_filter
 	 		
 	 		$url = array_filter($url);
 	 	

 	 		
	 	 	//Asignamos desde la url en primer valor del array que sera el controlador
	 	 	$this->controlador = strtolower(array_shift($url));

	 	 	//Asignamos desde la url en segundo valor del array que sera el metodo
	 	 	$this->metodo = strtolower(array_shift($url));

	 	 	//Por ultimo asignamos todos los argumentos restantes de la url 7.03
	 	 	$this->argumentos = $url;
	 	}

 	 	if (!$this->controlador) {
 	 		//cuando no se envia o no puede ser encontrardo un controlador se usara este por defecto
 	 		$this->controlador = DEFAULT_CONTROLLER;
 	 	}

 	 	if (!$this->metodo) {
 	 		//cuando no se envia o no puede ser encontrardo un metodo se usara este por defecto
 	 		$this->metodo = 'index';
 	 	}

 	 	if (!isset($this->argumentos)) {
 	 		$this->argumentos =  array();
 	 	}
 	 	
 	}

 	public function getControlador(){
 		return $this->controlador;
 	}

 	public function getMetodo(){
 		return $this->metodo;
 	}

 	public function getArgumentos(){
 		return $this->argumentos;
 	}

 	
 }
