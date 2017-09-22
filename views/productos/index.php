<div class="container">
	<h4 class="display-4 text-primary"><i class="fa fa-th" aria-hidden="true"></i> Productos</h4><hr>
	<ul class="nav nav-tabs">
	  <li class="nav-item">
	    <a class="nav-link active" href="<?php echo BASE_URL; ?>productos">Lista</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="<?php echo BASE_URL; ?>productos/nuevo">Nuevo</a>
	  </li>
	</ul>
	<table class="table table-hover">
	  <thead>
	    <tr>
	      <th>#</th>
	      <th>Titulo</th>
	      <th>Descripcion</th>
	      <th>Categoria</th>
	      <th colspan="2" style="text-align: center;">Accion</th>
	    </tr>
	  </thead>
	  <tbody>
	    <?php if (isset($this->productos) && !empty($this->productos)): ?>
	    	<?php foreach ($this->productos as $key => $value): ?>
	    		<tr>
			      <th scope="row"><?php echo $value['id']; ?></th>
			      <td><?php echo $value['titulo']; ?></td>
			      <td><?php echo $value['descripcion']; ?></td>
			      <td><?php echo $value['categoria']; ?></td>
			      <td colspan="2" style="text-align: center;">
			     	<a class="btn btn-outline-warning" href="<?php echo BASE_URL.'productos/editar/'.$value['id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
			      	<a class="btn btn-outline-danger" href="<?php echo BASE_URL.'productos/borrar/'.$value['id'] ?>"><i class="fa fa-times fa-1" aria-hidden="true"></i></a>
			      </td>
	 		   </tr>
	    	<?php endforeach ?>
	    <?php endif ?>
	  </tbody>
	</table>
</div>