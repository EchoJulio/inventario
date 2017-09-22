<div class="container">
	<h4 class="display-4 text-primary"><i class="fa fa-exchange" aria-hidden="true"></i></i> Inventario</h4><hr>
	<ul class="nav nav-tabs">
	  <li class="nav-item">
	    <a class="nav-link" href="<?php echo BASE_URL; ?>inventario">Lista</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="<?php echo BASE_URL; ?>inventario/entrada">Entradas</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link active" href="<?php echo BASE_URL; ?>inventario/salida">Salidas</a>
	  </li>
	</ul>
	<form class="form-singin col-md-12" method="post">
		<legend>Registro De Salida</legend>
		<div class="form-group row">
			<label  class="col-md-1 col-form-label" for="cantidad">Producto: </label>
			<div class="col-md-8">
				<input class="form-control" type="text" name="producto" required="">
			</div>
			<div class="col-md-1 offset-sm-2">
				<input class="btn btn-outline-info" type="submit" id="buscar" value="Buscar">
			</div>

		</div>
		<hr>
		<div class="form-group row">
			<label  class="col-md-1 col-form-label" for="cantidad">Razon: </label>
			<div class="col-md-2">
				<select class="form-control" name="titulo">
					<option value="oferta">Oferta</option>
					<option value="sobrante">Sobrante</option>
					<option value="ajuste">Ajuste</option>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label  class="col-md-1 col-form-label" for="cantidad">Cantidad: </label>
			<div class="col-md-2">
				<input class="form-control" type="number" name="cantidad" required="">
			</div>
			<label  class="col-md-1 col-form-label" for="precio">Precio: </label>
			<div class="col-md-3">
				<input class="form-control" type="number" name="precio" required="">
			</div>
			<label  class="col-md-1 col-form-label" for="costo">Costo: </label>
			<div class="col-md-3">
				<input class="form-control" type="number" name="costo" required="">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-1 col-form-label" for="descripcion">Descripcion: </label>
			<div class="col-md-10">
				<textarea class="form-control" rows="5" type="text" name="descripcion" placeholder="Descripcion..."  required=""></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<div class="offset-sm-11 col-md-1">
				<input class="btn btn-outline-success" type="submit" value="Enviar">
			</div>
		</div>
		<?php if (isset($this->mensaje_error) && !empty($this->mensaje_error)): ?>
			<div class="alert alert-danger col-md-6" role="alert">
			  <?php echo $this->mensaje_error; ?>
			</div>
		<?php endif ?>
		<?php if (isset($this->mensaje_exito) && !empty($this->mensaje_exito)): ?>
			<div class="alert alert-success col-md-6" role="alert">
			  <?php echo $this->mensaje_exito; ?>
			</div>
		<?php endif ?>
	</form>
</div>