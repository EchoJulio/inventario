<?php

/**
* Controlador que tiene la logica para el login de sitio
*/
class loginController extends Controller
{
	
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		
		if (Session::get('autenticado')) {
			$this->redireccionar();
		}else{
			$user = $this->loadModel('user');
			$this->view->titulo = 'Iniciar Sesión';
			if (isset($_POST['username']) && !empty($_POST['username'])) {
				if (isset($_POST['password']) && !empty($_POST['password'])) {

					$user->set('username',$_POST['username']);
					$user->set('password',$_POST['password']);
					$datos = $user->authenticate();
					
					if ($datos > 1) {
						Session::set('autenticado',true);
						Session::set('usuario',$datos['username']);
						Session::set('id',$datos['id']);
						Session::set('nombre',$datos['first_name'] . ' '  . $datos['last_name']);
						Session::set('level',$datos['perfil']);
						Session::set('tiempo',time());
						$this->redireccionar();
					}else{
						$this->view->mensaje_error = 'Usuario y/o contraseña incorrecta.';
					}
				}else if (isset($_POST['password']) && empty($_POST['password'])) {
					$this->view->mensaje_error = 'No haz ingresado ninguna contraseña';
				}
			}else if (isset($_POST['password']) && empty($_POST['username'])) {
				$this->view->mensaje_error = 'No haz ingresado tu usuario';
			}
			$this->view->renderizar('index');
		}
	} 
}