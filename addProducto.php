<!--
Proyecto: Pagina de instrumentos con PHP, MySQL y Bootstrap CRUD  (Create, read, Update, Delete) 
Alumnos	: Marco Antonio Mercado Rodriguez y Diego Villanueva Ferreyra 
Carrera : ISC
Semestre: 5.to
Grupo   : B
-->

<?php
include("conexion.php");

session_start();
if(!isset($_SESSION['username'])){
	echo "<script>
	   alert('No puedes ingresar');
	   window.location = 'index.php';
	</script>";
	session_destroy();
	die();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agregar producto</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
</head>
<body>

	<div class="container">
		<div class="content">
			<h2>Datos del producto &raquo; Agregar datos</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
	
				$nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));//Escanpando caracteres 
				$descripcion	 = mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));//Escanpando caracteres  
				$existencia	     = mysqli_real_escape_string($con,(strip_tags($_POST["existencia"],ENT_QUOTES)));//Escanpando caracteres 
				$marca	         = mysqli_real_escape_string($con,(strip_tags($_POST["marca"],ENT_QUOTES)));//Escanpando caracteres 
				$modelo 	     = mysqli_real_escape_string($con,(strip_tags($_POST["modelo"],ENT_QUOTES)));//Escanpando caracteres 
				$precio		     = mysqli_real_escape_string($con,(strip_tags($_POST["precio"],ENT_QUOTES)));//Escanpando caracteres 
				
				
				$cek = mysqli_query($con, "SELECT * FROM producto WHERE modelo='$modelo'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($con, "INSERT INTO producto(nombre, descripcion, existencia, marca, modelo, precio)
									VALUES('$nombre','$descripcion','$existencia','$marca','$modelo','$precio')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
							header("location: productos.php");
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. RFC exite!</div>';
				}
				
			}
			?>

			<form class="form-horizontal" action="" method="post">
			<div class="form-group">
					<label class="col-sm-3 control-label">Nombre</label>
					<div class="col-sm-4">
						<input type="text" name="nombre"  class="form-control" placeholder="Nombre" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Descripcion</label>
					<div class="col-sm-4">
						<input type="text" name="descripcion"  class="form-control" placeholder="Descripcion" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Existencia</label>
					<div class="col-sm-3">
						<input type="text" name="existencia"  class="form-control" placeholder="Existencia" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Marca</label>
					<div class="col-sm-3">
						<input type="text" name="marca" class="form-control" placeholder="Marca" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Modelo</label>
					<div class="col-sm-3">
						<input type="text" name="modelo" class="form-control" placeholder="Modelo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Precio</label>
					<div class="col-sm-3">
						<input type="text" name="precio"  class="form-control" placeholder="Precio" required>
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="productos.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>