<!--
Proyecto: Pagina de instrumentos con PHP, MySQL y Bootstrap CRUD  (Create, read, Update, Delete) 
Alumnos	: Marco Antonio Mercado Rodriguez y Diego Villanueva Ferreyra 
Carrera : ISC
Semestre: 6
Grupo   : C
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
$nik = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Editar datos</title>
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
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Usuario</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Editar datos de usuario</li>
                        </ol>

                        <?php
                        // escaping, additionally removing everything that could be (html/javascript-) code
                        $sql = mysqli_query($con, "SELECT * FROM usuario WHERE usuario='$nik'");
                        if(mysqli_num_rows($sql) == 0){
                            //header("Location: index.php");
                        }else{
                            $row = mysqli_fetch_assoc($sql);
                        }
                        if(isset($_POST['save'])){
                            $nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["nombres"],ENT_QUOTES)));//Escanpando caracteres 
                            $apellidos	 = mysqli_real_escape_string($con,(strip_tags($_POST["apellidos"],ENT_QUOTES)));//Escanpando caracteres 
                            $email	     = mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));//Escanpando caracteres 

                            $queryE = "UPDATE usuario SET nombres='$nombre', apellidos='$apellidos', email='$email' WHERE usuario='$nik'";
                            $update = mysqli_query($con, $queryE) or die(mysqli_error());
                            if($update){
								echo "<script>
									alert('No tienes permiso de acceder');
									window.location = 'index.php';
								</script>";
                                header("location: principal.php");
                            }else{
                                echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
                            }
                        }
                        
                        if(isset($_GET['pesan']) == 'sukses'){
                            echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
                        }
                        ?>
                        <form class="form-horizontal" action="" method="post">
                            <div class="text-center">
                                    <img src="img/Sample_User_Icon.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                                    id="imagen" width="200px" alt="profile">
                                    </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" >Nombres</label>
                                <div class="col-sm-4">
                                    <input type="text" name="nombres" value="<?php echo $row ['nombres']; ?>" class="form-control" placeholder="nombres" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Apellidos</label>
                                <div class="col-sm-4">
                                    <input type="text" name="apellidos" value="<?php echo $row ['apellidos']; ?>" class="form-control" placeholder="apellidos" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-3">
                                    <input type="text" name="email" value="<?php echo $row ['email']; ?>" class="form-control" placeholder="email" required>
                                </div>
                            </div>
                                
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label">&nbsp;</label>
                                <div class="col-sm-6">
                                    <input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
                                    <a href="principal.php" class="btn btn-sm btn-danger">Cancelar</a>
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
    </body>
</html>
