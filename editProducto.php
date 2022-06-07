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
	<title>Datos del Producto</title>

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
			<h2>Datos del Producto &raquo; Editar datos</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = mysqli_query($con, "SELECT * FROM producto WHERE idProducto='$nik'");
			if(mysqli_num_rows($sql) == 0){
				//header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$numero		     = mysqli_real_escape_string($con,(strip_tags($_POST["idProducto"],ENT_QUOTES)));//Escanpando caracteres 
				$nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));//Escanpando caracteres 
				$descripcion	 = mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));//Escanpando caracteres 
				$existencia	 = mysqli_real_escape_string($con,(strip_tags($_POST["existencia"],ENT_QUOTES)));//Escanpando caracteres 
				$marca	     = mysqli_real_escape_string($con,(strip_tags($_POST["marca"],ENT_QUOTES)));//Escanpando caracteres 
				$modelo	 = mysqli_real_escape_string($con,(strip_tags($_POST["modelo"],ENT_QUOTES)));//Escanpando caracteres 
				$precio	 = mysqli_real_escape_string($con,(strip_tags($_POST["precio"],ENT_QUOTES)));//Escanpando caracteres 
				
				$update = mysqli_query($con, "UPDATE producto SET nombre='$nombre', descripcion='$descripcion', existencia='$existencia', marca='$marca', modelo='$modelo', precio='$precio' WHERE idProducto='$nik'") or die(mysqli_error());
				if($update){
					header("Location: productos.php");
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
					<label class="col-sm-3 control-label">Nombre</label>
					<div class="col-sm-4">
						<input type="text" name="nombre" value="<?php echo $row ['nombre']; ?>" class="form-control" placeholder="Nombres" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Descripcion</label>
					<div class="col-sm-4">
						<input type="text" name="descripcion" value="<?php echo $row ['descripcion']; ?>" class="form-control" placeholder="descripcion" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Existencia</label>
					<div class="col-sm-3">
						<input type="text" name="existencia" value="<?php echo $row ['existencia']; ?>" class="form-control" placeholder="existencia" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Marca</label>
					<div class="col-sm-3">
						<input type="text" name="marca" value="<?php echo $row ['marca']; ?>" class="form-control" placeholder="marca" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Modelo</label>
					<div class="col-sm-3">
						<input type="text" name="modelo" value="<?php echo $row ['modelo']; ?>" class="form-control" placeholder="modelo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Precio</label>
					<div class="col-sm-3">
						<input type="text" name="precio" value="<?php echo $row ['precio']; ?>" class="form-control" placeholder="precio" required>
					</div>
				</div>
				
                    
			
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
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