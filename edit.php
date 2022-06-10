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
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Editar clientes</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="principal.php">Conservatorio Mozart</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
   
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="editUser.php">Editar datos</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
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
        <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Principal</div>
                            <a class="nav-link" href="principal.php">
                                <div class="sb-nav-link-icon"></div>
                                Principal
                            </a>
                        
                            <div class="sb-sidenav-menu-heading">Operaciones</div>
                            <a class="nav-link" href="comprar.php">
                                <div class="sb-nav-link-icon"></div>
                                Comprar instrumento
                            </a>
                            <a class="nav-link" href="clientes.php">
                                <div class="sb-nav-link-icon"></div>
                                Clientes
                            </a>
                            <a class="nav-link" href="productos.php">
                                <div class="sb-nav-link-icon"></div>
                                Productos
                            </a>
                            <a class="nav-link" href="compras.php">
                                <div class="sb-nav-link-icon"></div>
                                Mostrar compras
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Ingresado como:</div>
                        <?php echo '<p>'.$_SESSION['username'].'</p>';?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Datos del cliente</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Editar datos</li>
                        </ol>

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
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Realizado por Diego Villanueva Ferreyra y Marco Antonio Mercado Rodriguez</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="js/cerrar.js"> </script>
    </body>
</html>
