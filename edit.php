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
	<title>Datos del cliente </title>

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
			<h2>Datos del cliente &raquo; Editar datos</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = mysqli_query($con, "SELECT * FROM cliente WHERE idCliente='$nik'");
			if(mysqli_num_rows($sql) == 0){
				//header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$numero		     = mysqli_real_escape_string($con,(strip_tags($_POST["idCliente"],ENT_QUOTES)));//Escanpando caracteres 
				$nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["Nombre"],ENT_QUOTES)));//Escanpando caracteres 
				$apellidos	 = mysqli_real_escape_string($con,(strip_tags($_POST["Apellidos"],ENT_QUOTES)));//Escanpando caracteres 
				$telefono	 = mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));//Escanpando caracteres 
				$email	     = mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));//Escanpando caracteres 
				$domicilio	 = mysqli_real_escape_string($con,(strip_tags($_POST["Domicilio"],ENT_QUOTES)));//Escanpando caracteres 
				$rfc	 = mysqli_real_escape_string($con,(strip_tags($_POST["RFC"],ENT_QUOTES)));//Escanpando caracteres 
				
				$update = mysqli_query($con, "UPDATE cliente SET Nombre='$nombre', Apellidos='$apellidos', telefono='$telefono', email='$email', Domicilio='$domicilio', RFC='$rfc' WHERE idCliente='$nik'") or die(mysqli_error());
				if($update){
					header("Location: clientes.php");
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
			
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-4">
						<input type="text" name="Nombre" value="<?php echo $row ['Nombre']; ?>" class="form-control" placeholder="Nombres" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Apellidos</label>
					<div class="col-sm-4">
						<input type="text" name="Apellidos" value="<?php echo $row ['Apellidos']; ?>" class="form-control" placeholder="Apellidos" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Teléfono</label>
					<div class="col-sm-3">
						<input type="text" name="telefono" value="<?php echo $row ['telefono']; ?>" class="form-control" placeholder="Teléfono" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">email</label>
					<div class="col-sm-3">
						<input type="text" name="email" value="<?php echo $row ['email']; ?>" class="form-control" placeholder="correo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Domicilio</label>
					<div class="col-sm-3">
						<input type="text" name="Domicilio" value="<?php echo $row ['Domicilio']; ?>" class="form-control" placeholder="domicilio" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">RFC</label>
					<div class="col-sm-3">
						<input type="text" name="RFC" value="<?php echo $row ['RFC']; ?>" class="form-control" placeholder="RFC" required>
					</div>
				</div>
				
                    
			
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
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