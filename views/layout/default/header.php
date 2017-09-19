<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <title><?php if (isset($this->titulo)) {
    echo $this->titulo;
  } ?></title>
<!--   Bootstrap Original -->
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>views/layout/default/css/estilos.css"><!-- 
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/views/layout/default/css/bootstrap.css.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/views/layout/default/css/bootstrap-material-design.css">
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/views/layout/default/css/ripples.css"> -->

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

      <link href=" //netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css"
      rel="stylesheet">
     


 
</head>
<body>

<div class="navbar navbar-dafault ">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo BASE_URL; ?>"><?php echo APP_NAME; ?></a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
      <ul class="nav navbar-nav">
       
        
           <?php
        //**OJO LEER EXPLICACION DE CODIGO PHP**
        //Bucle para generar mi lista de enlaces del menu
        //y asi poder agregar la clase active al enlace donde
        //donde se encuentre el usurio
          if (isset($layoutParams['menu']) && !empty($layoutParams['menu'])) {
            
            $menu = $layoutParams['menu'];
            $ocultar = '';

            
            foreach ($menu as $row => $value) { ?>
          <?php
             if (!empty($item) && $value['id'] == $item) { 
              $enlaceStyle = 'active';
          ?>

          <?php
             }else{
              $enlaceStyle = '';
            
           ?>
              

            <?PHP
                  }
                  if ($value['id'] =='login') {
                    $ocultar = "style='display: none;'";
                  }
                 
            ?>    
                <li <?php echo $ocultar; ?> class="<?php echo $enlaceStyle; ?>"><a href="<?php echo $value['enlace']; ?>"><?php echo $value['titulo']; ?><span class="sr-only">(current)</span></a></li>
            <?php

            }
          }
         ?>

      </ul>
      <div class="col-lg-offset-3">
        <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control col-md-8" placeholder="Search">
        </div>
      </form>
      </div>

      <ul class="nav navbar-nav navbar-right">
       <!--  <li><a href="javascript:void(0)">Link</a></li>
        <li class="dropdown">
          <a href="" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
            <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="javascript:void(0)">Action</a></li>
            <li><a href="javascript:void(0)">Another action</a></li>
            <li><a href="javascript:void(0)">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0)">Separated link</a></li>
          </ul>
        </li> -->

           <?php
        $menuRegistrar = '';
       // print_r($layoutParams);
        $menuLogin = $layoutParams['menu'][2];
        if (isset($layoutParams['menu'][3])) {

         $menuRegistrar = $layoutParams['menu'][3];
        }
           if ($menuLogin['id'] == 'login') {?>
      
                    <li><a href="<?php echo $menuLogin['enlace']; ?>"><?php echo $menuLogin['titulo']; ?></a></li>
                 

                  <?php
            }
            if (!empty($menuRegistrar)) {?>
              <?php if ($menuRegistrar['id'] == 'registro'): ?>
                  <li><a href="<?php echo $menuRegistrar['enlace']; ?>"><?php echo $menuRegistrar['titulo']; ?></a></li>
              <?php endif ?>
             
            <?php
            }
        ?>

      </ul>
    </div>
  </div>
</div>




<?php
if (isset($layoutParams['ruta_js']) && count($layoutParams['ruta_js'])) {

  ?>
  <script type="text/javascript" src="<?php echo $layoutParams['ruta_js']; ?>jquery.js"></script>
  <script type="text/javascript" src="<?php echo $layoutParams['ruta_js']; ?>bootstrap.js"></script>
  <script type="text/javascript" src="<?php echo $layoutParams['ruta_js']; ?>material.js"></script>
  <script type="text/javascript" src="<?php echo $layoutParams['ruta_js']; ?>ripples.js"></script>

<?php
}
?>
<script type="text/javascript">
  $.material.init();
</script>
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


