<?php

class fpdfController extends Controller{

	private $fpdf;

	public function __construct(){
		parent::__construct();

		//Metodo para importar la libreria
		$this->getLibrary('fpdf');

		$this->fpdf = new FPDF;
	}

	public function index(){

	}

	public function pdf($nombre,$apellido){

		$this->fpdf->addPage();
		$this->fpdf->setFont('Arial','B',16);
		$this->fpdf->cell(40,10,'Hola .PDF');
		$this->fpdf->ln();
		$this->fpdf->cell(40,10,$nombre);
		$this->fpdf->ln();
		$this->fpdf->cell(40,10,$apellido);

		$this->fpdf->OutPut();
	}

	public function pdf2($nombre,$apellido){
		//Traer las instrucciones desde un archivo externo 
		require_once ROOT . 'public' . DS . 'files' . DS . 'pdf2.php';

		
	}
}