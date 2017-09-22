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
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" srel="stylesheet">
     


 
</head>
<body class="login-background">
<div class="container">
	<form class="form-singin col-md-8 offset-sm-4" method="post">
		<legend>Inicio de Sesión</legend>
		<div class="form-group row">
			<label  class="col-md-2 col-form-label" for="usuario">Usuario: </label>
			<div class="col-md-4">
				<input class="form-control" type="text" name="username" placeholder="Usuario"  required="">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label" for="password">Contraseña: </label>
			<div class="col-md-4">
				<input class="form-control" type="password" name="password" placeholder="Contraseña"  required="">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-6">
				<input class="btn btn-outline-primary  btn-block" type="submit" value="Iniciar Sesión">
			</div>
		</div>
		<?php if (isset($this->mensaje_error) && !empty($this->mensaje_error)): ?>
			<div class="alert alert-danger col-md-6" role="alert">
			  <?php echo $this->mensaje_error; ?>
			</div>
		<?php endif ?>
	</form>
</div>

</body>
</html>