<!-- Recibimos el parametro titulo enviado desde el controlador -->

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<H2>Prueba buscar por categoria... <i class="material-icons" style="font-size: 40px; "></i></H2><hr>
		</div>
		
	</div>

	<div class="row">
		<?php if (isset($this->categorias) && isset($this->subCategorias)): ?>
					<?php $categorias = $this->categorias; ?>
					<?php $subCategorias = $this->subCategorias; ?>
					

					<?php foreach ($categorias as $row => $value): ?>
					<div class="col-md-3">
						
						<div class="well" style="height: 250px;">
								<i class="material-icons" style="color: #03a9f4; font-size: 35px;"> <?php echo $value['icon']; ?> </i>
								
							<a href="#" style="color: #000; "><h4><?php echo $value['categoria']; ?></h4></a>
							<div class="list-group">
								<?php
									for ($i=0; $i < count($subCategorias) ; $i++) { 
										if ($value['id'] == $subCategorias[$i]['id_category']) {?>
											
											<a  style="color: #000; " href="<?php echo $subCategorias[$i]['id']; ?>"><div class="row-content"><i class="material-icons">chevron_right</i><?php echo $subCategorias[$i]['title']; ?></div></a>
										<?php
										}
									}
								 ?>

							</div>
						</div>
						
					</div>
					<?php endforeach ?>
				<?php endif ?>

				
	</div>



	<div class="row">
		<div class="col-md-9">
		<H2>Publicaciones Recientes:</H2><hr>
			<!-- <div class="well"> -->
			
				<?php if (isset($this->post) && isset($this->images)): ?>
							<?php $posts = $this->post; ?>
							<?php $images = $this->images; $limitarImg = 0; ?>
							<?php foreach ($posts as $row => $value): ?>
								<div class="col-md-6">
								<a href="<?php echo BASE_URL . 'post/ver/' . $value['id']; ?>" style="color: #1c1c1c; text-decoration: none;">

								<div class="well">
								
								<h3><?php echo substr($value['title'], 0, 30); ?></h3>
								
								
								<?php
									for ($i=0; $i < count($images); $i++) { ?>

									<?php if ($value['id'] == $images[$i]['id_post']): ?>
										<img style="width: 100px; height: 100px;" class="img-thumbnail" alt="<?php echo $images[$i]['title']; ?>" src="<?php echo BASE_URL; ?>public/img/<?php echo $images[$i]['title'] . $images[$i]['format']; ?>">
										
									<?php endif ?>
										
										<?php
									}
								?>	
								
								
								<p>
									<?php echo substr($value['description'],0,55) .'...';  ?>

								</p>
								<h3><?php echo  $value['tipo_moneda'].number_format($value['price'],2,'.',','); ?></h3>
								<small style="text-align: left;"><?php echo date_format(date_create($value['fecha_creacion']), 'g:ia \o\n l  F Y'); ?></small>
								

								
								</div>
								</a>
								</div>
								<?php endforeach ?>
							<?php endif ?>	
									
			<!-- </div> -->
		</div>
	</div>
</div>
