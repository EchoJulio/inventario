<div class="container">
	<h4 class="display-4 text-primary"><i class="fa fa-exchange" aria-hidden="true"></i></i> Inventario</h4><hr>
	<ul class="nav nav-tabs">
	  <li class="nav-item">
	    <a class="nav-link active" href="<?php echo BASE_URL; ?>inventario">Lista</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="<?php echo BASE_URL; ?>inventario/entrada">Entradas</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="<?php echo BASE_URL; ?>inventario/salida">Salidas</a>
	  </li>
	</ul>
		<table class="table table-hover">
		  <thead>
		    <tr>
		      <th>#</th>
		      <th>Fecha de Entrada</th>
		      <th>Producto</th>
		      <th>Categoria</th>
		      <th>Costo</th>
		      <th>Stock</th>
		      <th>Estado</th>
		    </tr>
		  </thead>
		  <tbody>
		   <?php if (isset($this->productos) && !empty($this->productos)): ?>
		   	<?php foreach ($this->productos as $key => $value): ?>
		   		<tr>
			      <th scope="row"><?php echo $value['id']; ?></th>
			      <td><?php //echo substr($value['fecha'], 0, 10); ?></td>
			      <td><?php echo $value['titulo']; ?></td>
			      <td><?php echo $value['categoria']; ?></td>
			      <td><?php echo number_format($value['costo_promedio'],2,'.','.'); ?></td>
			      <td><?php echo $value['stock']; ?></td>
			      <?php if ($value['stock'] > 10): ?>
			      	<td><h5><span class="badge badge-success">Disponible</span></h5></td>
			      <?php endif ?>
			      <?php if ($value['stock'] < 9 && $value['stock'] > 0): ?>
			      	<td><h5><span class="badge badge-warning">Proximo Agostarse</span></h5></td>
			      <?php endif ?>
			      <?php if ($value['stock'] == 0): ?>
			      	<td><h5><span class="badge badge-danger">Producto Agotado</span></h5></td>
			      <?php endif ?>
		    	</tr>
		   	<?php endforeach ?>
		   <?php endif ?>
		  </tbody>
		</table>
		   <?php if (count($this->productos) < 1): ?>
		   	<div class="col-md-5 offset-md-4">
		   		<h4 class="text-danger">
		   			<?php echo 'No se encontro ningun registro'; ?>
		   		</h4>
		   	</div>
		  <?php endif ?>
		<?php if (isset($this->paginacion)): ?>
			<?php echo $this->paginacion; ?>
		<?php endif ?>
</div>