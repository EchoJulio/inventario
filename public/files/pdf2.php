<?php

	$this->fpdf->addPage();
		$this->fpdf->setFont('Arial','B',16);
		$this->fpdf->cell(40,10,'Hola .PDF');
		$this->fpdf->ln();
		$this->fpdf->cell(40,10,$nombre);
		$this->fpdf->ln();
		$this->fpdf->cell(40,10,$apellido);

		$this->fpdf->OutPut();
		
 ?>