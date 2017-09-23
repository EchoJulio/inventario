<div class="container">
	<h4 class="display-4 text-primary"><i class="fa fa-th" aria-hidden="true"></i> Productos</h4><hr>
	<ul class="nav nav-tabs">
	  <li class="nav-item">
	    <a class="nav-link" href="<?php echo BASE_URL; ?>productos">Lista</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="<?php echo BASE_URL; ?>productos/nuevo">Nuevo</a>
	  </li>
	</ul>
	<form class="form-tab col-md-10 offset-sm-3" method="post">
		<legend>Editar Producto</legend>
		<div class="form-group row">
			<label  class="col-md-2 col-form-label" for="titulo">Categoria: </label>
			<div class="col-md-4">
				<select class="form-control" name="id_categoria">
					<?php if (isset($this->categoria) && !empty($this->categoria)): ?>
						<?php foreach ($this->categoria as $key => $value): ?>
							<?php if ($this->productos['categoria'] == $value['titulo']): ?>
								<option selected value="<?php echo $value['id'] ?>"><?php echo $value['titulo']; ?></option>
							<?php else: ?>
								<option value="<?php echo $value['id'] ?>"><?php echo $value['titulo']; ?></option>
							<?php endif ?>
						<?php endforeach ?>
					<?php endif ?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label  class="col-md-2 col-form-label" for="titulo">Titulo: </label>
			<div class="col-md-4">
				<input class="form-control" type="text" name="titulo" placeholder="Titulo"  required="" value="<?php echo $this->productos['titulo']; ?>">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label" for="descripcion">Descripcion: </label>
			<div class="col-md-4">
				<textarea class="form-control" rows="5" type="text" name="descripcion" placeholder="Descripcion"  required=""><?php echo $this->productos['descripcion']; ?></textarea>
			</div>
		</div>
		
		<div class="form-group row">
			<div class="offset-sm-9  col-md-2">
				<input class="btn btn-outline-warning" type="submit" value="Editar">
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