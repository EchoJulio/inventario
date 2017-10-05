<!-- Recibimos el parametro titulo enviado desde el controlador -->

<div class="container">
	<!-- <div class="col-md-3">
		asd
	</div> -->
	<!-- <div class="col-md-12"> -->
		<div class="card-deck">
		  <div class="card">
		    <div class="card-img-top bg-info"><div class="main-icon-header text-white"><i class="fa fa-user-o fa-5x" aria-hidden="true"></i></div></div>
		    <div class="card-body text-secondary">
		      <h4 class="card-title">Usuarios</h4>
		      <p class="card-text">
		      	<?php if ($this->usuarios): ?>
		      		<?php echo $this->usuarios; ?>
		      	<?php else: ?>
		      		<?php echo 0 ?>
		      	<?php endif ?>
		      </p>
		    </div>
		  </div>
		  <div class="card">
		    <div class="card-img-top bg-danger"><div class="main-icon-header text-white"><i class="fa fa-bookmark-o fa-5x" aria-hidden="true"></i></div></div>
		    <div class="card-body text-secondary">
		      <h4 class="card-title">Categoria</h4>
		      <p class="card-text">
		      	<?php if ($this->categoria): ?>
		      		<?php echo $this->categoria; ?>
		      	<?php else: ?>
		      		<?php echo 0 ?>
		      	<?php endif ?>
		      </p>
		    </div>
		  </div>
		  <div class="card">
		    <div class="card-img-top bg-dark"><div class="main-icon-header text-white"><i class="fa fa-archive fa-5x" aria-hidden="true"></i></div></div>
		    <div class="card-body">
		      <h4 class="card-title text-secondary">Productos</h4>
		      <p class="card-text text-secondary">
		      	<?php if ($this->productos_total): ?>
		      		<?php echo $this->productos_total; ?>
		      	<?php else: ?>
		      		<?php echo 0 ?>
		      	<?php endif ?>
		      </p>
		    </div>
		  </div>
		  <div class="card">
		    <div class="card-img-top bg-primary"><div class="main-icon-header text-white"><i class="fa fa-money fa-5x" aria-hidden="true"></i></div></div>
		    <div class="card-body text-secondary">
		      <h4 class="card-title">Ventas</h4>
		      <p class="card-text">3</p>
		    </div>
		  </div>
		</div>
		<hr>
	<!-- </div> -->
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h6><i class="fa fa-clock-o" aria-hidden="true"></i>  PRODUCTOS RECIENTEMENTE AÑADIDOS</h6>
				</div>
				<div class="card-body" style="height: auto;">
					<table class="table table-hover">
					  <thead>
					    <tr>
					      <th>Fecha</th>
					      <th>Producto</th>
					      <th>Und</th>
					      <th>Costo</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php if (isset($this->recientes)): ?>
					    	<?php foreach ($this->recientes as $key => $value): ?>
					    		<tr>
							      <td><?php echo substr($value['fecha'], 0, 11); ?></td>
							      <td><?php echo $value['titulo']; ?></td>
							      <td><?php echo $value['unidad']; ?></td>
							      <td><?php echo $value['costo']; ?></td>
							    </tr>
					    	<?php endforeach ?>
					    <?php else: ?>
					    	<tr>
					    		<td colspan="4">
					    			<h6><?php echo 'No se encontro ningun producto'; ?></h6>
					    		</td>
					    	</tr>
					    <?php endif ?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h6><i class="fa fa-clock-o" aria-hidden="true"></i>  PRODUCTOS RECIENTEMENTE VENDIDOS</h6>
				</div>
				<div class="card-body" style="height: auto;">
					<table class="table table-hover">
					  <thead>
					    <tr>
					      <th>Fecha</th>
					      <th>Producto</th>
					      <th>Und</th>
					      <th>Costo</th>
					    </tr>
					  </thead>
					  <tbody>
					    <?php if (isset($this->vendidos)): ?>
					    	<?php foreach ($this->vendidos as $key => $value): ?>
					    		<tr>
							      <td><?php echo substr($value['fecha'], 0, 11); ?></td>
							      <td><?php echo $value['titulo']; ?></td>
							      <td><?php echo $value['unidad']; ?></td>
							      <td><?php echo $value['costo']; ?></td>
							    </tr>
					    	<?php endforeach ?>
					    <?php else: ?>
					    	<tr>
					    		<td colspan="4">
					    			<h6><?php echo 'No se encontro ningun producto'; ?></h6>
					    		</td>
					    	</tr>
					    <?php endif ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>