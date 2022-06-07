<!--
Proyecto: Pagina de instrumentos con PHP, MySQL y Bootstrap CRUD  (Create, read, Update, Delete) 
Alumnos	: Marco Antonio Mercado Rodriguez y Diego Villanueva Ferreyra 
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
	<title>Agregar cliente</title>

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
			<h2>Datos del Cliente &raquo; Agregar datos</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
	
				$nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["Nombre"],ENT_QUOTES)));//Escanpando caracteres 
				$apellidos	     = mysqli_real_escape_string($con,(strip_tags($_POST["Apellidos"],ENT_QUOTES)));//Escanpando caracteres  
				$telefono	     = mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));//Escanpando caracteres 
				$email	         = mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));//Escanpando caracteres 
				$domicilio	     = mysqli_real_escape_string($con,(strip_tags($_POST["Domicilio"],ENT_QUOTES)));//Escanpando caracteres 
				$rfc		     = mysqli_real_escape_string($con,(strip_tags($_POST["RFC"],ENT_QUOTES)));//Escanpando caracteres 
				
				
				$cek = mysqli_query($con, "SELECT * FROM cliente WHERE RFC='$rfc'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($con, "INSERT INTO cliente(Nombre, Apellidos, telefono, email, Domicilio, RFC)
									VALUES('$nombre','$apellidos','$telefono','$email','$domicilio','$rfc')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
							header("location: clientes.php");
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
					<label class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-4">
						<input type="text" name="Nombre"  class="form-control" placeholder="Nombres" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Apellidos</label>
					<div class="col-sm-4">
						<input type="text" name="Apellidos"  class="form-control" placeholder="Apellidos" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Teléfono</label>
					<div class="col-sm-3">
						<input type="text" name="telefono"  class="form-control" placeholder="Teléfono" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-3">
						<input type="text" name="email" class="form-control" placeholder="Correo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Domicilio</label>
					<div class="col-sm-3">
						<input type="text" name="Domicilio" class="form-control" placeholder="Domicilio" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">RFC</label>
					<div class="col-sm-3">
						<input type="text" name="RFC"  class="form-control" placeholder="RFC" required>
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="clientes.php" class="btn btn-sm btn-danger">Cancelar</a>
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