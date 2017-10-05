<?php if (isset($this->_paginacion)): ?>
<nav aria-label="..." >
  <ul class="pagination pagination-lg justify-content-center">
  	<?php if ($this->_paginacion['primero']): ?>
  			 <li class="page-item">
		      <a class="page-link" href="<?php echo $link . $this->_paginacion['primero'] ?>" tabindex="-1">Inicio</a>
		    </li>
		<?php else: ?>
			 <li class="page-item">
			 	 <a class="page-link disabled" href="" tabindex="-1">Inicio</a>
			 </li>
		<?php endif; ?>	
		<?php if ($this->_paginacion['anterior']): ?>
			 <li class="page-item">
		      <a class="page-link" href="<?php echo $link . $this->_paginacion['anterior'] ?>" tabindex="-1">Anterior</a>
		    </li>
		<?php else: ?>
			 <li class="page-item disabled">
		      <a class="page-link" href="" tabindex="-1">Anterior</a>
		    </li>
		<?php endif; ?>	
   
    <?php for ($i=0; $i < count($this->_paginacion['rango']); $i++) { ?>
			
		<?php if ($this->_paginacion['actual'] == $this->_paginacion['rango'][$i]): ?>
			<li class="page-item disabled"><a class="page-link" href=""><?php echo $this->_paginacion['rango'][$i]; ?></a></li>
		<?php else: ?>
			<li class="page-item"><a class="page-link" href="<?php echo $link . $this->_paginacion['rango'][$i]; ?>">
			<?php echo $this->_paginacion['rango'][$i]; ?></a></li>
		<?php endif; ?>	

	<?php } ?>
    <li class="page-item">
    	<?php if ($this->_paginacion['siguiente']): ?>
    		<a class="page-link disabled" href="<?php echo $link . $this->_paginacion['siguiente'] ?>">Siguiente</a>
		<?php else: ?>
			<a class="page-link disabled" href="">Siguiente</a>
		<?php endif; ?>
    </li>
	<li class="page-item">
		<?php if ($this->_paginacion['ultimo']): ?>
			<a class="page-link" href="<?php echo $link . $this->_paginacion['ultimo'] ?>">Ultimo</a>

		<?php else: ?>
			<a class="page-link disabled" href="">Ultimo</a>
		<?php endif; ?>
    </li>
  </ul>
</nav>
<?php endif; ?>
