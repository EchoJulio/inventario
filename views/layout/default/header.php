<!DOCTYPE html>
<html lang="es">
<head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title><?php if (isset($this->titulo)) {
    echo $this->titulo;
  } ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>views/layout/default/css/estilos.css">
 <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>views/layout/default/css/bootstrap.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">



 
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 50px;">
  <div class="container">
    <a class="navbar-brand" href="<?php echo BASE_URL; ?>"><?php echo APP_NAME; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo BASE_URL; ?>productos">Productos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo BASE_URL; ?>inventario">Inventario</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            <?php if (Session::get('autenticado')): ?>
              <?php echo Session::get('nombre'); ?>
            <?php endif ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="<?php echo BASE_URL; ?>desconectar">Desconectar</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script type="text/javascript" src="<?php echo BASE_URL; ?>views/layout/default/js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>   
<script type="text/javascript" src="<?php echo BASE_URL; ?>views/layout/default/js/bootstrap.js"></script>

<?php
if (isset($layoutParams['ruta_js']) && count($layoutParams['ruta_js'])) {
    for ($i=0; $i < count($js); $i++) { 
      ?>
         <script src=" <?php echo $layoutParams['ruta_js'][$i]; ?>" type="text/javascript"></script>
      <?php
    }
  ?>
  

<?php
}
?>

 <?php
 if (isset($layoutParams['js']) && count($layoutParams['js']) && !empty($layoutParams['js'])) {
      $js = $layoutParams['js'];
        for ($i=0; $i < count($js); $i++) { 
          ?>
             <script src=" <?php echo $js[$i]; ?>" type="text/javascript"></script>
          <?php
        }
    }

    ?>

